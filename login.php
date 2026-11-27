<?php

require_once __DIR__ . '/app/helpers.php';

$pageTitle = 'Inloggen | GameSpark';
$activePage = 'login';
require __DIR__ . '/resources/views/components/header.php';
?>
<main class="page-shell login-page" id="inhoud">
    <section class="content-panel" aria-labelledby="login-title">
        <h1 id="login-title">Inloggen</h1>

        <form class="login-form" action="login.php" method="post">
            <div class="login-field">
                <label for="username">Gebruikersnaam</label>
                <input type="text" id="username" name="username" autocomplete="username" required>
            </div>

            <div class="login-field">
                <label for="password">Wachtwoord</label>
                <input type="password" id="password" name="password" autocomplete="current-password" required>
            </div>

            <button class="button button-primary" type="submit">Inloggen</button>

            <?php if ($_SERVER['REQUEST_METHOD'] === 'POST'): ?>
                <p class="message" role="status">Inloggen is nog niet beschikbaar.</p>
            <?php endif; ?>
        </form>
    </section>
</main>
</body>
</html>
