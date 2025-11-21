<?php
require_once __DIR__ . '/../../core/auth.php';
require_once __DIR__ . '/../../core/helpers.php';
require_auth();

$action = $_GET['action'] ?? '';
if ($action === 'list') {
    json_response(['success' => true, 'data' => [
        ['user' => 'Admin', 'action' => 'login', 'module' => 'auth', 'at' => '2024-02-01 10:00'],
    ]]);
}
json_response(['success' => false, 'message' => 'Unknown action']);
