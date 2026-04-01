<?php

declare(strict_types=1);

$flash = get_flash();
$isGuestPage = !$showSidebar;
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= e($pageTitle); ?> | <?= e((string) config('app_name')); ?></title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="<?= e(app_url('assets/css/app.css')); ?>">
</head>
<body>
<?php if ($isGuestPage): ?>
    <main class="auth-shell">
        <div class="container py-5">
            <?php if ($flash): ?>
                <?php require BASE_PATH . '/app/views/partials/flash.php'; ?>
            <?php endif; ?>
            <?= $content; ?>
        </div>
    </main>
<?php else: ?>
    <?php require BASE_PATH . '/app/views/partials/navbar.php'; ?>
    <main class="py-4">
        <div class="container">
            <?php if ($flash): ?>
                <?php require BASE_PATH . '/app/views/partials/flash.php'; ?>
            <?php endif; ?>
            <?= $content; ?>
        </div>
    </main>
    <?php require BASE_PATH . '/app/views/partials/footer.php'; ?>
<?php endif; ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
