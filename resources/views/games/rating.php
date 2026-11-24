<?php if ($game['rating'] === null): ?>
    <p class="rating rating-unrated">Nog niet beoordeeld</p>
<?php else: ?>
    <p class="rating">
        <span class="rating-stars" aria-hidden="true">
            ☆☆☆☆☆<span class="rating-fill" style="--rating-width: <?= (float) $game['rating'] * 10 ?>%">★★★★★</span>
        </span>
        <span><?= escapeHtml($game['rating']) ?> / 10</span>
    </p>
<?php endif; ?>
