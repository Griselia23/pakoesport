-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 13 Jan 2025 pada 03.24
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
(2, '2025-01-10 04:30:24', 'mipan', 0, 'inko', '123456', '$2y$10$CjXtnjfDqkaP/Sj.S/jIHeYU6uaf0rRGCHk.btxk6b1HD/LAiBJFC', 'guguaga', '23145124', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ml', NULL, 'member'),
(3, '2025-01-10 04:43:20', 'abysss', 0, '2w', '12345', '$2y$10$6TSmSbU4zezUFFl5xRYQR.N.ScK4yles7WYOxjwIcvsPgIkPymn7O', 'bababab', '2341451231', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ml', NULL, 'member'),
(4, '2025-01-13 00:58:47', 'akutuh', 3, 'inko', '11111', '$2y$10$sn6itFkOrNGlIxri3kZcQecZMxIabfUvHbi4nfcTJZybfpWblGGai', 'bagus', '4124131', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'fifa', NULL, 'member'),
(5, '2025-01-13 01:25:44', 'Drowner', 0, 'inko', '09876', '$2y$10$I6AJSa6P1Ag3gOHZhB0HzuL1RLay9xhxmPQbNRsNnq1t.9d9Cshha', 'dawad', '3142131', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'fifa', NULL, 'member');

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
(1, 1, 'ml', '2025-01-09', 0, 0, 0, 0, NULL),
(2, 1, 'fifa', '2025-01-14', 0, 0, 0, 0, NULL);

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
-- AUTO_INCREMENT untuk tabel `register`
--
ALTER TABLE `register`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `schedule`
--
ALTER TABLE `schedule`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
