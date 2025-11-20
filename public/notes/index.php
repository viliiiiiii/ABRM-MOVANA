<?php
require_once __DIR__ . '/../../core/helpers.php';
require_auth();
include __DIR__ . '/../includes/header.php';
include __DIR__ . '/../includes/sidebar.php';
?>
<div class="card">
    <h2>Notes</h2>
    <p>Personal and team collaboration with reminders.</p>
    <button class="button" onclick="location.href='note.php?id=new'">New Note</button>
</div>
<div class="card">
    <table class="table" id="notes-table">
        <thead><tr><th>Title</th><th>Type</th><th>Tags</th><th>Reminder</th></tr></thead>
        <tbody></tbody>
    </table>
</div>
<script src="./script.js"></script>
<?php include __DIR__ . '/../includes/footer.php'; ?>
