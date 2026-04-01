<?php

declare(strict_types=1);

$keyword = trim($_GET['q'] ?? '');
$stmt = db()->prepare(
    'SELECT j.id_jurusan, j.nama_jurusan, COUNT(p.id_prodi) AS total_prodi
     FROM jurusan j
     LEFT JOIN prodi p ON p.id_jurusan = j.id_jurusan
     WHERE j.nama_jurusan LIKE :keyword
     GROUP BY j.id_jurusan, j.nama_jurusan
     ORDER BY j.id_jurusan ASC'
);
$stmt->execute(['keyword' => '%' . $keyword . '%']);
$jurusan = $stmt->fetchAll();

ob_start();
?>
<section class="page-heading">
    <div>
        <h1>Data Jurusan</h1>
        <p>Kelola kategori jurusan yang menjadi induk dari setiap program studi.</p>
    </div>
    <a class="btn btn-primary" href="index.php?route=jurusan-create">Tambah Jurusan</a>
</section>

<div class="card section-card border-0 mb-4">
    <form class="row g-3 align-items-end" method="get">
        <input type="hidden" name="route" value="jurusan">
        <div class="col-md-9">
            <label class="form-label" for="q">Cari Jurusan</label>
            <input class="form-control" id="q" type="text" name="q" value="<?= e($keyword); ?>" placeholder="Contoh: Teknik Informatika">
        </div>
        <div class="col-md-3 d-grid">
            <button class="btn btn-outline-primary" type="submit">Filter</button>
        </div>
    </form>
</div>

<div class="table-wrap">
    <div class="table-responsive">
        <table class="table align-middle">
            <thead>
            <tr>
                <th>ID</th>
                <th>Nama Jurusan</th>
                <th>Total Prodi</th>
                <th class="text-end">Aksi</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($jurusan as $item): ?>
                <tr>
                    <td><?= e((string) $item['id_jurusan']); ?></td>
                    <td><?= e($item['nama_jurusan']); ?></td>
                    <td><?= e((string) $item['total_prodi']); ?></td>
                    <td class="text-end">
                        <a class="btn btn-sm btn-outline-primary" href="index.php?route=jurusan-edit&id=<?= e((string) $item['id_jurusan']); ?>">Edit</a>
                        <form class="d-inline" method="post" action="index.php?route=jurusan-delete&id=<?= e((string) $item['id_jurusan']); ?>" onsubmit="return confirm('Hapus jurusan ini?');">
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
render('Data Jurusan', $content);
