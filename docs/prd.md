# PRD — Sistem Web Pengelolaan Data Mahasiswa

## 1. Ringkasan Produk
Produk yang akan dibangun adalah **aplikasi web pengelolaan data mahasiswa** untuk kebutuhan tugas praktik ujian **Junior Web Programmer**.  
Aplikasi ini harus menunjukkan kemampuan dalam:
- perancangan antarmuka,
- penggunaan struktur data,
- pemrograman terstruktur,
- penggunaan library pendukung,
- dokumentasi kode,
- debugging,
- dan deployment ke hosting.

Aplikasi harus dapat berjalan dengan baik di desktop maupun smartphone.

---

## 2. Tujuan Produk
Tujuan dari produk ini adalah:
- menyediakan website untuk mengelola data mahasiswa,
- menyediakan sistem login dengan verifikasi user,
- mengelola data berbasis minimal 3 tabel yang saling berelasi,
- menyediakan fitur CRUD,
- menyediakan fitur ubah password,
- serta memastikan aplikasi dapat diunggah dan dijalankan di hosting.

---

## 3. Pengguna Utama
Pengguna utama aplikasi ini adalah:
- **Admin / Operator**, yang mengelola data mahasiswa,
- **User terdaftar**, yang dapat login ke dalam sistem.

---

## 4. Ruang Lingkup Produk
Cakupan sistem meliputi:
- pembuatan template website,
- halaman responsif,
- menu navigasi,
- sistem login,
- pengelolaan data 3 tabel relasi,
- fitur CRUD,
- fitur ubah password,
- pengisian data awal,
- konfigurasi database,
- upload ke hosting,
- dan pengujian aplikasi.

---

## 5. Kebutuhan Fungsional

### FR-01. Login dan Verifikasi Pengguna
Sistem harus menyediakan form login untuk memverifikasi **username** dan **password**.  
Data login diambil dari tabel khusus autentikasi.  
Password harus disimpan dalam bentuk **terenkripsi**.

### FR-02. Struktur Data Relasional
Sistem harus menggunakan minimal **3 tabel yang saling berelasi**, di luar tabel login.  

Contoh struktur:
- `users`
- `jurusan`
- `prodi`
- `mahasiswa`

### FR-03. Kelola Data
Sistem harus menyediakan fitur:
- tambah data,
- lihat data,
- edit data,
- hapus data.

### FR-04. Data Awal
Setiap tabel utama harus memiliki minimal **10 record** untuk kebutuhan uji coba.

### FR-05. Ubah Password
Sistem harus menyediakan fitur untuk **mengubah password pengguna**.

### FR-06. Template Website
Sistem harus memiliki tampilan dengan komponen:
- **header**
- **menu**
- **content**
- **footer**

### FR-07. Tampilan Responsif
Website harus **responsive** dan dapat menyesuaikan ukuran layar device.

### FR-08. Menu Hamburger
Saat dibuka di mode smartphone, menu navigasi harus berubah menjadi **menu hamburger**.

### FR-09. Hosting dan Deployment
Sistem harus dapat:
- dikonfigurasi databasenya,
- diunggah ke hosting menggunakan FTP,
- diuji setelah upload,
- diperbaiki jika ditemukan error.

---

## 6. Kebutuhan Non-Fungsional
Sistem harus memenuhi kebutuhan berikut:
- dibuat menggunakan **HTML, CSS, Bootstrap**, dan library pendukung lain,
- memiliki tampilan yang rapi dan mudah digunakan,
- kode mengikuti **best practice**,
- terdapat dokumentasi kode seperlunya,
- mudah diuji dan di-debug,
- dapat berjalan di localhost maupun hosting.

---

## 7. Struktur Data yang Disarankan

## 7.1 Tabel `users`
Menyimpan data login pengguna.

**Field contoh:**
- `id_user`
- `username`
- `password`
- `nama_user`

## 7.2 Tabel `jurusan`
Menyimpan data jurusan.

**Field contoh:**
- `id_jurusan`
- `nama_jurusan`

## 7.3 Tabel `prodi`
Menyimpan data program studi.

**Field contoh:**
- `id_prodi`
- `nama_prodi`
- `id_jurusan`

## 7.4 Tabel `mahasiswa`
Menyimpan data mahasiswa.

**Field contoh:**
- `nim`
- `nama_mahasiswa`
- `alamat`
- `no_hp`
- `id_prodi`

---

## 8. Alur Penggunaan Sistem

1. Pengguna membuka aplikasi.
2. Pengguna login menggunakan username dan password.
3. Sistem memverifikasi data login.
4. Jika berhasil, pengguna masuk ke dashboard.
5. Pengguna dapat mengelola data jurusan, prodi, dan mahasiswa.
6. Pengguna dapat menambah, melihat, mengubah, dan menghapus data.
7. Pengguna dapat mengganti password.
8. Setelah selesai, aplikasi dapat diunggah ke hosting dan diuji.

---

## 9. Acceptance Criteria
Sistem dinyatakan berhasil jika:
- website memiliki header, menu, content, dan footer,
- tampilan responsif di desktop dan smartphone,
- menu hamburger muncul di layar kecil,
- login berjalan dengan baik,
- password tersimpan terenkripsi,
- terdapat minimal 3 tabel relasi,
- semua fitur CRUD berjalan,
- fitur ubah password tersedia,
- setiap tabel memiliki minimal 10 data,
- aplikasi berhasil diunggah ke hosting,
- semua menu dapat diakses dan berfungsi.

---

## 10. Catatan Implementasi
Beberapa prinsip yang sebaiknya diperhatikan:
- nomor telepon sebaiknya disimpan sebagai `varchar`,
- session lebih aman daripada cookie untuk login sementara,
- gunakan komentar seperlunya pada kode,
- lakukan pengecekan path/file jika muncul error 404,
- lakukan debugging jika ada parse error atau syntax error.

---

## 11. Batasan Produk
Produk ini tidak wajib mencakup:
- multi-role yang kompleks,
- laporan PDF otomatis,
- integrasi API eksternal,
- dashboard analitik,
- fitur notifikasi lanjutan.

---

## 12. Hasil Akhir yang Diharapkan
Hasil akhir dari produk ini adalah:
- sebuah aplikasi web pengelolaan data mahasiswa,
- memiliki sistem login,
- memiliki database relasional,
- memiliki tampilan responsif,
- dapat digunakan untuk CRUD data,
- dan berhasil berjalan di hosting sesuai instruksi ujian.