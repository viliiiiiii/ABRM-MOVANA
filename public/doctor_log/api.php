<?php
require_once __DIR__ . '/../../core/auth.php';
require_once __DIR__ . '/../../core/helpers.php';
require_auth();

$action = $_GET['action'] ?? '';
if ($action === 'list') {
    json_response(['success' => true, 'data' => [
        ['room' => '305', 'called' => '2024-01-03 12:00', 'arrived' => '2024-01-03 12:10', 'doctor' => 'Dr. Smith', 'status' => 'closed'],
    ]]);
}
json_response(['success' => false, 'message' => 'Unknown action']);
