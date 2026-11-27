<?php

if (PHP_SAPI !== 'cli') {
    http_response_code(404);
    exit;
}

$password = rtrim((string) fgets(STDIN), "\r\n");
if ($password === '' || strlen($password) > 72 || str_contains($password, "\0")) {
    fwrite(STDERR, "Geef een geldig wachtwoord van maximaal 72 bytes.\n");
    exit(1);
}

// 1. Verbinding
require_once __DIR__ . '/../config/conn.php';

// 2. Maak een hash en gebruik die in de query.
$passwordHash = password_hash($password, PASSWORD_DEFAULT);
$query = 'INSERT INTO admins (username, password_hash)
          VALUES (:username, :password_hash)
          ON DUPLICATE KEY UPDATE password_hash = :new_password_hash';

// 3. Prepare
$statement = $conn->prepare($query);

// 4. Execute
$statement->execute([
    'username' => 'admin',
    'password_hash' => $passwordHash,
    'new_password_hash' => $passwordHash,
]);

echo "Wachtwoordhash opgeslagen voor admin.\n";
