<?php
$config = require __DIR__ . '/../config/config.php';

function app_config(): array
{
    static $config;
    if ($config === null) {
        $config = require __DIR__ . '/../config/config.php';
    }
    return $config;
}

function base_url(string $path = ''): string
{
    $config = app_config();
    $base = rtrim($config['base_url'], '/');
    return $base . '/' . ltrim($path, '/');
}

function e(string $value = ''): string
{
    return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
}

function json_response(array $payload): void
{
    header('Content-Type: application/json');
    echo json_encode($payload);
    exit;
}

function require_auth(): void
{
    require_once __DIR__ . '/auth.php';
    if (!is_logged_in()) {
        header('Location: ' . base_url('login'));
        exit;
    }
}

function current_user(): ?array
{
    return $_SESSION['user'] ?? null;
}

function now(): string
{
    return (new DateTimeImmutable('now'))->format('Y-m-d H:i:s');
}
