-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 27 Jan 2021 pada 22.26
-- Versi server: 10.4.17-MariaDB
-- Versi PHP: 8.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `push_notification`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_subscribed`
--

CREATE TABLE `user_subscribed` (
  `id_u_subs` int(11) NOT NULL,
  `ip_address` char(30) NOT NULL,
  `os` char(30) NOT NULL,
  `platform` char(30) NOT NULL,
  `browser` char(30) NOT NULL,
  `endPoint` mediumtext NOT NULL,
  `authToken` tinytext NOT NULL,
  `publicKey` tinytext NOT NULL,
  `contentEncoding` tinytext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user_subscribed`
--

INSERT INTO `user_subscribed` (`id_u_subs`, `ip_address`, `os`, `platform`, `browser`, `endPoint`, `authToken`, `publicKey`, `contentEncoding`) VALUES
(35, '::1', 'Windows 10', 'Windows 10', 'Chrome', 'https://fcm.googleapis.com/fcm/send/c2_0hHNWWKs:APA91bEVcKXCvDn_cZR9e3dZuxAG4-8Mc3KAO1b3T40AHODzSy9vwUhmnyBhMZ2iSwWNlEiAo_2_4j0IUVT85PJrdTctufsyduMArRY3iEhLG9kRAfpUGJH638tu7fJk8vZZabdZCDHB', 'bRZv1WKsKooCIDAfLppg8A==', 'BFK6NtGt/VVdxePIKpuG84qhehNrjP8lIUOeepmuGiZDGB0awTcYZbCxuTZUwozi2KrEu9dqI7gR/WABOiVRW4c=', 'aes128gcm');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `user_subscribed`
--
ALTER TABLE `user_subscribed`
  ADD PRIMARY KEY (`id_u_subs`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `user_subscribed`
--
ALTER TABLE `user_subscribed`
  MODIFY `id_u_subs` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
