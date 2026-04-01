<?php

declare(strict_types=1);

$flashType = $flash['type'] === 'success' ? 'success' : ($flash['type'] === 'warning' ? 'warning' : 'danger');
?>
<div class="alert alert-<?= e($flashType); ?> alert-dismissible fade show" role="alert">
    <?= e($flash['message']); ?>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
