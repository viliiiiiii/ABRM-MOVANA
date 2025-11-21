<?php
require_once __DIR__ . '/../../core/helpers.php';
require_auth();
include __DIR__ . '/../includes/header.php';
include __DIR__ . '/../includes/sidebar.php';
?>
<div class="card">
    <div style="display:flex;justify-content:space-between;align-items:center;">
        <div>
            <h2>Lost &amp; Found</h2>
            <p>Track items lifecycle with photos, QR stickers, and release workflows.</p>
        </div>
        <button class="button" id="btn-add">Add Item</button>
    </div>
    <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:1rem;">
        <div>
            <label>Category</label>
            <input id="filter-category" placeholder="Category">
        </div>
        <div>
            <label>State</label>
            <select id="filter-state">
                <option value="">Any</option>
                <option>New</option>
                <option>Under review</option>
                <option>Stored</option>
                <option>Pending release</option>
                <option>Released</option>
                <option>Archived</option>
            </select>
        </div>
        <div>
            <label>Date range</label>
            <input type="date" id="filter-date">
        </div>
    </div>
</div>
<div class="card" id="lf-results">
    <table class="table">
        <thead>
            <tr><th>Description</th><th>State</th><th>Location</th><th>Updated</th></tr>
        </thead>
        <tbody></tbody>
    </table>
</div>
<script src="./script.js"></script>
<?php include __DIR__ . '/../includes/footer.php'; ?>
