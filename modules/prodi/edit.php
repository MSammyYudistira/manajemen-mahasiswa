<?php

declare(strict_types=1);

$id = (int) ($_GET['id'] ?? 0);
$jurusan = db()->query('SELECT id_jurusan, nama_jurusan FROM jurusan ORDER BY nama_jurusan ASC')->fetchAll();

$stmt = db()->prepare('SELECT * FROM prodi WHERE id_prodi = :id');
$stmt->execute(['id' => $id]);
$prodi = $stmt->fetch();

if (!$prodi) {
    set_flash('danger', 'Data prodi tidak ditemukan.');
    redirect('index.php?route=prodi');
}

if (is_post()) {
    verify_csrf();

    $namaProdi = trim($_POST['nama_prodi'] ?? '');
    $idJurusan = (int) ($_POST['id_jurusan'] ?? 0);

    if ($namaProdi === '' || $idJurusan <= 0) {
        set_flash('danger', 'Nama prodi dan jurusan wajib diisi.');
        redirect('index.php?route=prodi-edit&id=' . $id);
    }

    $update = db()->prepare('UPDATE prodi SET nama_prodi = :nama_prodi, id_jurusan = :id_jurusan WHERE id_prodi = :id');
    $update->execute([
        'id' => $id,
        'nama_prodi' => $namaProdi,
        'id_jurusan' => $idJurusan,
    ]);

    set_flash('success', 'Data prodi berhasil diperbarui.');
    redirect('index.php?route=prodi');
}

ob_start();
?>
<section class="page-heading">
    <div>
        <h1>Edit Prodi</h1>
        <p>Perbarui program studi dan relasinya ke jurusan.</p>
    </div>
</section>

<div class="card section-card border-0">
    <form method="post" class="row g-3">
        <input type="hidden" name="_token" value="<?= e(csrf_token()); ?>">
        <div class="col-md-7">
            <label class="form-label" for="nama_prodi">Nama Prodi</label>
            <input class="form-control" id="nama_prodi" type="text" name="nama_prodi" value="<?= e($prodi['nama_prodi']); ?>" required>
        </div>
        <div class="col-md-5">
            <label class="form-label" for="id_jurusan">Jurusan</label>
            <select class="form-select" id="id_jurusan" name="id_jurusan" required>
                <?php foreach ($jurusan as $item): ?>
                    <option value="<?= e((string) $item['id_jurusan']); ?>" <?= (int) $prodi['id_jurusan'] === (int) $item['id_jurusan'] ? 'selected' : ''; ?>><?= e($item['nama_jurusan']); ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="col-12 d-flex gap-2">
            <button class="btn btn-primary" type="submit">Update</button>
            <a class="btn btn-outline-secondary" href="index.php?route=prodi">Kembali</a>
        </div>
    </form>
</div>
<?php
$content = (string) ob_get_clean();
render('Edit Prodi', $content);
