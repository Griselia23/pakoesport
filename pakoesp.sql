-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 15 Jan 2025 pada 05.08
-- Versi server: 10.1.38-MariaDB
-- Versi PHP: 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pakoesp`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `match_results`
--

CREATE TABLE `match_results` (
  `id` int(11) NOT NULL,
  `team_id_a` int(11) NOT NULL,
  `team_id_b` int(11) NOT NULL,
  `points_a` int(11) NOT NULL,
  `points_b` int(11) NOT NULL,
  `division` varchar(50) DEFAULT NULL,
  `match_date` datetime NOT NULL,
  `evidence_image` varchar(255) NOT NULL,
  `match_title` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `match_results`
--

INSERT INTO `match_results` (`id`, `team_id_a`, `team_id_b`, `points_a`, `points_b`, `division`, `match_date`, `evidence_image`, `match_title`) VALUES
(1, 1, 2, 1, 2, 'ml', '2025-01-15 05:04:41', 'uploads/ml/han3.jpg', 'ml1 vs. ml21');

-- --------------------------------------------------------

--
-- Struktur dari tabel `register`
--

CREATE TABLE `register` (
  `id` int(11) NOT NULL,
  `creation_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `team` varchar(255) NOT NULL,
  `points` int(11) NOT NULL DEFAULT '0',
  `plant` varchar(255) NOT NULL,
  `npk` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `leadername` varchar(255) NOT NULL,
  `number` varchar(50) NOT NULL,
  `member1npk` varchar(50) DEFAULT NULL,
  `member1name` varchar(255) DEFAULT NULL,
  `member2npk` varchar(50) DEFAULT NULL,
  `member2name` varchar(255) DEFAULT NULL,
  `member3npk` varchar(50) DEFAULT NULL,
  `member3name` varchar(255) DEFAULT NULL,
  `member4npk` varchar(50) DEFAULT NULL,
  `member4name` varchar(255) DEFAULT NULL,
  `member5npk` varchar(50) DEFAULT NULL,
  `member5name` varchar(255) DEFAULT NULL,
  `division` varchar(50) NOT NULL,
  `evidence` varchar(255) DEFAULT NULL,
  `role` varchar(50) NOT NULL DEFAULT 'member'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `register`
--

INSERT INTO `register` (`id`, `creation_date`, `team`, `points`, `plant`, `npk`, `password`, `leadername`, `number`, `member1npk`, `member1name`, `member2npk`, `member2name`, `member3npk`, `member3name`, `member4npk`, `member4name`, `member5npk`, `member5name`, `division`, `evidence`, `role`) VALUES
(1, '2025-01-14 04:24:10', 'ml1', 0, 'inko', '1313', '$2y$10$OKVJtltktKH/6m1YB31e8eZZ/OfSrVOEekUBz4MdqJWYU9lenT9Yi', 'bagus', '8127183', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ml', NULL, 'member'),
(2, '2025-01-14 04:24:34', 'ml21', 0, 'assy', '1414', '$2y$10$gpTnvce3IyqdoatLnmRFjO0nGmMUcSJeOv73ZQ/uCVLkCdQFu6eMO', 'bagus', '231412341', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ml', NULL, 'member'),
(3, '2025-01-14 04:25:17', 'ml3', 0, 'assy', '1515', '$2y$10$yRfJm71EoMLZOxzJsn3gV.AszAPuL6TIINu9as34sGDlSGQMUu9Xy', 'bagus', '7381638817', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ml', NULL, 'member'),
(4, '2025-01-14 06:20:25', 'fifa1', 0, 'inko', '7171', '$2y$10$S6g2R66EK4YzOat3VUG/zuUsXD8hBFITqcdGDplTZVCVLJMhI7x4W', 'bagus', '28391031', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'fifa', NULL, 'member'),
(5, '2025-01-14 06:20:45', 'fifa2', 0, 'inko', '7272', '$2y$10$5hI2JDTXT66RqtM08YMkDO0KdsAJ1hxBehC/3wUESROCDjy3QSaO6', 'bagus', '2412413', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'fifa', NULL, 'member'),
(6, '2025-01-14 06:21:14', 'fifa3', 0, 'inko', '7373', '$2y$10$BxXeXd1HspAzjyANXAyJoePB/8dhzBWtjFpG.5nIE.9ZUU8KqOq56', 'bagus', '1723617', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'fifa', NULL, 'member');

-- --------------------------------------------------------

--
-- Struktur dari tabel `schedule`
--

CREATE TABLE `schedule` (
  `id` int(11) NOT NULL,
  `match_number` int(11) NOT NULL,
  `division` enum('ml','fifa') NOT NULL,
  `start_date` date NOT NULL,
  `team_a_id` int(11) NOT NULL,
  `team_b_id` int(11) NOT NULL,
  `team_a_score` int(11) DEFAULT '0',
  `team_b_score` int(11) DEFAULT '0',
  `winner` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `schedule`
--

INSERT INTO `schedule` (`id`, `match_number`, `division`, `start_date`, `team_a_id`, `team_b_id`, `team_a_score`, `team_b_score`, `winner`) VALUES
(1, 1, 'ml', '2025-01-13', 0, 0, 0, 0, NULL),
(3, 1, 'fifa', '2025-01-14', 0, 0, 0, 0, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `npk` varchar(50) NOT NULL,
  `creation_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `role` varchar(50) NOT NULL DEFAULT 'admin'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `npk`, `creation_date`, `role`) VALUES
(2, 'bagus', '$2y$10$BrQfN229KopDyB4bssR8U.o.wcjmSUYAdq6OY1opA6VY3blSIdwEO', 'os0945', '2025-01-02 04:48:10', 'admin'),
(3, 'bani', '$2y$10$6V0BoXlsif0ZRKIH5a13k..yUqnLGxDCHXfsG3bRN39eULJ/B3GJq', '2137612', '2025-01-03 00:33:59', 'admin'),
(4, 'bagas', '$2y$10$Cxj3anqU/08FuhLAodMG9.jRZtH2kH2UOSiyL.36DcJ7TgeyPBrCi', '11111', '2025-01-10 02:47:29', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `match_results`
--
ALTER TABLE `match_results`
  ADD PRIMARY KEY (`id`),
  ADD KEY `team_id_a` (`team_id_a`),
  ADD KEY `team_id_b` (`team_id_b`);

--
-- Indeks untuk tabel `register`
--
ALTER TABLE `register`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `schedule`
--
ALTER TABLE `schedule`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `match_results`
--
ALTER TABLE `match_results`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `register`
--
ALTER TABLE `register`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `schedule`
--
ALTER TABLE `schedule`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `match_results`
--
ALTER TABLE `match_results`
  ADD CONSTRAINT `match_results_ibfk_1` FOREIGN KEY (`team_id_a`) REFERENCES `register` (`id`),
  ADD CONSTRAINT `match_results_ibfk_2` FOREIGN KEY (`team_id_b`) REFERENCES `register` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
