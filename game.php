<?php

$activePage = 'games';
$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT, ['options' => ['min_range' => 1]]);
$query = 'SELECT * FROM gamedata WHERE id = :id';
$parameters = ['id' => $id ?: 0];
require_once __DIR__ . '/app/load-games.php';

$game = $games[0] ?? null;
$pageTitle = ($game['name'] ?? 'Game') . ' | GameSpark';
if ($game === null && !$databaseUnavailable) {
    http_response_code(404);
}
require __DIR__ . '/resources/views/components/header.php';
?>
<main class="page-shell" id="inhoud">
    <section class="content-panel game-detail">
        <?php if ($databaseUnavailable): ?>
            <?php require __DIR__ . '/resources/views/components/database-error.php'; ?>
        <?php elseif ($game === null): ?>
            <h1>Game niet gevonden</h1>
            <a class="button button-secondary back-link" href="games.php">← Terug naar games</a>
        <?php else: ?>
            <a class="back-link" href="games.php">← Terug naar games</a>
            <div class="detail-header">
                <?php require __DIR__ . '/resources/views/games/cover.php'; ?>
                <div class="detail-info">
                    <h1><?= escapeHtml($game['name']) ?></h1>
                    <?php require __DIR__ . '/resources/views/games/rating.php'; ?>
                    <dl class="game-facts">
                        <dt>Genre</dt><dd><?= escapeHtml($game['genre'] ?? '—') ?></dd>
                        <dt>Release</dt><dd><?= (int) $game['release_year'] ?></dd>
                        <dt>Platform</dt><dd><?= escapeHtml($game['platform']) ?></dd>
                        <dt>Status</dt><dd><?= escapeHtml($game['status']) ?></dd>
                    </dl>
                </div>
            </div>
            <div class="detail-bottom">
                <div class="review-panel">
                    <h2>Review</h2>
                    <p>Er is nog geen review voor deze game.</p>
                </div>
                <div class="score-panel">
                    <h2>Eindscore</h2>
                    <?php if ($game['rating'] === null): ?>
                        <p>Nog niet beoordeeld</p>
                    <?php else: ?>
                        <p><strong><?= escapeHtml($game['rating']) ?></strong> / 10</p>
                    <?php endif; ?>
                </div>
            </div>
        <?php endif; ?>
    </section>
</main>
</body>
</html>
