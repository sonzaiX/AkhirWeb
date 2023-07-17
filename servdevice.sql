-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 17 Jul 2023 pada 04.23
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
-- Database: `servdevice`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `akun`
--

CREATE TABLE `akun` (
  `id_user` int(11) NOT NULL,
  `id_pelanggan` int(11) NOT NULL,
  `username` char(15) NOT NULL,
  `katasandi` varchar(12) NOT NULL,
  `peran` char(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `akun`
--

INSERT INTO `akun` (`id_user`, `id_pelanggan`, `username`, `katasandi`, `peran`) VALUES
(1, 1, 'fsyam', '1212', 'admin'),
(2, 2, 'yanto', 'yanto', 'biasa');

-- --------------------------------------------------------

--
-- Struktur dari tabel `device`
--

CREATE TABLE `device` (
  `id_device` int(11) NOT NULL,
  `merek` varchar(25) DEFAULT NULL,
  `model` varchar(25) DEFAULT NULL,
  `tipe` varchar(15) DEFAULT NULL,
  `deskripsi` varchar(25) DEFAULT NULL,
  `sn` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `device`
--

INSERT INTO `device` (`id_device`, `merek`, `model`, `tipe`, `deskripsi`, `sn`) VALUES
(1, 'lenovo', 'Notebook', 'Business', 'aefa', 859303),
(2, 'lenovo', 'Notebook', 'Business', 'aefa', 859303),
(3, 'lenovo', 'Notebook', 'Business', 'aefa', 859303),
(4, 'lenovo', 'Notebook', 'Business', 'aefa', 859303),
(5, 'lenovo', 'Notebook', 'Business', 'aefa', 859303),
(6, 'lenovo', 'Notebook', 'Business', 'aefa', 859303);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id_pelanggan` int(11) NOT NULL,
  `nama` varchar(25) DEFAULT NULL,
  `alamat` varchar(25) DEFAULT NULL,
  `telepon` varchar(15) DEFAULT NULL,
  `email` char(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pelanggan`
--

INSERT INTO `pelanggan` (`id_pelanggan`, `nama`, `alamat`, `telepon`, `email`) VALUES
(1, 'Fatta', 'Ungaran', '085280028725', 'fsyam67@gmail.com'),
(2, 'yanto', 'Ambarawa', '085342565775', 'yanto21@gmail.com');

-- --------------------------------------------------------

--
-- Struktur dari tabel `perbaikan`
--

CREATE TABLE `perbaikan` (
  `id_perbaikan` int(11) NOT NULL,
  `id_pelanggan` int(11) NOT NULL,
  `id_device` int(11) NOT NULL,
  `desk_kerusakan` varchar(25) DEFAULT NULL,
  `status` varchar(15) DEFAULT NULL,
  `perangkat_masuk` date DEFAULT NULL,
  `estimasi_selesai` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `perbaikan`
--

INSERT INTO `perbaikan` (`id_perbaikan`, `id_pelanggan`, `id_device`, `desk_kerusakan`, `status`, `perangkat_masuk`, `estimasi_selesai`) VALUES
(1, 2, 4, 'safas', 'Dalam Proses', '2023-07-17', '2023-07-18'),
(2, 2, 5, 'safas', 'Tertunda', '2023-07-17', NULL),
(3, 2, 6, 'safas', 'Tertunda', '2023-07-17', NULL);

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
  ADD PRIMARY KEY (`id_pelanggan`);

--
-- Indeks untuk tabel `perbaikan`
--
ALTER TABLE `perbaikan`
  ADD PRIMARY KEY (`id_perbaikan`),
  ADD KEY `id_pelanggan` (`id_pelanggan`),
  ADD KEY `id_device` (`id_device`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `akun`
--
ALTER TABLE `akun`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `device`
--
ALTER TABLE `device`
  MODIFY `id_device` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `id_pelanggan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `perbaikan`
--
ALTER TABLE `perbaikan`
  MODIFY `id_perbaikan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `akun`
--
ALTER TABLE `akun`
  ADD CONSTRAINT `akun_ibfk_1` FOREIGN KEY (`id_pelanggan`) REFERENCES `pelanggan` (`id_pelanggan`);

--
-- Ketidakleluasaan untuk tabel `perbaikan`
--
ALTER TABLE `perbaikan`
  ADD CONSTRAINT `perbaikan_ibfk_1` FOREIGN KEY (`id_pelanggan`) REFERENCES `pelanggan` (`id_pelanggan`) ON DELETE CASCADE,
  ADD CONSTRAINT `perbaikan_ibfk_2` FOREIGN KEY (`id_device`) REFERENCES `device` (`id_device`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
