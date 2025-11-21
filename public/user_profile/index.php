<?php
require_once __DIR__ . '/../../core/helpers.php';
require_auth();
$user = current_user();
include __DIR__ . '/../includes/header.php';
include __DIR__ . '/../includes/sidebar.php';
?>
<div class="card">
    <h2>User Profile</h2>
    <p>Manage your account, preferences, and security.</p>
    <div><strong>Name:</strong> <?php echo e($user['name'] ?? ''); ?></div>
    <div><strong>Email:</strong> <?php echo e($user['email'] ?? ''); ?></div>
    <div><strong>Theme:</strong> <?php echo e($user['theme'] ?? 'light'); ?></div>
</div>
<div class="card">
    <form id="profile-form">
        <label>Name</label><input name="name" value="<?php echo e($user['name'] ?? ''); ?>">
        <label>Email</label><input name="email" value="<?php echo e($user['email'] ?? ''); ?>">
        <label>Theme</label><select name="theme"><option value="light">Light</option><option value="dark">Dark</option></select>
        <button class="button" style="margin-top:1rem;">Save</button>
    </form>
</div>
<script src="./script.js"></script>
<?php include __DIR__ . '/../includes/footer.php'; ?>
