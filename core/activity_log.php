<?php
require_once __DIR__ . '/db.php';
require_once __DIR__ . '/helpers.php';

function log_activity(int $userId, string $actionType, string $module, ?int $recordId, string $description, array $oldData = [], array $newData = []): void
{
    $pdo = get_pdo();
    $stmt = $pdo->prepare('INSERT INTO activity_log (user_id, action_type, module, record_id, description, old_data, new_data, ip, created_at) VALUES (:user_id, :action_type, :module, :record_id, :description, :old_data, :new_data, :ip, :created_at)');
    $stmt->execute([
        ':user_id' => $userId,
        ':action_type' => $actionType,
        ':module' => $module,
        ':record_id' => $recordId,
        ':description' => $description,
        ':old_data' => json_encode($oldData),
        ':new_data' => json_encode($newData),
        ':ip' => $_SERVER['REMOTE_ADDR'] ?? 'cli',
        ':created_at' => now(),
    ]);
}
