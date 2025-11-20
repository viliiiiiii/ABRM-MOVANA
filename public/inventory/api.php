<?php
require_once __DIR__ . '/../../core/auth.php';
require_once __DIR__ . '/../../core/helpers.php';
require_once __DIR__ . '/../../core/csrf.php';
require_auth();

$action = $_GET['action'] ?? ($_POST['action'] ?? '');

switch ($action) {
    case 'list':
        json_response(['success' => true, 'data' => [
            ['name' => 'Towel', 'sku' => 'TW-01', 'qty' => 120, 'status' => 'active', 'alerts' => ''],
            ['name' => 'Kettle', 'sku' => 'KT-02', 'qty' => 2, 'status' => 'active', 'alerts' => 'Low stock'],
        ]]);
        break;
    case 'movements':
        json_response(['success' => true, 'data' => [
            ['date' => '2024-01-05', 'item' => 'Towel', 'from' => 'Store', 'to' => 'Room 501', 'qty' => 4, 'reason' => 'Issue to room'],
        ]]);
        break;
    case 'stocktakes':
        json_response(['success' => true, 'data' => [
            ['name' => 'Q1 Main Store', 'location' => 'Main', 'date' => '2024-01-15', 'status' => 'open'],
        ]]);
        break;
    default:
        json_response(['success' => false, 'message' => 'Unknown action']);
}
