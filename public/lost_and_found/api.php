<?php
require_once __DIR__ . '/../../core/auth.php';
require_once __DIR__ . '/../../core/helpers.php';
require_once __DIR__ . '/../../core/csrf.php';
require_once __DIR__ . '/../../core/activity_log.php';
require_once __DIR__ . '/../../core/db.php';
require_auth();

$input = json_decode(file_get_contents('php://input'), true) ?? $_POST;
$action = $input['action'] ?? $_GET['action'] ?? '';
$user = current_user();
$pdo = get_pdo();

switch ($action) {
    case 'list':
        $stmt = $pdo->prepare('SELECT * FROM lost_items WHERE deleted_at IS NULL ORDER BY created_at DESC');
        $stmt->execute();
        json_response(['success' => true, 'data' => $stmt->fetchAll()]);
        break;
    case 'create':
        require_csrf();
        $stmt = $pdo->prepare('INSERT INTO lost_items (description, category, found_by, found_date, location, tags, high_value, possible_owner, reservation_reference, state, created_by) VALUES (:description, :category, :found_by, :found_date, :location, :tags, :high_value, :possible_owner, :reservation_reference, :state, :created_by)');
        $stmt->execute([
            ':description' => $input['description'] ?? '',
            ':category' => $input['category'] ?? null,
            ':found_by' => $input['found_by'] ?? null,
            ':found_date' => $input['found_date'] ?? null,
            ':location' => $input['location'] ?? null,
            ':tags' => $input['tags'] ?? null,
            ':high_value' => !empty($input['high_value']) ? 1 : 0,
            ':possible_owner' => $input['possible_owner'] ?? null,
            ':reservation_reference' => $input['reservation_reference'] ?? null,
            ':state' => $input['state'] ?? 'New',
            ':created_by' => $user['id'] ?? null,
        ]);
        $id = (int)$pdo->lastInsertId();
        log_activity((int)$user['id'], 'create', 'lost_and_found', $id, 'Created lost item');
        json_response(['success' => true, 'message' => 'Item created', 'data' => ['id' => $id]]);
        break;
    case 'update_state':
        require_csrf();
        $id = (int)($input['id'] ?? 0);
        $state = $input['state'] ?? 'New';
        $stmt = $pdo->prepare('UPDATE lost_items SET state = :state, updated_at = NOW() WHERE id = :id AND deleted_at IS NULL');
        $stmt->execute([':state' => $state, ':id' => $id]);
        log_activity((int)$user['id'], 'update', 'lost_and_found', $id, 'Changed state to ' . $state);
        json_response(['success' => true, 'message' => 'State updated']);
        break;
    case 'release':
        require_csrf();
        $id = (int)($input['id'] ?? 0);
        $releaseStmt = $pdo->prepare('INSERT INTO lost_item_releases (item_id, recipient_name, recipient_id, contact, staff_name, released_at) VALUES (:item_id, :recipient_name, :recipient_id, :contact, :staff_name, NOW())');
        $releaseStmt->execute([
            ':item_id' => $id,
            ':recipient_name' => $input['recipient_name'] ?? '',
            ':recipient_id' => $input['recipient_id'] ?? null,
            ':contact' => $input['contact'] ?? null,
            ':staff_name' => $input['staff_name'] ?? null,
        ]);
        $pdo->prepare("UPDATE lost_items SET state = 'Released', archived = 1 WHERE id = :id")
            ->execute([':id' => $id]);
        log_activity((int)$user['id'], 'update', 'lost_and_found', $id, 'Item released');
        json_response(['success' => true, 'message' => 'Item released']);
        break;
    case 'delete':
        require_csrf();
        $id = (int)($input['id'] ?? 0);
        $pdo->prepare('UPDATE lost_items SET deleted_at = NOW() WHERE id = :id')->execute([':id' => $id]);
        log_activity((int)$user['id'], 'delete', 'lost_and_found', $id, 'Soft deleted item');
        json_response(['success' => true, 'message' => 'Item deleted']);
        break;
    default:
        json_response(['success' => false, 'message' => 'Unknown action']);
}
