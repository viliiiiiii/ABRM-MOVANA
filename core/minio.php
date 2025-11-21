<?php
require_once __DIR__ . '/helpers.php';

function minio_client(): array
{
    $config = app_config();
    return $config['minio'];
}

function upload_to_minio(string $path, string $content): bool
{
    $storage = __DIR__ . '/../storage/temp/' . basename($path);
    return (bool)file_put_contents($storage, $content);
}
