<?php
$coverUrl = $game['image_url'] ?? '';
$coverProtocol = strtolower((string) parse_url($coverUrl, PHP_URL_SCHEME));
?>
<div class="game-cover">
    <img class="cover-placeholder" src="img/controller.svg" alt="" width="44" height="33">
    <?php if (filter_var($coverUrl, FILTER_VALIDATE_URL) && in_array($coverProtocol, ['http', 'https'], true)): ?>
        <img class="cover-image" src="<?= escapeHtml($coverUrl) ?>" alt="">
    <?php endif; ?>
</div>
