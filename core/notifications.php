<?php
require_once __DIR__ . '/db.php';
require_once __DIR__ . '/helpers.php';

function create_notification(int $userId, string $message, string $link = '#', string $type = 'info'): void
{
    $pdo = get_pdo();
    $stmt = $pdo->prepare('INSERT INTO notifications (user_id, message, link, type, is_read, created_at) VALUES (:user_id, :message, :link, :type, 0, :created_at)');
    $stmt->execute([
        ':user_id' => $userId,
        ':message' => $message,
        ':link' => $link,
        ':type' => $type,
        ':created_at' => now(),
    ]);
}

function unread_notifications(int $userId): array
{
    $pdo = get_pdo();
    $stmt = $pdo->prepare('SELECT * FROM notifications WHERE user_id = :user_id AND is_read = 0 ORDER BY created_at DESC LIMIT 10');
    $stmt->execute([':user_id' => $userId]);
    return $stmt->fetchAll();
}
