<?php

declare(strict_types=1);

$id = (int) ($_GET['id'] ?? 0);

if (!is_post()) {
    redirect('index.php?route=prodi');
}

verify_csrf();

$check = db()->prepare('SELECT COUNT(*) FROM mahasiswa WHERE id_prodi = :id');
$check->execute(['id' => $id]);

if ((int) $check->fetchColumn() > 0) {
    set_flash('warning', 'Prodi tidak bisa dihapus karena masih memiliki data mahasiswa.');
    redirect('index.php?route=prodi');
}

$stmt = db()->prepare('DELETE FROM prodi WHERE id_prodi = :id');
$stmt->execute(['id' => $id]);

set_flash('success', 'Data prodi berhasil dihapus.');
redirect('index.php?route=prodi');
