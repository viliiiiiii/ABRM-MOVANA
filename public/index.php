<?php
require_once __DIR__ . '/../core/auth.php';
require_once __DIR__ . '/../core/helpers.php';
if (is_logged_in()) {
    header('Location: ' . base_url('landing'));
    exit;
}
header('Location: ' . base_url('login'));
