<?php

declare(strict_types=1);

$prodi = db()->query(
    'SELECT p.id_prodi, p.nama_prodi, j.nama_jurusan
     FROM prodi p
     INNER JOIN jurusan j ON j.id_jurusan = p.id_jurusan
     ORDER BY p.nama_prodi ASC'
)->fetchAll();

if (is_post()) {
    verify_csrf();

    $input = [
        'nim' => trim($_POST['nim'] ?? ''),
        'nama_mahasiswa' => trim($_POST['nama_mahasiswa'] ?? ''),
        'alamat' => trim($_POST['alamat'] ?? ''),
        'no_hp' => trim($_POST['no_hp'] ?? ''),
        'id_prodi' => trim($_POST['id_prodi'] ?? ''),
    ];
    set_old($input);

    if (in_array('', $input, true)) {
        set_flash('danger', 'Semua field mahasiswa wajib diisi.');
        redirect('index.php?route=mahasiswa-create');
    }

    $stmt = db()->prepare(
        'INSERT INTO mahasiswa (nim, nama_mahasiswa, alamat, no_hp, id_prodi)
         VALUES (:nim, :nama_mahasiswa, :alamat, :no_hp, :id_prodi)'
    );
    $stmt->execute([
        'nim' => $input['nim'],
        'nama_mahasiswa' => $input['nama_mahasiswa'],
        'alamat' => $input['alamat'],
        'no_hp' => $input['no_hp'],
        'id_prodi' => (int) $input['id_prodi'],
    ]);

    clear_old();
    set_flash('success', 'Data mahasiswa berhasil ditambahkan.');
    redirect('index.php?route=mahasiswa');
}

ob_start();
?>
<section class="page-heading">
    <div>
        <h1>Tambah Mahasiswa</h1>
        <p>Masukkan data mahasiswa baru lengkap dengan program studinya.</p>
    </div>
</section>

<div class="card section-card border-0">
    <form method="post" class="row g-3">
        <input type="hidden" name="_token" value="<?= e(csrf_token()); ?>">
        <div class="col-md-4">
            <label class="form-label" for="nim">NIM</label>
            <input class="form-control" id="nim" type="text" name="nim" value="<?= e(old('nim')); ?>" required>
        </div>
        <div class="col-md-8">
            <label class="form-label" for="nama_mahasiswa">Nama Mahasiswa</label>
            <input class="form-control" id="nama_mahasiswa" type="text" name="nama_mahasiswa" value="<?= e(old('nama_mahasiswa')); ?>" required>
        </div>
        <div class="col-md-6">
            <label class="form-label" for="alamat">Alamat</label>
            <textarea class="form-control" id="alamat" name="alamat" rows="3" required><?= e(old('alamat')); ?></textarea>
        </div>
        <div class="col-md-3">
            <label class="form-label" for="no_hp">No. HP</label>
            <input class="form-control" id="no_hp" type="text" name="no_hp" value="<?= e(old('no_hp')); ?>" required>
        </div>
        <div class="col-md-3">
            <label class="form-label" for="id_prodi">Prodi</label>
            <select class="form-select" id="id_prodi" name="id_prodi" required>
                <option value="">Pilih Prodi</option>
                <?php foreach ($prodi as $item): ?>
                    <option value="<?= e((string) $item['id_prodi']); ?>" <?= old('id_prodi') === (string) $item['id_prodi'] ? 'selected' : ''; ?>><?= e($item['nama_prodi'] . ' - ' . $item['nama_jurusan']); ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="col-12 d-flex gap-2">
            <button class="btn btn-primary" type="submit">Simpan</button>
            <a class="btn btn-outline-secondary" href="index.php?route=mahasiswa">Kembali</a>
        </div>
    </form>
</div>
<?php
$content = (string) ob_get_clean();
render('Tambah Mahasiswa', $content);
