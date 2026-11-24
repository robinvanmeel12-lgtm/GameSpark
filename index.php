<?php
try {
    require_once __DIR__ . '/config/conn.php';

    $statement = $conn->prepare(
        'SELECT name, platform, genre, release_year, status, rating, image_url
         FROM gamedata
         ORDER BY id DESC'
    );
    $statement->execute();
    $games = $statement->fetchAll();
} catch (RuntimeException $exception) {
    error_log('GameSpark could not load games: ' . $exception->getMessage());
    http_response_code(503);
    exit('De database is tijdelijk niet beschikbaar.');
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

        <?php if ($games === []): ?>
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
                                <td><?= htmlspecialchars($game['name']) ?></td>
                                <td><?= htmlspecialchars($game['platform']) ?></td>
                                <td><?= htmlspecialchars($game['genre'] ?? '—') ?></td>
                                <td><?= (int) $game['release_year'] ?></td>
                                <td><?= htmlspecialchars($game['status']) ?></td>
                                <td><?= $game['rating'] === null ? '—' : htmlspecialchars($game['rating']) . ' / 10' ?></td>
                                <td class="game-image-url"><?= htmlspecialchars($game['image_url'] ?? '—') ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </main>
</body>
</html>
