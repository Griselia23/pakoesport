-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 10 Jan 2025 pada 04.30
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
-- Struktur dari tabel `match_result`
--

CREATE TABLE `match_result` (
  `id` int(11) NOT NULL,
  `match_id` varchar(255) NOT NULL,
  `team_a_id` int(11) NOT NULL,
  `team_b_id` int(11) NOT NULL,
  `categ` varchar(50) NOT NULL,
  `team_a_name` varchar(100) NOT NULL,
  `team_b_name` varchar(100) NOT NULL,
  `match_title` varchar(255) NOT NULL,
  `match_day` date NOT NULL,
  `team_a_score` int(11) DEFAULT '0',
  `team_b_score` int(11) DEFAULT '0',
  `winner` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  `leadernpk` varchar(50) NOT NULL,
  `password` varchar(14) NOT NULL,
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
  `evidence` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `register`
--

INSERT INTO `register` (`id`, `creation_date`, `team`, `points`, `plant`, `leadernpk`, `password`, `leadername`, `number`, `member1npk`, `member1name`, `member2npk`, `member2name`, `member3npk`, `member3name`, `member4npk`, `member4name`, `member5npk`, `member5name`, `division`, `evidence`) VALUES
(2, '2025-01-09 06:33:07', 'Abysss', 1, '4w', '598103', '0', 'dandi', '378163', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ml', NULL),
(3, '2025-01-09 07:27:42', 'Ngege gaming', 2, 'inko', '412314', '0', 'bagus', '312421314213', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ml', NULL),
(4, '2025-01-09 08:20:19', 'Balada', 0, '4w', '371897391', '0', 'bani', '23831421', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ml', NULL),
(5, '2025-01-09 08:55:09', 'fifa1', 0, 'inko', '23142131', '0', 'bani', '12387198', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'fifa', NULL),
(6, '2025-01-09 08:55:38', 'fifa2', 0, '2w', '237193791', '0', 'riski', '23141314', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'fifa', NULL),
(7, '2025-01-09 08:55:59', 'fifa3', 0, '2w', '23141231', '0', 'nurman', '2141314', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'fifa', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `result`
--

CREATE TABLE `result` (
  `id` int(11) NOT NULL,
  `creation_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `matches` varchar(255) NOT NULL,
  `points` int(11) DEFAULT '0',
  `result` enum('win','lose','draw') NOT NULL,
  `upload` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
(1, 1, 'ml', '2025-01-09', 0, 0, 0, 0, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `npk` varchar(50) NOT NULL,
  `creation_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `npk`, `creation_date`) VALUES
(2, 'bagus', '$2y$10$BrQfN229KopDyB4bssR8U.o.wcjmSUYAdq6OY1opA6VY3blSIdwEO', 'os0945', '2025-01-02 04:48:10'),
(3, 'bani', '$2y$10$6V0BoXlsif0ZRKIH5a13k..yUqnLGxDCHXfsG3bRN39eULJ/B3GJq', '2137612', '2025-01-03 00:33:59'),
(4, 'bagas', '$2y$10$Cxj3anqU/08FuhLAodMG9.jRZtH2kH2UOSiyL.36DcJ7TgeyPBrCi', '11111', '2025-01-10 02:47:29');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `match_result`
--
ALTER TABLE `match_result`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `register`
--
ALTER TABLE `register`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `result`
--
ALTER TABLE `result`
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
-- AUTO_INCREMENT untuk tabel `match_result`
--
ALTER TABLE `match_result`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `register`
--
ALTER TABLE `register`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `result`
--
ALTER TABLE `result`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `schedule`
--
ALTER TABLE `schedule`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
