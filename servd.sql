-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 05 Jul 2023 pada 11.31
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
(3, 'HP', 'Pavilion Gaming 15', 'Gaming', 'AMD Ryzen 7, 16GB RAM, 1TB HDD', 31415926);

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
  `password` char(12) DEFAULT NULL,
  `peran` char(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pelanggan`
--

INSERT INTO `pelanggan` (`id_user`, `nama`, `alamat`, `NomorKontak`, `Email`, `username`, `password`, `peran`) VALUES
(1, 'John Doe', 'Jl. Merdeka No. 123', 1234567890, 'john.doe@example.com', 'johndoe', 'password123', 'biasa'),
(2, 'Jane Smith', 'Jl. Raya Maju No. 456', 2147483647, 'jane.smith@example.com', 'janesmith', 'pass123', 'biasa'),
(3, 'Admin', 'Jl. Administrator No. 789', 2147483647, 'admin@example.com', 'admin', 'adminpass', 'admin');

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
(1, 1, 1, 'Layar pecah', 'Tertunda', '2023-06-30', '0000-00-00'),
(2, 2, 2, 'Baterai bocor', 'Tertunda', '2023-06-30', '0000-00-00'),
(3, 3, 3, 'Performa lambat', 'Selesai', '2023-06-30', '2023-07-01');

--
-- Indexes for dumped tables
--

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
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_device` (`id_device`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `device`
--
ALTER TABLE `device`
  MODIFY `id_device` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `id_user` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `perbaikan`
--
ALTER TABLE `perbaikan`
  MODIFY `id_perbaikan` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `perbaikan`
--
ALTER TABLE `perbaikan`
  ADD CONSTRAINT `perbaikan_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `pelanggan` (`id_user`),
  ADD CONSTRAINT `perbaikan_ibfk_2` FOREIGN KEY (`id_device`) REFERENCES `device` (`id_device`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
