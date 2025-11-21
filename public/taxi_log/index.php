<?php
require_once __DIR__ . '/../../core/helpers.php';
require_auth();
include __DIR__ . '/../includes/header.php';
include __DIR__ . '/../includes/sidebar.php';
?>
<div class="card">
    <h2>Taxi Log</h2>
    <p>Monitor rides, revenue, and frequent guests.</p>
    <div style="display:grid;grid-template-columns:repeat(4,1fr);gap:1rem;">
        <div><label>Driver</label><input id="driver"></div>
        <div><label>Guest</label><input id="guest"></div>
        <div><label>Month</label><input type="month" id="month"></div>
        <div><label>Status</label><select id="filter-status"><option value="">Any</option><option>active</option><option>deleted</option></select></div>
    </div>
</div>
<div class="card">
    <table class="table" id="taxi-table">
        <thead><tr><th>Date</th><th>Start</th><th>Destination</th><th>Guest</th><th>Driver</th><th>Price</th></tr></thead>
        <tbody></tbody>
    </table>
</div>
<script src="./script.js"></script>
<?php include __DIR__ . '/../includes/footer.php'; ?>
