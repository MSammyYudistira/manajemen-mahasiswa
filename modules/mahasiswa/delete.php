<?php

declare(strict_types=1);

$nim = trim($_GET['nim'] ?? '');

if (!is_post()) {
    redirect('index.php?route=mahasiswa');
}

verify_csrf();

$stmt = db()->prepare('DELETE FROM mahasiswa WHERE nim = :nim');
$stmt->execute(['nim' => $nim]);

set_flash('success', 'Data mahasiswa berhasil dihapus.');
redirect('index.php?route=mahasiswa');
