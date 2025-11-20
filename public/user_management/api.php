<?php
require_once __DIR__ . '/../../core/auth.php';
require_once __DIR__ . '/../../core/helpers.php';
require_auth();

$action = $_GET['action'] ?? '';
if ($action === 'list') {
    json_response(['success' => true, 'data' => [
        ['name' => 'Admin', 'email' => 'admin@example.com', 'role' => 'app_owner', 'status' => 'active'],
    ]]);
}
json_response(['success' => false, 'message' => 'Unknown action']);
