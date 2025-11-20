<?php
require_once __DIR__ . '/../../core/auth.php';
require_once __DIR__ . '/../../core/helpers.php';
require_once __DIR__ . '/../../core/csrf.php';
require_once __DIR__ . '/../../core/activity_log.php';
require_auth();

$input = json_decode(file_get_contents('php://input'), true) ?? $_POST;
$action = $input['action'] ?? $_GET['action'] ?? '';
$user = current_user();

switch ($action) {
    case 'list':
        json_response(['success' => true, 'data' => [
            ['id' => 1, 'description' => 'Blue umbrella', 'state' => 'Stored', 'location' => 'Lobby'],
        ]]);
        break;
    case 'create':
        require_csrf();
        log_activity((int)$user['id'], 'create', 'lost_and_found', null, 'Created placeholder item');
        json_response(['success' => true, 'message' => 'Item created']);
        break;
    default:
        json_response(['success' => false, 'message' => 'Unknown action']);
}
