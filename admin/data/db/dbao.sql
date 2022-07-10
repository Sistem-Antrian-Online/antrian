-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 10 Jul 2022 pada 15.59
-- Versi server: 10.4.24-MariaDB
-- Versi PHP: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbao`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `antrian`
--

CREATE TABLE `antrian` (
  `id` int(11) NOT NULL,
  `no_antrian` varchar(12) NOT NULL,
  `waktu` datetime NOT NULL,
  `status` varchar(20) NOT NULL,
  `id_poli` char(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `antrian`
--

INSERT INTO `antrian` (`id`, `no_antrian`, `waktu`, `status`, `id_poli`) VALUES
(27, 'J001', '2022-06-17 09:59:18', 'Proses', '10'),
(30, 'K001', '2022-06-17 10:40:37', 'Belum', '11'),
(33, 'K002', '2022-06-17 10:43:00', 'Belum', '11'),
(34, 'K003', '2022-06-17 10:44:20', 'Belum', '11'),
(37, 'N001', '2022-06-24 08:28:47', 'Belum', '14'),
(38, 'R001', '2022-06-24 08:30:39', 'Belum', '18'),
(40, 'A001', '2022-06-24 08:36:20', 'Selesai', '1'),
(41, 'A002', '2022-06-24 08:37:13', 'Melayani', '1'),
(42, 'J002', '2022-06-24 09:38:19', 'Belum', '10'),
(43, 'J003', '2022-06-24 09:39:02', 'Belum', '10'),
(44, 'L001', '2022-06-24 09:39:06', 'Belum', '12'),
(45, 'J004', '2022-06-24 09:45:05', 'Belum', '10'),
(46, 'J005', '2022-06-24 09:49:04', 'Belum', '10'),
(47, 'A003', '2022-06-24 09:49:51', 'Belum', '1'),
(48, 'J006', '2022-06-24 09:53:10', 'Belum', '10'),
(49, 'J007', '2022-06-24 09:54:18', 'Belum', '10'),
(50, 'J008', '2022-06-24 09:55:04', 'Belum', '10'),
(51, 'A004', '2022-06-24 09:57:47', 'Belum', '1'),
(52, 'J009', '2022-06-24 09:57:59', 'Belum', '10'),
(53, 'J010', '2022-06-24 09:58:41', 'Belum', '10'),
(54, 'J011', '2022-06-24 09:59:04', 'Belum', '10'),
(55, 'J012', '2022-06-24 10:02:32', 'Belum', '10'),
(56, 'J013', '2022-06-24 10:02:38', 'Belum', '10'),
(57, 'J014', '2022-06-24 10:03:55', 'Belum', '10'),
(58, 'A005', '2022-06-24 11:39:16', 'Belum', '1'),
(59, 'S001', '2022-06-24 11:40:55', 'Belum', '19'),
(60, 'A006', '2022-07-08 09:54:42', 'Belum', '1'),
(61, 'M001', '2022-07-08 12:42:54', 'Selesai', '13');

-- --------------------------------------------------------

--
-- Struktur dari tabel `dokter`
--

CREATE TABLE `dokter` (
  `id_dokter` char(10) NOT NULL,
  `nama` varchar(225) NOT NULL,
  `jk` varchar(100) NOT NULL,
  `spesialis` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `dokter`
--

INSERT INTO `dokter` (`id_dokter`, `nama`, `jk`, `spesialis`) VALUES
('1', 'Dr.Andre A', 'Pria', 'Bedah'),
('2', 'Rizki', 'Pria', 'Syaraf'),
('3', 'Khusnul', 'Wanita', 'Umum');

-- --------------------------------------------------------

--
-- Struktur dari tabel `poli`
--

CREATE TABLE `poli` (
  `id_poli` char(10) NOT NULL,
  `nama` varchar(225) NOT NULL,
  `deskripsi` varchar(225) NOT NULL,
  `loket` varchar(225) NOT NULL,
  `id_dokter` char(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `poli`
--

INSERT INTO `poli` (`id_poli`, `nama`, `deskripsi`, `loket`, `id_dokter`) VALUES
('1', 'ANAK & TUMBUH KEMBANG', '', 'A', '1'),
('10', 'JANTUNG & PEMBULUH DARAH', '', 'J', '1'),
('11', 'ORTHOPEDI', '', 'K', '1'),
('12', 'KULIT & KELAMIN', '', 'L', '1'),
('13', 'BEDAH SYARAF', '', 'M', '1'),
('14', 'BEDAH PLASTIK', '', 'N', '1'),
('15', 'UROLOGI', '', 'O', '1'),
('16', 'PSIKOLOGI', '', 'P', '1'),
('17', 'KESEHATAN JIWA', '', 'Q', '1'),
('18', 'KESEHATAN', '', 'R', '1'),
('19', 'VCT', '', 'S', '1'),
('2', 'DALAM', '', 'B', '1'),
('20', 'MEDHICAL CHECK UP', '', 'T', '3'),
('3', 'OBSTETRI & GINEKOLOGI', '', 'C', '1'),
('4', 'BEDAH', '', 'D', '1'),
('5', 'GIGI', '', 'E', '1'),
('6', 'MATA', '', 'F', '1'),
('7', 'THT', '', 'G', '1'),
('8', 'SYARAF', '', 'H', '1'),
('9', 'PARU', '', 'I', '1');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `nama` varchar(225) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `level` varchar(20) NOT NULL,
  `id_poli` char(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `nama`, `username`, `password`, `level`, `id_poli`) VALUES
(1, 'Andre', 'admin', '123456', '1', ''),
(2, 'Siska', 'siska', '123456', '2', '1'),
(3, 'Ajis', 'ajis', '123456', '2', '4');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `antrian`
--
ALTER TABLE `antrian`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_poli` (`id_poli`);

--
-- Indeks untuk tabel `dokter`
--
ALTER TABLE `dokter`
  ADD PRIMARY KEY (`id_dokter`);

--
-- Indeks untuk tabel `poli`
--
ALTER TABLE `poli`
  ADD PRIMARY KEY (`id_poli`),
  ADD KEY `id_dokter` (`id_dokter`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_poli` (`id_poli`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `antrian`
--
ALTER TABLE `antrian`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `antrian`
--
ALTER TABLE `antrian`
  ADD CONSTRAINT `antrian_ibfk_1` FOREIGN KEY (`id_poli`) REFERENCES `poli` (`id_poli`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `poli`
--
ALTER TABLE `poli`
  ADD CONSTRAINT `poli_ibfk_1` FOREIGN KEY (`id_dokter`) REFERENCES `dokter` (`id_dokter`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
