<?php
require_once __DIR__ . '/../../core/helpers.php';
require_auth();
$id = (int)($_GET['id'] ?? 0);
include __DIR__ . '/../includes/header.php';
include __DIR__ . '/../includes/sidebar.php';
?>
<div class="card">
    <h2>Item #<?php echo e((string)$id); ?></h2>
    <p>Placeholder detail view. Use the API to load data dynamically.</p>
    <div id="item-detail"></div>
</div>
<script src="./script.js"></script>
<?php include __DIR__ . '/../includes/footer.php'; ?>
