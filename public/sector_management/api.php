<?php
require_once __DIR__ . '/../../core/auth.php';
require_once __DIR__ . '/../../core/helpers.php';
require_auth();

$action = $_GET['action'] ?? '';
if ($action === 'list') {
    json_response(['success' => true, 'data' => [
        ['name' => 'Front Desk', 'status' => 'active', 'supervisors' => 'Alice'],
        ['name' => 'Housekeeping', 'status' => 'active', 'supervisors' => 'Bob'],
    ]]);
}
json_response(['success' => false, 'message' => 'Unknown action']);
