<?php
require_once __DIR__ . '/../../core/auth.php';
require_once __DIR__ . '/../../core/helpers.php';
require_auth();

$action = $_GET['action'] ?? ($_POST['action'] ?? '');
if ($action === 'save') {
    json_response(['success' => true, 'message' => 'Settings saved']);
}
json_response(['success' => false, 'message' => 'Unknown action']);
