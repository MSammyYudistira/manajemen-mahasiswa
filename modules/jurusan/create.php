<?php

declare(strict_types=1);

if (is_post()) {
    verify_csrf();

    $namaJurusan = trim($_POST['nama_jurusan'] ?? '');
    set_old($_POST);

    if ($namaJurusan === '') {
        set_flash('danger', 'Nama jurusan wajib diisi.');
        redirect('index.php?route=jurusan-create');
    }

    $stmt = db()->prepare('INSERT INTO jurusan (nama_jurusan) VALUES (:nama_jurusan)');
    $stmt->execute(['nama_jurusan' => $namaJurusan]);

    clear_old();
    set_flash('success', 'Data jurusan berhasil ditambahkan.');
    redirect('index.php?route=jurusan');
}

ob_start();
?>
<section class="page-heading">
    <div>
        <h1>Tambah Jurusan</h1>
        <p>Masukkan data jurusan baru yang akan digunakan oleh program studi.</p>
    </div>
</section>

<div class="card section-card border-0">
    <form method="post" class="row g-3">
        <input type="hidden" name="_token" value="<?= e(csrf_token()); ?>">
        <div class="col-12">
            <label class="form-label" for="nama_jurusan">Nama Jurusan</label>
            <input class="form-control" id="nama_jurusan" type="text" name="nama_jurusan" value="<?= e(old('nama_jurusan')); ?>" required>
        </div>
        <div class="col-12 d-flex gap-2">
            <button class="btn btn-primary" type="submit">Simpan</button>
            <a class="btn btn-outline-secondary" href="index.php?route=jurusan">Kembali</a>
        </div>
    </form>
</div>
<?php
$content = (string) ob_get_clean();
render('Tambah Jurusan', $content);
