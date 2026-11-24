<?php

$configPath = __DIR__ . '/config.php';

if (!is_file($configPath)) {
    throw new RuntimeException('Create config/config.php with your local MySQL settings.');
}

require_once $configPath;

$conn = new PDO("mysql:host=$dbHost;port=$dbPort;dbname=$dbName;charset=utf8mb4", $dbUser, $dbPass);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
$conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
