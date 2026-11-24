<?php

require_once __DIR__ . '/helpers.php';

$games = [];
$databaseUnavailable = false;

try {
    // 1. Verbinding
    require_once __DIR__ . '/../config/conn.php';

    // 2. De pagina geeft de query door.
    // 3. Prepare
    $statement = $conn->prepare($query);

    // 4. Execute
    $statement->execute($parameters ?? []);

    // 5. FetchAll
    $games = $statement->fetchAll();
} catch (RuntimeException $exception) {
    error_log('GameSpark could not load games: ' . $exception->getMessage());
    http_response_code(503);
    $databaseUnavailable = true;
}
