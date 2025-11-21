<?php
require_once __DIR__ . '/../../core/helpers.php';
require_auth();
include __DIR__ . '/../includes/header.php';
include __DIR__ . '/../includes/sidebar.php';
?>
<div class="card">
    <h2>CMS / Settings</h2>
    <p>Adjust system themes, banners, and maintenance tasks.</p>
    <form id="cms-form">
        <label>System Message</label><input name="message" placeholder="Banner text">
        <label>Default Theme</label><select name="default_theme"><option value="light">Light</option><option value="dark">Dark</option></select>
        <button class="button" style="margin-top:1rem;">Save</button>
    </form>
</div>
<script src="./script.js"></script>
<?php include __DIR__ . '/../includes/footer.php'; ?>
