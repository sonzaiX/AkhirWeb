-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 16 Jul 2023 pada 16.01
-- Versi server: 10.4.27-MariaDB
-- Versi PHP: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `servd`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `akun`
--

CREATE TABLE `akun` (
  `id_user` int(10) NOT NULL,
  `id_pelanggan` int(10) NOT NULL,
  `username` varchar(25) NOT NULL,
  `password` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `device`
--

CREATE TABLE `device` (
  `id_device` int(10) NOT NULL,
  `merek` varchar(25) DEFAULT NULL,
  `model` varchar(25) DEFAULT NULL,
  `tipe` varchar(25) DEFAULT NULL,
  `deskripsi` text DEFAULT NULL,
  `SN` int(8) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `device`
--

INSERT INTO `device` (`id_device`, `merek`, `model`, `tipe`, `deskripsi`, `SN`) VALUES
(1, 'Lenovo', 'ThinkPad X1 Carbon', 'Ultrabook', 'Intel Core i7, 16GB RAM, 512GB SSD', 56789012),
(2, 'Dell', 'Latitude 5490', 'Business', 'Intel Core i5, 8GB RAM, 256GB SSD', 24681357),
(3, 'Acer', 'Predator', 'Gaming', 'AMD Ryzen 9, 16GB RAM, 1TB HDD', 31415926),
(5, 'Acer', 'Swift 5', 'Business', 'Core i5-12500H', 78924321),
(6, 'Acer', 'Businesss', 'hasjhda', 'gasas', 12313141),
(7, 'Acer', 'Swift 10', 'Business', 'Intel Core i5-14500H, 64Gb Ram, RTX 9000', 12313141),
(8, 'Acer', 'Business', 'hasjhda', 'gasa', 12313141),
(9, 'lenovo', 'Laptop', 'Business', 'AMD R3, Ram 8gb', 672816321),
(10, 'lenovo', 'Notebook', 'Business', 'AMD R3, Ram 8gb', 672816321),
(11, 'asus', 'laptop', 'Business', 'icore 7,ram 16gb', 859303);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id_user` int(10) NOT NULL,
  `nama` varchar(25) DEFAULT NULL,
  `alamat` varchar(50) DEFAULT NULL,
  `NomorKontak` int(12) DEFAULT NULL,
  `Email` varchar(25) DEFAULT NULL,
  `username` char(10) DEFAULT NULL,
  `katasandi` char(12) DEFAULT NULL,
  `peran` char(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pelanggan`
--

INSERT INTO `pelanggan` (`id_user`, `nama`, `alamat`, `NomorKontak`, `Email`, `username`, `katasandi`, `peran`) VALUES
(2, 'Jojo Satoru', 'Jl. Raya Maju No. 456', 2147483647, 'jane.smith@example.com', 'Jojo', 'pass123', 'biasa'),
(3, 'Admin', 'Jl. Administrator No. 789', 2147483647, 'admin@example.com', 'admin', 'adminpass', 'admin'),
(4, 'Fatta', 'Ungaran', 2147483641, 'fsyam67@gmail.com', 'fsyam', 'qwerty', NULL),
(5, 'fanny', 'Karangayu', 1461836412, 'fanny@gmail.com', 'fanfan', '1234', 'biasa');

-- --------------------------------------------------------

--
-- Struktur dari tabel `perbaikan`
--

CREATE TABLE `perbaikan` (
  `id_perbaikan` int(10) NOT NULL,
  `id_user` int(10) DEFAULT NULL,
  `id_device` int(10) DEFAULT NULL,
  `desk_kerusakan` text DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `tanggal_masuk` date DEFAULT NULL,
  `estimasi` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `perbaikan`
--

INSERT INTO `perbaikan` (`id_perbaikan`, `id_user`, `id_device`, `desk_kerusakan`, `status`, `tanggal_masuk`, `estimasi`) VALUES
(3, 3, 3, 'Performa lambat', 'Selesai', '2023-06-30', '2023-07-01'),
(6, 2, 7, 'Ga bisa terbang', 'Dalam Proses', '2023-07-15', NULL),
(8, 4, 9, 'Bagus', 'Dalam Proses', '2023-07-15', NULL),
(9, 5, 10, 'layar patah', 'Selesai', '2023-07-16', '0000-00-00'),
(10, 5, 11, 'lemot', 'Selesai', '2023-07-16', '2023-07-16');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `akun`
--
ALTER TABLE `akun`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `username` (`username`),
  ADD KEY `id_pelanggan` (`id_pelanggan`);

--
-- Indeks untuk tabel `device`
--
ALTER TABLE `device`
  ADD PRIMARY KEY (`id_device`);

--
-- Indeks untuk tabel `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id_user`);

--
-- Indeks untuk tabel `perbaikan`
--
ALTER TABLE `perbaikan`
  ADD PRIMARY KEY (`id_perbaikan`),
  ADD KEY `perbaikan_ibfk_2` (`id_device`),
  ADD KEY `perbaikan_ibfk_3` (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `akun`
--
ALTER TABLE `akun`
  MODIFY `id_user` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `device`
--
ALTER TABLE `device`
  MODIFY `id_device` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `id_user` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `perbaikan`
--
ALTER TABLE `perbaikan`
  MODIFY `id_perbaikan` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `akun`
--
ALTER TABLE `akun`
  ADD CONSTRAINT `akun_ibfk_1` FOREIGN KEY (`id_pelanggan`) REFERENCES `pelanggan` (`id_user`);

--
-- Ketidakleluasaan untuk tabel `perbaikan`
--
ALTER TABLE `perbaikan`
  ADD CONSTRAINT `perbaikan_ibfk_2` FOREIGN KEY (`id_device`) REFERENCES `device` (`id_device`) ON DELETE CASCADE,
  ADD CONSTRAINT `perbaikan_ibfk_3` FOREIGN KEY (`id_user`) REFERENCES `pelanggan` (`id_user`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
