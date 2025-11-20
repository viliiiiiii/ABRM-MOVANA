<?php
require_once __DIR__ . '/../../core/helpers.php';
$id = (int)($_GET['id'] ?? 0);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sticker</title>
    <style>body{font-family:monospace;padding:10px;} .box{border:1px dashed #333;padding:10px;width:260px;}</style>
</head>
<body>
<div class="box">
    <strong>Lost &amp; Found</strong>
    <div>ID: <?php echo e((string)$id); ?></div>
    <div>Scan QR to view item.</div>
</div>
</body>
</html>
