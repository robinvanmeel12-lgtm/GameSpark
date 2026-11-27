<?php
if (!isset($pageTitle, $activePage)) {
    http_response_code(404);
    return;
}

require_once __DIR__ . '/../../../app/helpers.php';
require_once __DIR__ . '/../../../app/session.php';
$loginLabel = isset($_SESSION['admin_id']) ? 'Admin' : 'Inloggen';
?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= escapeHtml($pageTitle) ?></title>
    <link rel="stylesheet" href="css/style.css">
    <script src="js/site.js" defer></script>
</head>
<body>
<header class="site-header">
    <div class="header-inner">
        <a class="site-brand" href="index.php">
            <img src="img/controller.svg" alt="" width="34" height="26">
            GameSpark
        </a>

        <nav class="desktop-nav" aria-label="Hoofdnavigatie">
            <a href="index.php"<?= $activePage === 'home' ? ' aria-current="page"' : '' ?>>Home</a>
            <a href="games.php"<?= $activePage === 'games' ? ' aria-current="page"' : '' ?>>Games</a>
            <a href="login.php"<?= $activePage === 'login' ? ' aria-current="page"' : '' ?>><?= $loginLabel ?></a>
        </nav>

        <details class="mobile-menu">
            <summary aria-label="Navigatiemenu"><span class="menu-icon" aria-hidden="true"></span></summary>
            <nav aria-label="Mobiele navigatie">
                <a href="index.php"<?= $activePage === 'home' ? ' aria-current="page"' : '' ?>>Home</a>
                <a href="games.php"<?= $activePage === 'games' ? ' aria-current="page"' : '' ?>>Games</a>
                <a href="login.php"<?= $activePage === 'login' ? ' aria-current="page"' : '' ?>><?= $loginLabel ?></a>
            </nav>
        </details>
    </div>
</header>
