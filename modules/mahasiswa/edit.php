<?php

declare(strict_types=1);

$nim = trim($_GET['nim'] ?? '');
$prodi = db()->query(
    'SELECT p.id_prodi, p.nama_prodi, j.nama_jurusan
     FROM prodi p
     INNER JOIN jurusan j ON j.id_jurusan = p.id_jurusan
     ORDER BY p.nama_prodi ASC'
)->fetchAll();

$stmt = db()->prepare('SELECT * FROM mahasiswa WHERE nim = :nim');
$stmt->execute(['nim' => $nim]);
$mahasiswa = $stmt->fetch();

if (!$mahasiswa) {
    set_flash('danger', 'Data mahasiswa tidak ditemukan.');
    redirect('index.php?route=mahasiswa');
}

if (is_post()) {
    verify_csrf();

    $namaMahasiswa = trim($_POST['nama_mahasiswa'] ?? '');
    $alamat = trim($_POST['alamat'] ?? '');
    $noHp = trim($_POST['no_hp'] ?? '');
    $idProdi = (int) ($_POST['id_prodi'] ?? 0);

    if ($namaMahasiswa === '' || $alamat === '' || $noHp === '' || $idProdi <= 0) {
        set_flash('danger', 'Semua field mahasiswa wajib diisi.');
        redirect('index.php?route=mahasiswa-edit&nim=' . urlencode($nim));
    }

    $update = db()->prepare(
        'UPDATE mahasiswa
         SET nama_mahasiswa = :nama_mahasiswa, alamat = :alamat, no_hp = :no_hp, id_prodi = :id_prodi
         WHERE nim = :nim'
    );
    $update->execute([
        'nim' => $nim,
        'nama_mahasiswa' => $namaMahasiswa,
        'alamat' => $alamat,
        'no_hp' => $noHp,
        'id_prodi' => $idProdi,
    ]);

    set_flash('success', 'Data mahasiswa berhasil diperbarui.');
    redirect('index.php?route=mahasiswa');
}

ob_start();
?>
<section class="page-heading">
    <div>
        <h1>Edit Mahasiswa</h1>
        <p>Perbarui biodata mahasiswa dan program studi yang dipilih.</p>
    </div>
</section>

<div class="card section-card border-0">
    <form method="post" class="row g-3">
        <input type="hidden" name="_token" value="<?= e(csrf_token()); ?>">
        <div class="col-md-4">
            <label class="form-label" for="nim">NIM</label>
            <input class="form-control" id="nim" type="text" value="<?= e($mahasiswa['nim']); ?>" disabled>
        </div>
        <div class="col-md-8">
            <label class="form-label" for="nama_mahasiswa">Nama Mahasiswa</label>
            <input class="form-control" id="nama_mahasiswa" type="text" name="nama_mahasiswa" value="<?= e($mahasiswa['nama_mahasiswa']); ?>" required>
        </div>
        <div class="col-md-6">
            <label class="form-label" for="alamat">Alamat</label>
            <textarea class="form-control" id="alamat" name="alamat" rows="3" required><?= e($mahasiswa['alamat']); ?></textarea>
        </div>
        <div class="col-md-3">
            <label class="form-label" for="no_hp">No. HP</label>
            <input class="form-control" id="no_hp" type="text" name="no_hp" value="<?= e($mahasiswa['no_hp']); ?>" required>
        </div>
        <div class="col-md-3">
            <label class="form-label" for="id_prodi">Prodi</label>
            <select class="form-select" id="id_prodi" name="id_prodi" required>
                <?php foreach ($prodi as $item): ?>
                    <option value="<?= e((string) $item['id_prodi']); ?>" <?= (int) $mahasiswa['id_prodi'] === (int) $item['id_prodi'] ? 'selected' : ''; ?>><?= e($item['nama_prodi'] . ' - ' . $item['nama_jurusan']); ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="col-12 d-flex gap-2">
            <button class="btn btn-primary" type="submit">Update</button>
            <a class="btn btn-outline-secondary" href="index.php?route=mahasiswa">Kembali</a>
        </div>
    </form>
</div>
<?php
$content = (string) ob_get_clean();
render('Edit Mahasiswa', $content);
