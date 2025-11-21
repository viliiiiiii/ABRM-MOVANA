<?php
require_once __DIR__ . '/../../core/helpers.php';
require_auth();
include __DIR__ . '/../includes/header.php';
include __DIR__ . '/../includes/sidebar.php';
?>
<div class="card">
    <h2>User Activity</h2>
    <p>Audit trail of critical actions.</p>
    <table class="table" id="activity-table">
        <thead><tr><th>User</th><th>Action</th><th>Module</th><th>At</th></tr></thead>
        <tbody></tbody>
    </table>
</div>
<script src="./script.js"></script>
<?php include __DIR__ . '/../includes/footer.php'; ?>
