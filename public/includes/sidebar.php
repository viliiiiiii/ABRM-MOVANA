<?php
require_once __DIR__ . '/../../core/helpers.php';
$links = [
    'Landing' => 'landing',
    'Lost & Found' => 'lost_and_found',
    'Taxi Log' => 'taxi_log',
    'Inventory' => 'inventory',
    'Doctor Log' => 'doctor_log',
    'Notes' => 'notes',
    'User Profile' => 'user_profile',
    'User Activity' => 'user_activity',
    'User Management' => 'user_management',
    'Sector Management' => 'sector_management',
    'CMS' => 'cms'
];
?>
<aside class="sidebar">
    <?php foreach ($links as $label => $path): ?>
        <a class="nav-link" href="<?php echo base_url($path); ?>"><?php echo e($label); ?></a>
    <?php endforeach; ?>
</aside>
<main style="padding:1.5rem;">
