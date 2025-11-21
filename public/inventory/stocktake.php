<?php
require_once __DIR__ . '/../../core/helpers.php';
require_auth();
include __DIR__ . '/../includes/header.php';
include __DIR__ . '/../includes/sidebar.php';
?>
<div class="card">
    <h2>Stocktake Sessions</h2>
    <p>Run counts and capture variances.</p>
    <table class="table" id="stocktake-table">
        <thead><tr><th>Name</th><th>Location</th><th>Date</th><th>Status</th></tr></thead>
        <tbody></tbody>
    </table>
</div>
<script src="./script.js"></script>
<?php include __DIR__ . '/../includes/footer.php'; ?>
