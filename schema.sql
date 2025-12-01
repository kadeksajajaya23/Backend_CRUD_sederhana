CREATE DATABASE perpustakaan;
USE perpustakaan;

CREATE TABLE  buku (
    id INT AUTO_INCREMENT PRIMARY KEY,
    judul VARCHAR(100) NOT NULL,
    penulis VARCHAR(100) NOT NULL,
    tahun_terbit INT(4) NOT NULL,
    genre ENUM('Novel', 'Komik', 'Edukasi') NOT NULL,
    cover VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);