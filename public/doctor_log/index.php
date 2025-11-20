<?php
require_once __DIR__ . '/../../core/helpers.php';
require_auth();
include __DIR__ . '/../includes/header.php';
include __DIR__ . '/../includes/sidebar.php';
?>
<div class="card">
    <h2>Doctor Log</h2>
    <p>Track medical calls and responses.</p>
    <table class="table" id="doctor-table">
        <thead><tr><th>Room</th><th>Time Called</th><th>Arrived</th><th>Doctor</th><th>Status</th></tr></thead>
        <tbody></tbody>
    </table>
</div>
<script src="./script.js"></script>
<?php include __DIR__ . '/../includes/footer.php'; ?>
