<?php
require_once __DIR__ . '/../../core/helpers.php';
require_auth();
include __DIR__ . '/../includes/header.php';
include __DIR__ . '/../includes/sidebar.php';
?>
<div class="card">
    <h2>Inventory Movements</h2>
    <p>Track transfers and stock corrections.</p>
    <table class="table" id="movement-table">
        <thead><tr><th>Date</th><th>Item</th><th>From</th><th>To</th><th>Qty</th><th>Reason</th></tr></thead>
        <tbody></tbody>
    </table>
</div>
<script src="./script.js"></script>
<?php include __DIR__ . '/../includes/footer.php'; ?>
