<?php
require_once __DIR__ . '/../../core/auth.php';
require_once __DIR__ . '/../../core/helpers.php';
require_once __DIR__ . '/../../core/csrf.php';
require_auth();

$action = $_GET['action'] ?? ($_POST['action'] ?? '');

switch ($action) {
    case 'list':
        json_response(['success' => true, 'data' => [
            ['date' => '2024-01-01 10:00', 'start' => 'Lobby', 'destination' => 'Airport', 'guest' => 'Room 501', 'driver' => 'Ali', 'price' => 45],
        ]]);
        break;
    default:
        json_response(['success' => false, 'message' => 'Unknown action']);
}
