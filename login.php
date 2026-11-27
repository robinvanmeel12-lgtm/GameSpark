<?php

require_once __DIR__ . '/app/helpers.php';
require_once __DIR__ . '/app/session.php';

$loggedIn = isset($_SESSION['admin_id']);
$username = '';
$message = '';

if (!$loggedIn && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $username = is_string($username) ? trim($username) : '';
    $password = $_POST['password'] ?? '';
    $password = is_string($password) ? $password : '';

    if ($username === '' || $password === '') {
        $message = 'Vul je gebruikersnaam en wachtwoord in.';
    } else {
        try {
            // 1. Verbinding
            require_once __DIR__ . '/config/conn.php';

            // 2. Query
            $query = 'SELECT id, username, password_hash FROM admins WHERE username = :username';

            // 3. Prepare
            $statement = $conn->prepare($query);

            // 4. Execute
            $statement->execute(['username' => $username]);

            // 5. Fetch en wachtwoordcontrole
            $admin = $statement->fetch();
            $validPassword = $admin && strlen($password) <= 72 && !str_contains($password, "\0")
                && password_verify($password, $admin['password_hash']);

            if ($validPassword) {
                if (!session_regenerate_id(true)) {
                    throw new RuntimeException('Could not regenerate the admin session.');
                }

                $_SESSION['admin_id'] = (int) $admin['id'];
                $_SESSION['admin_username'] = $admin['username'];
                header('Location: login.php', true, 303);
                exit;
            }

            $message = 'Onjuiste gebruikersnaam of wachtwoord.';
        } catch (RuntimeException $exception) {
            error_log('GameSpark login failed: ' . $exception->getMessage());
            http_response_code(503);
            $message = 'Inloggen is tijdelijk niet beschikbaar. Probeer het later opnieuw.';
        }
    }
}

$pageTitle = $loggedIn ? 'Admin | GameSpark' : 'Inloggen | GameSpark';
$activePage = 'login';
require __DIR__ . '/resources/views/components/header.php';
?>
<main class="page-shell login-page" id="inhoud">
    <section class="content-panel" aria-labelledby="login-title">
        <?php if ($loggedIn): ?>
            <h1 id="login-title">Admin</h1>
            <div class="login-form">
                <p class="message" role="status">Je bent ingelogd als <?= escapeHtml($_SESSION['admin_username']) ?>.</p>
            </div>
        <?php else: ?>
            <h1 id="login-title">Inloggen</h1>

            <form class="login-form" action="login.php" method="post">
                <div class="login-field">
                    <label for="username">Gebruikersnaam</label>
                    <input type="text" id="username" name="username" autocomplete="username" value="<?= escapeHtml($username) ?>" required>
                </div>

                <div class="login-field">
                    <label for="password">Wachtwoord</label>
                    <input type="password" id="password" name="password" autocomplete="current-password" required>
                </div>

                <button class="button button-primary" type="submit">Inloggen</button>

                <?php if ($message !== ''): ?>
                    <p class="message" role="status"><?= escapeHtml($message) ?></p>
                <?php endif; ?>
            </form>
        <?php endif; ?>
    </section>
</main>
</body>
</html>
