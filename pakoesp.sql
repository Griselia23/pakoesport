-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 08 Jan 2025 pada 15.46
-- Versi server: 10.4.22-MariaDB
-- Versi PHP: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
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
  `creation_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `team` varchar(255) NOT NULL,
  `points` int(11) NOT NULL DEFAULT 0,
  `plant` varchar(255) NOT NULL,
  `leadernpk` varchar(50) NOT NULL,
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
  `division` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `register`
--

INSERT INTO `register` (`id`, `creation_date`, `team`, `points`, `plant`, `leadernpk`, `leadername`, `number`, `member1npk`, `member1name`, `member2npk`, `member2name`, `member3npk`, `member3name`, `member4npk`, `member4name`, `member5npk`, `member5name`, `division`) VALUES
(1, '2025-01-03 07:03:07', 'inko1', 0, 'inko', '218219', 'Bani', '239102931-4', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ml'),
(2, '2025-01-03 07:03:27', 'assy1', 0, 'assy', '24123134', 'rizal', '2341412314', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ml'),
(3, '2025-01-07 03:24:09', '2w', 0, 'inko', '291830103', 'anu', '391892301', '3137127419', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ml'),
(4, '2025-01-07 04:26:38', 'fifa1', 0, 'inko', '313142', 'bani', '0293810', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'fifa'),
(5, '2025-01-07 04:26:57', 'fifa2', 0, '2w', '371930190', 'riski', '31309131', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'fifa'),
(6, '2025-01-07 04:34:05', 'fifa3', 0, 'inko', '231903810', 'hemmm', '32313', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'fifa'),
(7, '2025-01-07 04:34:27', 'fifa4', 0, '2w', '29310301', 'hadi', '3180839', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'fifa'),
(8, '2025-01-07 06:00:27', '4w', 0, '4w', '31441', 'hiihi', '3124231', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ml');

-- --------------------------------------------------------

--
-- Struktur dari tabel `result`
--

CREATE TABLE `result` (
  `id` int(11) NOT NULL,
  `creation_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `matches` varchar(255) NOT NULL,
  `points` int(11) DEFAULT 0,
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
  `start_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `schedule`
--

INSERT INTO `schedule` (`id`, `match_number`, `division`, `start_date`) VALUES
(5, 1, 'fifa', '2025-01-07'),
(7, 1, 'ml', '2025-01-10');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `npk` varchar(50) NOT NULL,
  `creation_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `npk`, `creation_date`) VALUES
(2, 'bagus', '$2y$10$BrQfN229KopDyB4bssR8U.o.wcjmSUYAdq6OY1opA6VY3blSIdwEO', 'os0945', '2025-01-02 04:48:10'),
(3, 'bani', '$2y$10$6V0BoXlsif0ZRKIH5a13k..yUqnLGxDCHXfsG3bRN39eULJ/B3GJq', '2137612', '2025-01-03 00:33:59');

--
-- Indexes for dumped tables
--

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
-- AUTO_INCREMENT untuk tabel `register`
--
ALTER TABLE `register`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `result`
--
ALTER TABLE `result`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `schedule`
--
ALTER TABLE `schedule`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
