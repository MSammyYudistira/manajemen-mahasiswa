<?php

declare(strict_types=1);

$id = (int) ($_GET['id'] ?? 0);

if (!is_post()) {
    redirect('index.php?route=jurusan');
}

verify_csrf();

$check = db()->prepare('SELECT COUNT(*) FROM prodi WHERE id_jurusan = :id');
$check->execute(['id' => $id]);

if ((int) $check->fetchColumn() > 0) {
    set_flash('warning', 'Jurusan tidak bisa dihapus karena masih memiliki data prodi.');
    redirect('index.php?route=jurusan');
}

$stmt = db()->prepare('DELETE FROM jurusan WHERE id_jurusan = :id');
$stmt->execute(['id' => $id]);

set_flash('success', 'Data jurusan berhasil dihapus.');
redirect('index.php?route=jurusan');
