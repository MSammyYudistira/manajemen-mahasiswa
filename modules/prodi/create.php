<?php

declare(strict_types=1);

$jurusan = db()->query('SELECT id_jurusan, nama_jurusan FROM jurusan ORDER BY nama_jurusan ASC')->fetchAll();

if (is_post()) {
    verify_csrf();

    $namaProdi = trim($_POST['nama_prodi'] ?? '');
    $idJurusan = (int) ($_POST['id_jurusan'] ?? 0);
    set_old($_POST);

    if ($namaProdi === '' || $idJurusan <= 0) {
        set_flash('danger', 'Nama prodi dan jurusan wajib diisi.');
        redirect('index.php?route=prodi-create');
    }

    $stmt = db()->prepare('INSERT INTO prodi (nama_prodi, id_jurusan) VALUES (:nama_prodi, :id_jurusan)');
    $stmt->execute([
        'nama_prodi' => $namaProdi,
        'id_jurusan' => $idJurusan,
    ]);

    clear_old();
    set_flash('success', 'Data prodi berhasil ditambahkan.');
    redirect('index.php?route=prodi');
}

ob_start();
?>
<section class="page-heading">
    <div>
        <h1>Tambah Prodi</h1>
        <p>Pilih jurusan induk untuk program studi yang akan ditambahkan.</p>
    </div>
</section>

<div class="card section-card border-0">
    <form method="post" class="row g-3">
        <input type="hidden" name="_token" value="<?= e(csrf_token()); ?>">
        <div class="col-md-7">
            <label class="form-label" for="nama_prodi">Nama Prodi</label>
            <input class="form-control" id="nama_prodi" type="text" name="nama_prodi" value="<?= e(old('nama_prodi')); ?>" required>
        </div>
        <div class="col-md-5">
            <label class="form-label" for="id_jurusan">Jurusan</label>
            <select class="form-select" id="id_jurusan" name="id_jurusan" required>
                <option value="">Pilih Jurusan</option>
                <?php foreach ($jurusan as $item): ?>
                    <option value="<?= e((string) $item['id_jurusan']); ?>" <?= old('id_jurusan') === (string) $item['id_jurusan'] ? 'selected' : ''; ?>><?= e($item['nama_jurusan']); ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="col-12 d-flex gap-2">
            <button class="btn btn-primary" type="submit">Simpan</button>
            <a class="btn btn-outline-secondary" href="index.php?route=prodi">Kembali</a>
        </div>
    </form>
</div>
<?php
$content = (string) ob_get_clean();
render('Tambah Prodi', $content);
