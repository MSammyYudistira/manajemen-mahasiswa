# Manajemen Mahasiswa

Aplikasi web pengelolaan data mahasiswa berbasis PHP native, MySQL, dan Bootstrap 5. Fitur utama mengikuti PRD: login, dashboard, CRUD `jurusan`/`prodi`/`mahasiswa`, ubah password, layout responsif, dan seed data awal.

## Struktur Utama

- `index.php`: front controller sederhana berbasis query route.
- `app/config`: konfigurasi aplikasi dan database.
- `app/helpers`: helper umum, autentikasi, session, dan koneksi PDO.
- `modules`: modul fitur per halaman.
- `database/schema.sql`: skema database dan data awal.
- `assets/css/app.css`: gaya antarmuka utama.

## Cara Menjalankan di Laragon

1. Buat database dan seed data dengan mengimpor [database/schema.sql](C:\laragon\www\manajemen-mahasiswa\database\schema.sql) melalui HeidiSQL, phpMyAdmin, atau CLI MySQL.
2. Sesuaikan kredensial database di [app/config/database.php](C:\laragon\www\manajemen-mahasiswa\app\config\database.php) bila perlu.
3. Pastikan folder project berada di `C:\laragon\www\manajemen-mahasiswa`.
4. Jalankan Apache/Nginx dan MySQL dari Laragon.
5. Buka [http://localhost/manajemen-mahasiswa/index.php?route=login](http://localhost/manajemen-mahasiswa/index.php?route=login).

## Akun Demo

- `admin` / `password123`
- `operator` / `password123`

## Catatan Deployment

- Jika domain/path hosting berbeda, ubah `APP_BASE_URL` atau nilai `base_url` di [app/config/app.php](C:\laragon\www\manajemen-mahasiswa\app\config\app.php).
- Upload semua file project via FTP lalu import `database/schema.sql` pada database hosting.
- Pastikan PHP hosting mendukung `PDO`, `pdo_mysql`, dan `password_hash`.
