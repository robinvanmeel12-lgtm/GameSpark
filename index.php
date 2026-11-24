<?php

require_once __DIR__ . '/app/helpers.php';

$databaseUnavailable = false;

try {
    // 1. Verbinding
    require_once __DIR__ . '/config/conn.php';

    // 2. Query
    $query = 'SELECT * FROM gamedata ORDER BY id DESC';

    // 3. Prepare
    $statement = $conn->prepare($query);

    // 4. Execute
    $statement->execute();

    // 5. FetchAll
    $games = $statement->fetchAll();
} catch (RuntimeException $exception) {
    error_log('GameSpark could not load games: ' . $exception->getMessage());
    http_response_code(503);
    $databaseUnavailable = true;
}
?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GameSpark</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <main class="games-overview">
        <h1>GameSpark</h1>

        <?php if ($databaseUnavailable): ?>
            <section class="database-error" aria-labelledby="database-error-title">
                <h2 id="database-error-title">Games tijdelijk niet beschikbaar</h2>
                <p>Probeer het over een paar minuten opnieuw.</p>
                <a class="database-error-retry" href="index.php">Opnieuw proberen</a>
            </section>
        <?php elseif ($games === []): ?>
            <p>Er zijn nog geen games opgeslagen.</p>
        <?php else: ?>
            <div class="games-table-wrapper">
                <table class="games-table" aria-label="Opgeslagen games">
                    <thead>
                        <tr>
                            <th scope="col">Naam</th>
                            <th scope="col">Platform</th>
                            <th scope="col">Genre</th>
                            <th scope="col">Releasejaar</th>
                            <th scope="col">Status</th>
                            <th scope="col">Beoordeling</th>
                            <th scope="col">Afbeeldings-URL</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($games as $game): ?>
                            <tr>
                                <td><?= escapeHtml($game['name']) ?></td>
                                <td><?= escapeHtml($game['platform']) ?></td>
                                <td><?= escapeHtml($game['genre'] ?? '—') ?></td>
                                <td><?= (int) $game['release_year'] ?></td>
                                <td><?= escapeHtml($game['status']) ?></td>
                                <td><?= $game['rating'] === null ? '—' : escapeHtml($game['rating']) . ' / 10' ?></td>
                                <td class="game-image-url"><?= escapeHtml($game['image_url'] ?? '—') ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </main>
</body>
</html>
