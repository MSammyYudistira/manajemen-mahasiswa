<?php

declare(strict_types=1);

$counts = [
    'jurusan' => (int) db()->query('SELECT COUNT(*) FROM jurusan')->fetchColumn(),
    'prodi' => (int) db()->query('SELECT COUNT(*) FROM prodi')->fetchColumn(),
    'mahasiswa' => (int) db()->query('SELECT COUNT(*) FROM mahasiswa')->fetchColumn(),
];

$latestStudents = db()->query(
    'SELECT m.nim, m.nama_mahasiswa, p.nama_prodi, j.nama_jurusan
     FROM mahasiswa m
     INNER JOIN prodi p ON p.id_prodi = m.id_prodi
     INNER JOIN jurusan j ON j.id_jurusan = p.id_jurusan
     ORDER BY m.nim DESC
     LIMIT 5'
)->fetchAll();

ob_start();
?>
<section class="page-heading">
    <div>
        <h1>Dashboard</h1>
        <p>Ringkasan data akademik dan akses cepat ke modul pengelolaan utama.</p>
    </div>
</section>

<div class="row g-4 mb-4">
    <div class="col-md-4">
        <div class="stat-card">
            <div class="stat-label">Total Jurusan</div>
            <div class="stat-value"><?= $counts['jurusan']; ?></div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="stat-card">
            <div class="stat-label">Total Prodi</div>
            <div class="stat-value"><?= $counts['prodi']; ?></div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="stat-card">
            <div class="stat-label">Total Mahasiswa</div>
            <div class="stat-value"><?= $counts['mahasiswa']; ?></div>
        </div>
    </div>
</div>

<div class="row g-4">
    <div class="col-lg-7">
        <div class="card section-card border-0">
            <h2 class="h4 mb-3">Mahasiswa Terbaru</h2>
            <div class="table-responsive">
                <table class="table align-middle">
                    <thead>
                    <tr>
                        <th>NIM</th>
                        <th>Nama</th>
                        <th>Prodi</th>
                        <th>Jurusan</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($latestStudents as $student): ?>
                        <tr>
                            <td><?= e($student['nim']); ?></td>
                            <td><?= e($student['nama_mahasiswa']); ?></td>
                            <td><?= e($student['nama_prodi']); ?></td>
                            <td><?= e($student['nama_jurusan']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-lg-5">
        <div class="card section-card border-0 h-100">
            <h2 class="h4 mb-3">Checklist PRD</h2>
            <ul class="mb-0 ps-3">
                <li>Login dan autentikasi berbasis session</li>
                <li>3 tabel relasional utama: jurusan, prodi, mahasiswa</li>
                <li>Fitur CRUD untuk semua data utama</li>
                <li>Ubah password pengguna</li>
                <li>Layout responsif dengan navbar hamburger</li>
                <li>Siap dikonfigurasi untuk localhost atau hosting</li>
            </ul>
        </div>
    </div>
</div>
<?php
$content = (string) ob_get_clean();
render('Dashboard', $content);
