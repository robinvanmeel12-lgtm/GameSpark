<?php

$pageTitle = 'Games | GameSpark';
$activePage = 'games';
$search = $_GET['q'] ?? '';
$search = is_string($search) ? trim($search) : '';

$sortOptions = [
    'latest' => ['Nieuwste', 'id DESC'],
    'name-asc' => ['Naam A–Z', 'name ASC, id DESC'],
    'name-desc' => ['Naam Z–A', 'name DESC, id DESC'],
    'year-desc' => ['Releasejaar aflopend', 'release_year DESC, id DESC'],
    'year-asc' => ['Releasejaar oplopend', 'release_year ASC, id DESC'],
    'rating-desc' => ['Rating hoog–laag', 'rating DESC, id DESC'],
    'rating-asc' => ['Rating laag–hoog', 'rating IS NULL, rating ASC, id DESC'],
];
$sort = $_GET['sort'] ?? 'latest';
if (!is_string($sort) || !isset($sortOptions[$sort])) {
    $sort = 'latest';
}

$query = 'SELECT * FROM gamedata';
$parameters = [];
if ($search !== '') {
    $query .= ' WHERE LOCATE(:name, name) > 0 OR CAST(release_year AS CHAR) = :year';
    $parameters = ['name' => $search, 'year' => $search];
}
$query .= ' ORDER BY ' . $sortOptions[$sort][1];

require_once __DIR__ . '/app/load-games.php';
require __DIR__ . '/resources/views/components/header.php';
?>
<main class="page-shell" id="inhoud">
    <section class="content-panel" aria-labelledby="games-title">
        <h1 id="games-title">Games</h1>
        <form class="game-filters" method="get" action="games.php">
            <div class="search-field">
                <button class="search-button" type="submit" aria-label="Zoeken"></button>
                <input type="search" name="q" aria-label="Zoek op naam of releasejaar" placeholder="Zoek een game..." value="<?= escapeHtml($search) ?>">
            </div>
            <label class="sort-field">
                Sorteer op
                <select name="sort" data-auto-submit>
                    <?php foreach ($sortOptions as $value => [$label]): ?>
                        <option value="<?= escapeHtml($value) ?>"<?= $value === $sort ? ' selected' : '' ?>><?= escapeHtml($label) ?></option>
                    <?php endforeach; ?>
                </select>
            </label>
        </form>

        <?php if (!$databaseUnavailable && $games === [] && $search !== ''): ?>
            <p class="message">Geen games gevonden voor ‘<?= escapeHtml($search) ?>’. <a href="games.php">Bekijk alle games</a>.</p>
        <?php else: ?>
            <?php require __DIR__ . '/resources/views/games/cards.php'; ?>
        <?php endif; ?>
    </section>
</main>
</body>
</html>
