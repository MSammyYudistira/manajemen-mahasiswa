<?php

declare(strict_types=1);

$stmt = db()->query(
    'SELECT p.id_prodi, p.nama_prodi, j.nama_jurusan
     FROM prodi p
     INNER JOIN jurusan j ON j.id_jurusan = p.id_jurusan
     ORDER BY p.id_prodi ASC'
);
$prodi = $stmt->fetchAll();

ob_start();
?>
<section class="page-heading">
    <div>
        <h1>Data Prodi</h1>
        <p>Kelola program studi yang terhubung dengan jurusan terkait.</p>
    </div>
    <a class="btn btn-primary" href="index.php?route=prodi-create">Tambah Prodi</a>
</section>

<div class="table-wrap">
    <div class="table-responsive">
        <table class="table align-middle">
            <thead>
            <tr>
                <th>ID</th>
                <th>Nama Prodi</th>
                <th>Jurusan</th>
                <th class="text-end">Aksi</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($prodi as $item): ?>
                <tr>
                    <td><?= e((string) $item['id_prodi']); ?></td>
                    <td><?= e($item['nama_prodi']); ?></td>
                    <td><?= e($item['nama_jurusan']); ?></td>
                    <td class="text-end">
                        <a class="btn btn-sm btn-outline-primary" href="index.php?route=prodi-edit&id=<?= e((string) $item['id_prodi']); ?>">Edit</a>
                        <form class="d-inline" method="post" action="index.php?route=prodi-delete&id=<?= e((string) $item['id_prodi']); ?>" onsubmit="return confirm('Hapus prodi ini?');">
                            <input type="hidden" name="_token" value="<?= e(csrf_token()); ?>">
                            <button class="btn btn-sm btn-outline-danger" type="submit">Hapus</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<?php
$content = (string) ob_get_clean();
render('Data Prodi', $content);
