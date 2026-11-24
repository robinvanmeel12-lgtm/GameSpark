<?php if ($databaseUnavailable): ?>
    <?php require __DIR__ . '/../components/database-error.php'; ?>
<?php elseif ($games === []): ?>
    <p class="message">Er zijn nog geen games opgeslagen.</p>
<?php else: ?>
    <ul class="game-grid">
        <?php foreach ($games as $game): ?>
            <li>
                <a class="game-card" href="game.php?id=<?= (int) $game['id'] ?>">
                    <?php require __DIR__ . '/cover.php'; ?>
                    <div class="game-card-content">
                        <h3><?= escapeHtml($game['name']) ?></h3>
                        <p class="game-meta">
                            <?= escapeHtml($game['platform']) ?><?php if (!empty($game['genre'])): ?> · <?= escapeHtml($game['genre']) ?><?php endif; ?>
                        </p>
                        <?php require __DIR__ . '/rating.php'; ?>
                        <span class="status-label"><?= escapeHtml($game['status']) ?></span>
                        <span class="button button-secondary card-action">Bekijk Game <span aria-hidden="true">→</span></span>
                    </div>
                    <span class="card-chevron" aria-hidden="true">›</span>
                </a>
            </li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>
