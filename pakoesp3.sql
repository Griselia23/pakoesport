-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 21 Jan 2025 pada 08.43
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
  `team_id_a` int(11) DEFAULT NULL,
  `team_id_b` int(11) DEFAULT NULL,
  `points_a` int(11) DEFAULT NULL,
  `points_b` int(11) DEFAULT NULL,
  `division` varchar(50) DEFAULT NULL,
  `match_date` date NOT NULL,
  `evidence_image` varchar(255) NOT NULL,
  `match_title` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `match_results`
--

INSERT INTO `match_results` (`id`, `team_id_a`, `team_id_b`, `points_a`, `points_b`, `division`, `match_date`, `evidence_image`, `match_title`) VALUES
(1, NULL, NULL, 2, 3, 'ml', '2025-01-21', 'uploads/ml/WhatsApp_Image_2025-01-09_at_12_32_106.jpeg', 'ml1  vs. ml2 '),
(2, 5, 6, 5, 4, 'ml', '2025-01-20', 'uploads/ml/Tangkapan_Layar_2025-01-13_pada_07_39_063.png', 'ml1  vs. ml2 ');

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
(1, '2025-01-17 04:27:00', 'fifa 1 ', 0, 'inko', '1616', '$2y$10$sXIvPu1w5TN1fSIE3BjPEuNT.F5Q4PgIppM22t2PdYMZRxvkWmysm', 'bababaab', '12908181', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'fifa', NULL, 'member'),
(2, '2025-01-17 04:27:31', 'fifa 2', 0, 'assy', '1414', '$2y$10$zrkl/.GgkJutd/vfrNCk9uB1pWA1EojJjJSnu.K3Qv5sQsEAg6sKm', 'bani', '28717871', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'fifa', NULL, 'member'),
(3, '2025-01-17 04:27:53', 'fifa 3 ', 0, 'assy2', '1919', '$2y$10$UxrC5fmLWqgvDc0cRDGTsO1i5T7GPJDxzM5.dHbD9rEyQSUb8vn5q', 'sdjajda', '314121', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'fifa', NULL, 'member'),
(4, '2025-01-17 04:28:57', 'fifa 4 ', 0, 'inko', '23142131', '$2y$10$hUhgLPdRxWZp8WkOkNBXI.25NVKUf.zwBRk4NVbArRCvauIsIDASK', 'dadwad', '3124213', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'fifa', NULL, 'member'),
(5, '2025-01-17 04:42:38', 'ml1 ', 0, 'inko', '1313', '$2y$10$EaSvAHg.wi8nVXWY6leoiOv/wFr6IS51NvC4kLa0ob/9N4OxPCR5G', 'dawda', '3213141', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ml', NULL, 'member'),
(6, '2025-01-17 04:43:31', 'ml2 ', 0, 'inko', '12121', '$2y$10$VJv4i8RxAM0VjLauJnqdBOmyVZI5xkJJ/WLh6kn/Tae1x2hLbpq52', 'sadhw', '231451231', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ml', NULL, 'member'),
(7, '2025-01-17 04:45:24', 'ml3 ', 0, 'assy ', '1616', '$2y$10$1w9c8u7ZSE/Vw3bBDcjz5Of2kRI8gf0.NUQzp8xsO38d7JMKUAFN2', 'adjwbaj', '2163187', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ml', NULL, 'member'),
(8, '2025-01-21 04:47:26', 'ml4', 0, 'assy', '1717', '$2y$10$jkKkjJ6l7FR3dok53x9klevnQbBB90B/hm6ozUzSKhG5IHofcZLLa', 'bapawi', '172617', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ml', NULL, 'member'),
(9, '2025-01-21 07:25:57', 'fifa5', 0, 'inkoasku', '16512', '$2y$10$whFAr5DMuAD/xS0biG.FaOgySFMlx0ynuO9d4ZkRJSyS.v1jSNppe', 'bagus', '28172816', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'fifa', NULL, 'member');

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
  `winner` varchar(255) DEFAULT NULL,
  `end_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `schedule`
--

INSERT INTO `schedule` (`id`, `match_number`, `division`, `start_date`, `team_a_id`, `team_b_id`, `team_a_score`, `team_b_score`, `winner`, `end_date`) VALUES
(1, 1, 'ml', '2025-01-20', 0, 0, 0, 0, NULL, '2025-01-22'),
(2, 1, 'fifa', '2025-01-20', 0, 0, 0, 0, NULL, '2025-01-23');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `register`
--
ALTER TABLE `register`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

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
