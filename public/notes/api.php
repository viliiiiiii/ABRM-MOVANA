<?php
require_once __DIR__ . '/../../core/auth.php';
require_once __DIR__ . '/../../core/helpers.php';
require_auth();

$action = $_GET['action'] ?? ($_POST['action'] ?? '');
if ($action === 'list') {
    json_response(['success' => true, 'data' => [
        ['id' => 1, 'title' => 'Daily briefing', 'type' => 'Team', 'tags' => 'ops', 'reminder' => '2024-02-01 09:00'],
    ]]);
}
json_response(['success' => false, 'message' => 'Unknown action']);
