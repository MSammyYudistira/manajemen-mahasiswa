CREATE DATABASE IF NOT EXISTS manajemen_mahasiswa CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE manajemen_mahasiswa;

DROP TABLE IF EXISTS mahasiswa;
DROP TABLE IF EXISTS prodi;
DROP TABLE IF EXISTS jurusan;
DROP TABLE IF EXISTS users;

CREATE TABLE users (
    id_user INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    nama_user VARCHAR(100) NOT NULL
);

CREATE TABLE jurusan (
    id_jurusan INT AUTO_INCREMENT PRIMARY KEY,
    nama_jurusan VARCHAR(100) NOT NULL
);

CREATE TABLE prodi (
    id_prodi INT AUTO_INCREMENT PRIMARY KEY,
    nama_prodi VARCHAR(100) NOT NULL,
    id_jurusan INT NOT NULL,
    CONSTRAINT fk_prodi_jurusan
        FOREIGN KEY (id_jurusan) REFERENCES jurusan(id_jurusan)
        ON UPDATE CASCADE ON DELETE RESTRICT
);

CREATE TABLE mahasiswa (
    nim VARCHAR(20) PRIMARY KEY,
    nama_mahasiswa VARCHAR(100) NOT NULL,
    alamat VARCHAR(255) NOT NULL,
    no_hp VARCHAR(20) NOT NULL,
    id_prodi INT NOT NULL,
    CONSTRAINT fk_mahasiswa_prodi
        FOREIGN KEY (id_prodi) REFERENCES prodi(id_prodi)
        ON UPDATE CASCADE ON DELETE RESTRICT
);

INSERT INTO users (username, password, nama_user) VALUES
('admin', '$2y$10$.JRe526kZT38hnR//CPAIOHx.Ic5PAc737SsTJjY95OjR2.cNQqC2', 'Administrator'),
('operator', '$2y$10$.JRe526kZT38hnR//CPAIOHx.Ic5PAc737SsTJjY95OjR2.cNQqC2', 'Operator Akademik');

INSERT INTO jurusan (nama_jurusan) VALUES
('Teknik Informatika'),
('Sistem Informasi'),
('Manajemen Bisnis'),
('Akuntansi'),
('Desain Komunikasi Visual'),
('Teknik Elektro'),
('Teknik Mesin'),
('Administrasi Publik'),
('Ilmu Komunikasi'),
('Pariwisata');

INSERT INTO prodi (nama_prodi, id_jurusan) VALUES
('Informatika', 1),
('Teknologi Informasi', 1),
('Sistem Informasi Bisnis', 2),
('Manajemen', 3),
('Akuntansi Perpajakan', 4),
('Desain Grafis', 5),
('Teknik Tenaga Listrik', 6),
('Teknik Otomotif', 7),
('Administrasi Negara', 8),
('Usaha Perjalanan Wisata', 10);

INSERT INTO mahasiswa (nim, nama_mahasiswa, alamat, no_hp, id_prodi) VALUES
('2301001', 'Aulia Ramadhani', 'Jl. Perintis Kemerdekaan No. 10', '081234567801', 1),
('2301002', 'Bima Prasetyo', 'Jl. AP Pettarani No. 12', '081234567802', 2),
('2301003', 'Citra Maharani', 'Jl. Sultan Alauddin No. 21', '081234567803', 3),
('2301004', 'Dimas Saputra', 'Jl. Urip Sumoharjo No. 9', '081234567804', 4),
('2301005', 'Elsa Putri', 'Jl. Gunung Bawakaraeng No. 8', '081234567805', 5),
('2301006', 'Farhan Akbar', 'Jl. Andi Tonro No. 4', '081234567806', 6),
('2301007', 'Gita Lestari', 'Jl. Pengayoman No. 16', '081234567807', 7),
('2301008', 'Hafiz Maulana', 'Jl. Hertasning No. 18', '081234567808', 8),
('2301009', 'Intan Permata', 'Jl. Emmy Saelan No. 5', '081234567809', 9),
('2301010', 'Jordi Kurniawan', 'Jl. Metro Tanjung Bunga No. 27', '081234567810', 10);
