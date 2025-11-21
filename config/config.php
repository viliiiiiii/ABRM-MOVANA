<?php
// Global application configuration
return [
    'app_name' => 'ABRM Management',
    'base_url' => '/public',
    'db' => [
        'dsn' => 'mysql:host=localhost;dbname=abrm;charset=utf8mb4',
        'user' => 'abrm_user',
        'pass' => 'change_me',
        'options' => [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ],
    ],
    'minio' => [
        'endpoint' => 'http://localhost:9000',
        'access_key' => 'minio_access_key',
        'secret_key' => 'minio_secret_key',
        'bucket' => 'abrm-files',
        'use_path_style' => true,
    ],
    'security' => [
        'session_name' => 'abrm_session',
        'csrf_token_key' => 'abrm_csrf',
        'failed_login_limit' => 5,
        'lockout_minutes' => 15,
    ],
];
