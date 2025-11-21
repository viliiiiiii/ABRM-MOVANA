<?php
require_once __DIR__ . '/helpers.php';
require_once __DIR__ . '/db.php';
session_name(app_config()['security']['session_name']);
session_start();

function find_user_by_email(string $email): ?array
{
    $pdo = get_pdo();
    $stmt = $pdo->prepare('SELECT * FROM users WHERE email = :email LIMIT 1');
    $stmt->execute([':email' => $email]);
    $row = $stmt->fetch();
    return $row ?: null;
}

function is_locked_out(array $user): bool
{
    if (empty($user['lockout_until'])) {
        return false;
    }
    return strtotime($user['lockout_until']) > time();
}

function record_failed_login(int $userId): void
{
    $pdo = get_pdo();
    $config = app_config();
    $pdo->prepare('UPDATE users SET failed_login_attempts = failed_login_attempts + 1 WHERE id = :id')
        ->execute([':id' => $userId]);
    $stmt = $pdo->prepare('SELECT failed_login_attempts FROM users WHERE id = :id');
    $stmt->execute([':id' => $userId]);
    $attempts = (int) $stmt->fetchColumn();
    if ($attempts >= $config['security']['failed_login_limit']) {
        $lockoutUntil = (new DateTimeImmutable('+ ' . $config['security']['lockout_minutes'] . ' minutes'))
            ->format('Y-m-d H:i:s');
        $pdo->prepare('UPDATE users SET lockout_until = :until WHERE id = :id')
            ->execute([':until' => $lockoutUntil, ':id' => $userId]);
    }
}

function reset_failed_logins(int $userId): void
{
    $pdo = get_pdo();
    $pdo->prepare('UPDATE users SET failed_login_attempts = 0, lockout_until = NULL WHERE id = :id')
        ->execute([':id' => $userId]);
}

function login(string $email, string $password): array
{
    $user = find_user_by_email($email);
    if (!$user) {
        return ['success' => false, 'message' => 'Invalid credentials'];
    }
    if (is_locked_out($user)) {
        return ['success' => false, 'message' => 'Account locked. Try again later.'];
    }
    if (!password_verify($password, $user['password_hash'])) {
        record_failed_login((int) $user['id']);
        return ['success' => false, 'message' => 'Invalid credentials'];
    }
    reset_failed_logins((int) $user['id']);
    session_regenerate_id(true);
    $_SESSION['user'] = [
        'id' => (int) $user['id'],
        'name' => $user['name'],
        'email' => $user['email'],
        'role_id' => (int) $user['role_id'],
        'sector_id' => (int) $user['sector_id'],
        'theme' => $user['theme_preference'] ?? 'light',
    ];
    return ['success' => true, 'message' => 'Logged in'];
}

function logout(): void
{
    session_regenerate_id(true);
    $_SESSION = [];
    session_destroy();
}

function is_logged_in(): bool
{
    return isset($_SESSION['user']);
}
