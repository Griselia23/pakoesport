-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 14 Jan 2025 pada 05.31
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
  `start_date` date NOT NULL,
  `division` varchar(10) NOT NULL,
  `match_date` datetime NOT NULL,
  `evidence_image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `match_results`
--

INSERT INTO `match_results` (`id`, `team_id_a`, `team_id_b`, `points_a`, `points_b`, `start_date`, `division`, `match_date`, `evidence_image`) VALUES
(1, 1, 2, 1, 0, '0000-00-00', '', '2025-01-14 05:26:53', 'uploads//Tangkapan_Layar_2025-01-13_pada_07_39_0611.png');

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
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `match_results`
--
ALTER TABLE `match_results`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
