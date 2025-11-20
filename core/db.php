<?php
require_once __DIR__ . '/helpers.php';

function get_pdo(): PDO
{
    static $pdo;
    if ($pdo === null) {
        $config = app_config();
        $pdo = new PDO(
            $config['db']['dsn'],
            $config['db']['user'],
            $config['db']['pass'],
            $config['db']['options']
        );
    }
    return $pdo;
}
