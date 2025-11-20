<?php
require_once __DIR__ . '/../../core/helpers.php';
require_auth();
include __DIR__ . '/../includes/header.php';
include __DIR__ . '/../includes/sidebar.php';
?>
<div class="card">
    <h2>Inventory</h2>
    <p>Overview of stock levels with alerts.</p>
    <div style="display:grid;grid-template-columns:repeat(4,1fr);gap:1rem;">
        <div><label>Name</label><input id="inv-name"></div>
        <div><label>Category</label><input id="inv-category"></div>
        <div><label>Status</label><select id="inv-status"><option value="">Any</option><option>active</option><option>archived</option></select></div>
        <div><label>Condition</label><select id="inv-condition"><option value="">Any</option><option>new</option><option>used</option><option>damaged</option></select></div>
    </div>
</div>
<div class="card">
    <table class="table" id="inventory-table">
        <thead><tr><th>Name</th><th>SKU</th><th>Qty</th><th>Status</th><th>Alerts</th></tr></thead>
        <tbody></tbody>
    </table>
</div>
<script src="./script.js"></script>
<?php include __DIR__ . '/../includes/footer.php'; ?>
