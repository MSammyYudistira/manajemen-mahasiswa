<?php

declare(strict_types=1);

require __DIR__ . '/app/helpers/bootstrap.php';

$route = $_GET['route'] ?? 'dashboard';

$publicRoutes = ['login', 'logout'];

if (!in_array($route, $publicRoutes, true) && !is_authenticated()) {
    redirect('index.php?route=login');
}

$routes = [
    'login' => __DIR__ . '/modules/auth/login.php',
    'logout' => __DIR__ . '/modules/auth/logout.php',
    'dashboard' => __DIR__ . '/modules/dashboard/index.php',
    'jurusan' => __DIR__ . '/modules/jurusan/index.php',
    'jurusan-create' => __DIR__ . '/modules/jurusan/create.php',
    'jurusan-edit' => __DIR__ . '/modules/jurusan/edit.php',
    'jurusan-delete' => __DIR__ . '/modules/jurusan/delete.php',
    'prodi' => __DIR__ . '/modules/prodi/index.php',
    'prodi-create' => __DIR__ . '/modules/prodi/create.php',
    'prodi-edit' => __DIR__ . '/modules/prodi/edit.php',
    'prodi-delete' => __DIR__ . '/modules/prodi/delete.php',
    'mahasiswa' => __DIR__ . '/modules/mahasiswa/index.php',
    'mahasiswa-create' => __DIR__ . '/modules/mahasiswa/create.php',
    'mahasiswa-edit' => __DIR__ . '/modules/mahasiswa/edit.php',
    'mahasiswa-delete' => __DIR__ . '/modules/mahasiswa/delete.php',
    'ubah-password' => __DIR__ . '/modules/profile/password.php',
];

if (!isset($routes[$route])) {
    http_response_code(404);
    echo 'Halaman tidak ditemukan.';
    exit;
}

require $routes[$route];
