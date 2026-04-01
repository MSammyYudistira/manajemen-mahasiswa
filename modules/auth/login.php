<?php

declare(strict_types=1);

if (is_authenticated()) {
    redirect('index.php?route=dashboard');
}

if (is_post()) {
    verify_csrf();

    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    set_old(['username' => $username]);

    if ($username === '' || $password === '') {
        set_flash('danger', 'Username dan password wajib diisi.');
        redirect('index.php?route=login');
    }

    try {
        if (!attempt_login($username, $password)) {
            set_flash('danger', 'Login gagal. Periksa kembali username dan password.');
            redirect('index.php?route=login');
        }
    } catch (Throwable $exception) {
        set_flash('danger', 'Koneksi database gagal. Cek konfigurasi dan import file SQL terlebih dahulu.');
        redirect('index.php?route=login');
    }

    clear_old();
    set_flash('success', 'Login berhasil.');
    redirect('index.php?route=dashboard');
}

ob_start();
?>
<div class="auth-card row g-0">
    <div class="col-lg-6 auth-hero d-flex flex-column justify-content-between">
        <div>
            <span class="badge rounded-pill text-bg-light text-primary mb-3">Sistem Akademik</span>
            <h1 class="display-6 fw-bold mb-3">Kelola jurusan, prodi, dan mahasiswa dalam satu panel.</h1>
            <p class="mb-0 text-white-50">Aplikasi ini dirancang untuk memenuhi kebutuhan ujian praktik Junior Web Programmer dengan fitur login, CRUD relasional, dan tampilan responsif.</p>
        </div>
        <div class="mt-4 small text-white-50">
            <div>Demo akun:</div>
            <div><strong>Username:</strong> admin</div>
            <div><strong>Password:</strong> password123</div>
        </div>
    </div>
    <div class="col-lg-6 auth-panel">
        <div class="mb-4">
            <h2 class="h3 fw-bold mb-2">Masuk ke aplikasi</h2>
            <p class="text-body-secondary mb-0">Gunakan akun yang sudah terdaftar untuk mengakses dashboard.</p>
        </div>

        <form method="post" class="vstack gap-3">
            <input type="hidden" name="_token" value="<?= e(csrf_token()); ?>">
            <div>
                <label class="form-label" for="username">Username</label>
                <input class="form-control form-control-lg" id="username" type="text" name="username" value="<?= e(old('username')); ?>" required>
            </div>
            <div>
                <label class="form-label" for="password">Password</label>
                <input class="form-control form-control-lg" id="password" type="password" name="password" required>
            </div>
            <button class="btn btn-primary btn-lg" type="submit">Login</button>
        </form>
    </div>
</div>
<?php
$content = (string) ob_get_clean();
render('Login', $content, false);
