<?php

$pageTitle = 'GameSpark';
$activePage = 'home';
$query = 'SELECT * FROM gamedata ORDER BY id DESC LIMIT 3';
require_once __DIR__ . '/app/load-games.php';
require __DIR__ . '/resources/views/components/header.php';
?>
<main class="page-shell home-page" id="inhoud">
    <section class="hero" aria-labelledby="home-title">
        <div class="hero-content">
            <h1 id="home-title">GameSpark</h1>
            <p>Game reviews, ratings en een overzicht van toegevoegde games.</p>
            <div class="hero-actions">
                <a class="button button-primary" href="games.php">Bekijk Games</a>
                <a class="button button-outline" href="#laatste-games">Laatste Games</a>
            </div>
        </div>
    </section>

    <section class="recent-games" id="laatste-games" aria-labelledby="recent-title">
        <h2 id="recent-title">Recent toegevoegde games</h2>
        <?php require __DIR__ . '/resources/views/games/cards.php'; ?>
        <a class="button button-secondary all-games-link" href="games.php">Bekijk Alle Games</a>
    </section>
</main>
</body>
</html>
