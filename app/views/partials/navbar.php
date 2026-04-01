<?php

declare(strict_types=1);

$currentRoute = $_GET['route'] ?? 'dashboard';
$user = auth_user();
?>
<header class="topbar shadow-sm">
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand fw-bold" href="index.php?route=dashboard">Manajemen Mahasiswa</a>
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar" aria-controls="mainNavbar" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="mainNavbar">
                <ul class="navbar-nav me-auto mb-3 mb-lg-0 gap-lg-2">
                    <li class="nav-item"><a class="nav-link <?= $currentRoute === 'dashboard' ? 'active' : ''; ?>" href="index.php?route=dashboard">Dashboard</a></li>
                    <li class="nav-item"><a class="nav-link <?= str_starts_with($currentRoute, 'jurusan') ? 'active' : ''; ?>" href="index.php?route=jurusan">Jurusan</a></li>
                    <li class="nav-item"><a class="nav-link <?= str_starts_with($currentRoute, 'prodi') ? 'active' : ''; ?>" href="index.php?route=prodi">Prodi</a></li>
                    <li class="nav-item"><a class="nav-link <?= str_starts_with($currentRoute, 'mahasiswa') ? 'active' : ''; ?>" href="index.php?route=mahasiswa">Mahasiswa</a></li>
                    <li class="nav-item"><a class="nav-link <?= $currentRoute === 'ubah-password' ? 'active' : ''; ?>" href="index.php?route=ubah-password">Ubah Password</a></li>
                </ul>
                <div class="d-flex align-items-center gap-3">
                    <div class="text-end small">
                        <div class="fw-semibold"><?= e($user['nama_user'] ?? ''); ?></div>
                        <div class="text-body-secondary"><?= e($user['username'] ?? ''); ?></div>
                    </div>
                    <a class="btn btn-outline-danger btn-sm" href="index.php?route=logout">Logout</a>
                </div>
            </div>
        </div>
    </nav>
</header>
