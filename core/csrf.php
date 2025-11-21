<?php
require_once __DIR__ . '/helpers.php';

function csrf_token(): string
{
    $config = app_config();
    if (empty($_SESSION[$config['security']['csrf_token_key']])) {
        $_SESSION[$config['security']['csrf_token_key']] = bin2hex(random_bytes(32));
    }
    return $_SESSION[$config['security']['csrf_token_key']];
}

function csrf_input(): string
{
    return '<input type="hidden" name="csrf_token" value="' . e(csrf_token()) . '">';
}

function csrf_validate(): bool
{
    $config = app_config();
    $token = $_POST['csrf_token'] ?? $_SERVER['HTTP_X_CSRF_TOKEN'] ?? '';
    return hash_equals($_SESSION[$config['security']['csrf_token_key']] ?? '', $token);
}

function require_csrf(): void
{
    if (!csrf_validate()) {
        json_response(['success' => false, 'message' => 'Invalid CSRF token']);
    }
}
