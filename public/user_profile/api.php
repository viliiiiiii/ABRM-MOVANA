<?php
require_once __DIR__ . '/../../core/auth.php';
require_once __DIR__ . '/../../core/helpers.php';
require_once __DIR__ . '/../../core/csrf.php';
require_auth();

$input = json_decode(file_get_contents('php://input'), true) ?? $_POST;
$action = $input['action'] ?? '';
$user = current_user();

switch ($action) {
    case 'set_theme':
        $_SESSION['user']['theme'] = $input['theme'] ?? 'light';
        json_response(['success' => true]);
        break;
    case 'update_profile':
        require_csrf();
        $_SESSION['user']['name'] = $input['name'] ?? $user['name'];
        $_SESSION['user']['email'] = $input['email'] ?? $user['email'];
        $_SESSION['user']['theme'] = $input['theme'] ?? $user['theme'];
        json_response(['success' => true, 'message' => 'Profile updated']);
        break;
    default:
        json_response(['success' => false, 'message' => 'Unknown action']);
}
