<?php
require_once __DIR__ . '/../../core/helpers.php';
require_auth();
include __DIR__ . '/../includes/header.php';
include __DIR__ . '/../includes/sidebar.php';
?>
<div class="card">
    <h2>User Management</h2>
    <p>Control access, roles, and lockouts.</p>
    <table class="table" id="users-table">
        <thead><tr><th>Name</th><th>Email</th><th>Role</th><th>Status</th></tr></thead>
        <tbody></tbody>
    </table>
</div>
<script src="./script.js"></script>
<?php include __DIR__ . '/../includes/footer.php'; ?>
