<?php
require_once __DIR__ . '/helpers.php';
require_once __DIR__ . '/db.php';

function user_has_permission(int $userId, string $permissionKey): bool
{
    $pdo = get_pdo();
    $stmt = $pdo->prepare('SELECT 1 FROM role_permissions rp
        JOIN users u ON u.role_id = rp.role_id
        JOIN permissions p ON p.id = rp.permission_id
        WHERE u.id = :user_id AND p.`key` = :pkey');
    $stmt->execute([':user_id' => $userId, ':pkey' => $permissionKey]);
    if ($stmt->fetchColumn()) {
        return true;
    }

    $override = $pdo->prepare('SELECT allow FROM user_permissions_override uo JOIN permissions p ON p.id = uo.permission_id WHERE uo.user_id = :user_id AND p.`key` = :pkey LIMIT 1');
    $override->execute([':user_id' => $userId, ':pkey' => $permissionKey]);
    $result = $override->fetchColumn();
    if ($result !== false) {
        return (bool)$result;
    }

    return false;
}

function require_permission(string $permissionKey): void
{
    $user = current_user();
    if (!$user || !user_has_permission((int)$user['id'], $permissionKey)) {
        header('HTTP/1.1 403 Forbidden');
        exit('Access denied');
    }
}
