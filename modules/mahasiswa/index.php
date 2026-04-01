<?php

declare(strict_types=1);

$keyword = trim($_GET['q'] ?? '');
$stmt = db()->prepare(
    'SELECT m.nim, m.nama_mahasiswa, m.alamat, m.no_hp, p.nama_prodi, j.nama_jurusan
     FROM mahasiswa m
     INNER JOIN prodi p ON p.id_prodi = m.id_prodi
     INNER JOIN jurusan j ON j.id_jurusan = p.id_jurusan
     WHERE m.nim LIKE :keyword OR m.nama_mahasiswa LIKE :keyword
     ORDER BY m.nim ASC'
);
$stmt->execute(['keyword' => '%' . $keyword . '%']);
$mahasiswa = $stmt->fetchAll();

ob_start();
?>
<section class="page-heading">
    <div>
        <h1>Data Mahasiswa</h1>
        <p>Kelola identitas mahasiswa beserta relasi program studinya.</p>
    </div>
    <a class="btn btn-primary" href="index.php?route=mahasiswa-create">Tambah Mahasiswa</a>
</section>

<div class="card section-card border-0 mb-4">
    <form class="row g-3 align-items-end" method="get">
        <input type="hidden" name="route" value="mahasiswa">
        <div class="col-md-9">
            <label class="form-label" for="q">Cari Mahasiswa</label>
            <input class="form-control" id="q" type="text" name="q" value="<?= e($keyword); ?>" placeholder="Cari berdasarkan NIM atau nama">
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
                <th>NIM</th>
                <th>Nama</th>
                <th>Prodi</th>
                <th>Jurusan</th>
                <th>No. HP</th>
                <th class="text-end">Aksi</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($mahasiswa as $item): ?>
                <tr>
                    <td><?= e($item['nim']); ?></td>
                    <td>
                        <div class="fw-semibold"><?= e($item['nama_mahasiswa']); ?></div>
                        <div class="small text-body-secondary"><?= e($item['alamat']); ?></div>
                    </td>
                    <td><?= e($item['nama_prodi']); ?></td>
                    <td><?= e($item['nama_jurusan']); ?></td>
                    <td><?= e($item['no_hp']); ?></td>
                    <td class="text-end">
                        <a class="btn btn-sm btn-outline-primary" href="index.php?route=mahasiswa-edit&nim=<?= e($item['nim']); ?>">Edit</a>
                        <form class="d-inline" method="post" action="index.php?route=mahasiswa-delete&nim=<?= e($item['nim']); ?>" onsubmit="return confirm('Hapus data mahasiswa ini?');">
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
render('Data Mahasiswa', $content);
