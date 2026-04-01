<?php

declare(strict_types=1);

if (is_post()) {
    verify_csrf();

    $passwordLama = $_POST['password_lama'] ?? '';
    $passwordBaru = $_POST['password_baru'] ?? '';
    $konfirmasiPassword = $_POST['konfirmasi_password'] ?? '';
    $user = auth_user();

    $stmt = db()->prepare('SELECT password FROM users WHERE id_user = :id');
    $stmt->execute(['id' => $user['id_user']]);
    $currentUser = $stmt->fetch();

    if (!$currentUser || !password_verify($passwordLama, $currentUser['password'])) {
        set_flash('danger', 'Password lama tidak sesuai.');
        redirect('index.php?route=ubah-password');
    }

    if (strlen($passwordBaru) < 8) {
        set_flash('danger', 'Password baru minimal 8 karakter.');
        redirect('index.php?route=ubah-password');
    }

    if ($passwordBaru !== $konfirmasiPassword) {
        set_flash('danger', 'Konfirmasi password baru tidak cocok.');
        redirect('index.php?route=ubah-password');
    }

    $update = db()->prepare('UPDATE users SET password = :password WHERE id_user = :id');
    $update->execute([
        'id' => $user['id_user'],
        'password' => password_hash($passwordBaru, PASSWORD_DEFAULT),
    ]);

    set_flash('success', 'Password berhasil diperbarui.');
    redirect('index.php?route=ubah-password');
}

ob_start();
?>
<section class="page-heading">
    <div>
        <h1>Ubah Password</h1>
        <p>Gunakan password yang kuat untuk menjaga keamanan akun login aplikasi.</p>
    </div>
</section>

<div class="card section-card border-0">
    <form method="post" class="row g-3">
        <input type="hidden" name="_token" value="<?= e(csrf_token()); ?>">
        <div class="col-md-4">
            <label class="form-label" for="password_lama">Password Lama</label>
            <input class="form-control" id="password_lama" type="password" name="password_lama" required>
        </div>
        <div class="col-md-4">
            <label class="form-label" for="password_baru">Password Baru</label>
            <input class="form-control" id="password_baru" type="password" name="password_baru" required>
        </div>
        <div class="col-md-4">
            <label class="form-label" for="konfirmasi_password">Konfirmasi Password Baru</label>
            <input class="form-control" id="konfirmasi_password" type="password" name="konfirmasi_password" required>
        </div>
        <div class="col-12">
            <button class="btn btn-primary" type="submit">Simpan Password</button>
        </div>
    </form>
</div>
<?php
$content = (string) ob_get_clean();
render('Ubah Password', $content);
