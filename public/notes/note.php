<?php
require_once __DIR__ . '/../../core/helpers.php';
require_auth();
$id = $_GET['id'] ?? 'new';
include __DIR__ . '/../includes/header.php';
include __DIR__ . '/../includes/sidebar.php';
?>
<div class="card">
    <h2>Note <?php echo e($id); ?></h2>
    <form id="note-form">
        <label>Title</label>
        <input name="title" required>
        <label>Body</label>
        <textarea name="body" rows="6"></textarea>
        <label>Reminder</label>
        <input type="datetime-local" name="reminder">
        <button class="button" style="margin-top:1rem;">Save</button>
    </form>
</div>
<script src="./script.js"></script>
<?php include __DIR__ . '/../includes/footer.php'; ?>
