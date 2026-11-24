<?php

$configPath = __DIR__ . '/config.php';

if (!is_file($configPath)) {
    throw new RuntimeException('Create config/config.php with your local MySQL settings.');
}

require_once $configPath;

$dsn = "mysql:host={$dbHost};port={$dbPort};dbname={$dbName};charset=utf8mb4";

$conn = new PDO($dsn, $dbUser, $dbPass, [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false,
]);
