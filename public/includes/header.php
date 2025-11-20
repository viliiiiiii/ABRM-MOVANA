<?php
require_once __DIR__ . '/../../core/helpers.php';
require_once __DIR__ . '/../../core/notifications.php';
$user = current_user();
$theme = $user['theme'] ?? 'light';
$notifications = $user ? unread_notifications((int)$user['id']) : [];
?>
<!DOCTYPE html>
<html lang="en" data-theme="<?php echo e($theme); ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/main.css'); ?>">
    <title>ABRM Management</title>
</head>
<body data-theme="<?php echo e($theme); ?>">
<header class="header">
    <div><strong>ABRM Management</strong></div>
    <div style="display:flex;gap:1rem;align-items:center;">
        <button type="button" data-toggle="theme" class="button" style="padding:0.35rem 0.75rem;">Theme</button>
        <div>🔔 <?php echo count($notifications); ?></div>
        <?php if ($user): ?>
            <div><?php echo e($user['name']); ?> (<a href="<?php echo base_url('login/logout.php'); ?>">Logout</a>)</div>
        <?php endif; ?>
    </div>
</header>
<div class="layout">
