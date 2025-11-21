<?php
require_once __DIR__ . '/../../core/helpers.php';
require_auth();
include __DIR__ . '/../includes/header.php';
include __DIR__ . '/../includes/sidebar.php';
?>
<div class="card">
    <h2>Sector Management</h2>
    <p>Organize teams and supervisors.</p>
    <table class="table" id="sector-table">
        <thead><tr><th>Name</th><th>Status</th><th>Supervisors</th></tr></thead>
        <tbody></tbody>
    </table>
</div>
<script src="./script.js"></script>
<?php include __DIR__ . '/../includes/footer.php'; ?>
