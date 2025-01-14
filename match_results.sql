-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 14 Jan 2025 pada 07.07
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
  `match_list_id` int(11) NOT NULL,
  `team_id_a` int(11) NOT NULL,
  `team_id_b` int(11) NOT NULL,
  `points_a` int(11) NOT NULL,
  `points_b` int(11) NOT NULL,
  `start_date` datetime NOT NULL,
  `division` varchar(50) DEFAULT NULL,
  `match_date` datetime NOT NULL,
  `evidence_image` varchar(255) NOT NULL,
  `match_title` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `match_results`
--

INSERT INTO `match_results` (`match_list_id`, `team_id_a`, `team_id_b`, `points_a`, `points_b`, `start_date`, `division`, `match_date`, `evidence_image`, `match_title`) VALUES
(3, 1, 3, 1, 2, '0000-00-00 00:00:00', NULL, '2025-01-14 05:56:13', 'uploads//Tangkapan_Layar_2025-01-13_pada_07_39_0625.png', 'ml1 vs. ml3'),
(4, 2, 3, 1, 2, '0000-00-00 00:00:00', NULL, '2025-01-14 07:04:05', 'uploads//Tangkapan_Layar_2025-01-13_pada_07_39_0626.png', 'ml2 vs. ml3');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `match_results`
--
ALTER TABLE `match_results`
  ADD PRIMARY KEY (`match_list_id`),
  ADD KEY `team_id_a` (`team_id_a`),
  ADD KEY `team_id_b` (`team_id_b`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `match_results`
--
ALTER TABLE `match_results`
  MODIFY `match_list_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

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
