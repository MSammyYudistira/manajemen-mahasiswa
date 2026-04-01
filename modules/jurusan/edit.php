<?php

declare(strict_types=1);

$id = (int) ($_GET['id'] ?? 0);
$stmt = db()->prepare('SELECT * FROM jurusan WHERE id_jurusan = :id');
$stmt->execute(['id' => $id]);
$jurusan = $stmt->fetch();

if (!$jurusan) {
    set_flash('danger', 'Data jurusan tidak ditemukan.');
    redirect('index.php?route=jurusan');
}

if (is_post()) {
    verify_csrf();

    $namaJurusan = trim($_POST['nama_jurusan'] ?? '');

    if ($namaJurusan === '') {
        set_flash('danger', 'Nama jurusan wajib diisi.');
        redirect('index.php?route=jurusan-edit&id=' . $id);
    }

    $update = db()->prepare('UPDATE jurusan SET nama_jurusan = :nama_jurusan WHERE id_jurusan = :id');
    $update->execute([
        'id' => $id,
        'nama_jurusan' => $namaJurusan,
    ]);

    set_flash('success', 'Data jurusan berhasil diperbarui.');
    redirect('index.php?route=jurusan');
}

ob_start();
?>
<section class="page-heading">
    <div>
        <h1>Edit Jurusan</h1>
        <p>Perbarui nama jurusan sesuai kebutuhan data akademik.</p>
    </div>
</section>

<div class="card section-card border-0">
    <form method="post" class="row g-3">
        <input type="hidden" name="_token" value="<?= e(csrf_token()); ?>">
        <div class="col-12">
            <label class="form-label" for="nama_jurusan">Nama Jurusan</label>
            <input class="form-control" id="nama_jurusan" type="text" name="nama_jurusan" value="<?= e($jurusan['nama_jurusan']); ?>" required>
        </div>
        <div class="col-12 d-flex gap-2">
            <button class="btn btn-primary" type="submit">Update</button>
            <a class="btn btn-outline-secondary" href="index.php?route=jurusan">Kembali</a>
        </div>
    </form>
</div>
<?php
$content = (string) ob_get_clean();
render('Edit Jurusan', $content);
