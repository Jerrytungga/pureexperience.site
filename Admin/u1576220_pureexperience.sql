-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 07 Feb 2023 pada 13.18
-- Versi server: 10.5.17-MariaDB-cll-lve
-- Versi PHP: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u1576220_pureexperience`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `activity`
--

CREATE TABLE `activity` (
  `id_activity` int(4) NOT NULL DEFAULT 0,
  `items` char(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `activity`
--

INSERT INTO `activity` (`id_activity`, `items`) VALUES
(1, 'Morning Revival'),
(2, 'Bible Reading'),
(3, 'Exhibition'),
(4, 'Orientasi'),
(5, 'Briefing & Evaluasi'),
(6, 'GOW'),
(7, 'Ministry'),
(8, 'Prophesying'),
(9, 'Life'),
(10, 'Bible Research'),
(11, 'Hebrew Language'),
(12, 'Video Training'),
(13, 'Special Fellowship'),
(14, 'Experience of life'),
(15, 'Character Project'),
(16, 'Mandarin'),
(17, 'Church History'),
(18, 'Truth'),
(19, 'Bible'),
(20, 'Character'),
(21, 'How To Study'),
(22, 'Introduction'),
(23, 'Pengarahan Pengisian Form'),
(24, 'DBHT'),
(25, 'Guidance Morning'),
(26, 'Greek Language'),
(27, 'GOW Research TW'),
(28, 'Doa Puasa'),
(29, 'Pelayanan Khusus'),
(30, 'Group Study'),
(31, 'GOW Research  Campus Work'),
(32, 'GOW Reasearch Community Work'),
(33, 'LESSON ON PRAYER'),
(34, 'Training Manual'),
(35, 'PRESENTATION'),
(36, 'Truth Presentation'),
(37, 'PROPAGATION TEAM FELLOWSHIP'),
(38, 'Pembacaan form'),
(39, 'BEBAN, SIFAT, DAN TUJUAN PELATIHAN (2)'),
(40, 'DOA'),
(41, 'Pengajaran Para Rasul'),
(42, 'Visi Pelatihan'),
(43, 'Visi Doa'),
(44, 'Class'),
(45, 'PP'),
(46, 'THE EXCELLING GIFT FOR THE BUILDING UP O'),
(47, 'THE MEANING OF PRAYER'),
(54, 'THE MEANING OF PRAYER');

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE `admin` (
  `id` int(3) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp(),
  `Name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `date`, `Name`) VALUES
(1, 'admin', 'admin', '2022-10-18 10:59:10', 'Admin-Ftti');

-- --------------------------------------------------------

--
-- Struktur dari tabel `asisten`
--

CREATE TABLE `asisten` (
  `nip` varchar(250) NOT NULL,
  `image` text NOT NULL,
  `name` varchar(50) NOT NULL,
  `gender` enum('B','S') NOT NULL,
  `status` enum('Aktif','Tidak Aktif') NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp(),
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `id_as` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `asisten`
--

INSERT INTO `asisten` (`nip`, `image`, `name`, `gender`, `status`, `date`, `username`, `password`, `id_as`) VALUES
('77777', '', 'Radiva', 'B', 'Aktif', '2023-01-28 14:41:48', 'radiv', 'radiv', 1),
('88888', '', 'Timotius Samuel', 'B', 'Aktif', '2023-01-28 21:22:36', 'samuel', '1234', 2),
('55555', '', 'DEDEH', 'S', 'Aktif', '2023-01-28 21:22:36', 'Dedeh', '1234', 3),
('7878787', '', 'WAHYUNI', 'S', 'Aktif', '2023-01-28 21:22:36', 'Wahyuni', '1234', 4);

-- --------------------------------------------------------

--
-- Struktur dari tabel `presensi`
--

CREATE TABLE `presensi` (
  `nip` int(10) NOT NULL,
  `batch` varchar(10) DEFAULT NULL,
  `week` text DEFAULT NULL,
  `id_activity` int(11) NOT NULL,
  `presensi_date` date DEFAULT current_timestamp(),
  `presensi_time` time NOT NULL,
  `mark` char(1) DEFAULT NULL,
  `info_schedule` text DEFAULT NULL,
  `id_presensi` int(11) NOT NULL,
  `schedule_id` int(11) NOT NULL,
  `semester` int(11) NOT NULL,
  `asisten` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `presensi`
--

INSERT INTO `presensi` (`nip`, `batch`, `week`, `id_activity`, `presensi_date`, `presensi_time`, `mark`, `info_schedule`, `id_presensi`, `schedule_id`, `semester`, `asisten`) VALUES
(367972, '51', 'R1', 9, '2023-02-07', '09:04:06', 'V', '', 11, 1, 20222, 77777),
(367972, 'ALL', 'R1', 18, '2023-02-07', '10:37:09', 'V', '', 11, 8, 20222, 77777),
(507841, '52', 'R1', 9, '2023-02-07', '09:04:06', 'V', '', 12, 7, 20231, 88888),
(507841, 'ALL', 'R1', 18, '2023-02-07', '10:43:38', 'V', '', 44, 8, 20231, 88888),
(4008890, '51', 'R1', 9, '2023-02-07', '09:05:54', 'V', '', 36, 1, 20222, 55555),
(4008890, 'ALL', 'R1', 18, '2023-02-07', '10:39:41', 'V', '', 25, 8, 20222, 55555),
(4008931, '51', 'R1', 9, '2023-02-07', '09:05:29', 'V', '', 27, 1, 20222, 55555),
(4008931, 'ALL', 'R1', 18, '2023-02-07', '10:38:49', 'V', '', 18, 8, 20222, 55555),
(4013125, '51', 'R1', 9, '2023-02-07', '09:06:13', 'V', '', 40, 1, 20222, 55555),
(4013125, 'ALL', 'R1', 18, '2023-02-07', '10:41:35', 'V', '', 35, 8, 20222, 55555),
(4013188, '51', 'R1', 9, '2023-02-07', '09:05:22', 'V', '', 24, 1, 20222, 55555),
(4013188, 'ALL', 'R1', 18, '2023-02-07', '10:37:41', 'V', '', 12, 8, 20222, 55555),
(4055502, 'ALL', 'R1', 18, '2023-02-07', '10:41:57', 'V', '', 39, 8, 20222, 55555),
(4056244, '51', 'R1', 9, '2023-02-07', '09:05:18', 'V', '', 22, 1, 20222, 55555),
(4056244, 'ALL', 'R1', 18, '2023-02-07', '10:39:06', 'V', '', 21, 8, 20222, 55555),
(4102260, '52', 'R1', 9, '2023-02-07', '09:05:19', 'V', '', 23, 7, 20231, 7878787),
(4102260, 'ALL', 'R1', 18, '2023-02-07', '10:41:45', 'V', '', 36, 8, 20231, 7878787),
(4123857, '51', 'R1', 9, '2023-02-07', '09:04:23', 'V', '', 17, 1, 20222, 77777),
(4123857, 'ALL', 'R1', 18, '2023-02-07', '10:40:28', 'V', '', 29, 8, 20222, 77777),
(4123986, '51', 'R1', 9, '2023-02-07', '09:03:31', 'V', '', 4, 1, 20222, 77777),
(4123986, 'ALL', 'R1', 18, '2023-02-07', '10:36:51', 'V', '', 8, 8, 20222, 77777),
(4124067, '51', 'R1', 9, '2023-02-07', '09:05:58', 'V', '', 37, 1, 20222, 7878787),
(4124067, 'ALL', 'R1', 18, '2023-02-07', '10:37:59', 'V', '', 13, 8, 20222, 7878787),
(4124921, '52', 'R1', 9, '2023-02-07', '09:05:58', 'V', '', 38, 7, 20231, 7878787),
(4124921, 'ALL', 'R1', 18, '2023-02-07', '10:40:12', 'V', '', 26, 8, 20231, 7878787),
(4148324, '51', 'R1', 9, '2023-02-07', '09:06:35', 'V', '', 43, 1, 20222, 77777),
(4148324, 'ALL', 'R1', 18, '2023-02-07', '10:37:01', 'V', '', 10, 8, 20222, 77777),
(4205576, '52', 'R1', 9, '2023-02-07', '09:05:31', 'V', '', 28, 7, 20231, 55555),
(4205576, 'ALL', 'R1', 18, '2023-02-07', '10:43:43', 'V', '', 45, 8, 20231, 55555),
(4266335, '52', 'R1', 9, '2023-02-07', '09:05:34', 'V', '', 31, 7, 20231, 55555),
(4266335, 'ALL', 'R1', 18, '2023-02-07', '10:40:18', 'V', '', 28, 8, 20231, 55555),
(4303272, '51', 'R1', 9, '2023-02-07', '09:05:41', 'V', '', 34, 1, 20222, 55555),
(4303272, 'ALL', 'R1', 18, '2023-02-07', '10:36:33', 'V', '', 7, 8, 20222, 55555),
(4311752, '51', 'R1', 9, '2023-02-07', '09:03:07', 'V', '', 2, 1, 20222, 77777),
(4311752, 'ALL', 'R1', 18, '2023-02-07', '10:35:38', 'V', '', 4, 8, 20222, 77777),
(4320474, '51', 'R1', 9, '2023-02-07', '09:05:31', 'V', '', 29, 1, 20222, 7878787),
(4320474, 'ALL', 'R1', 18, '2023-02-07', '10:38:38', 'V', '', 15, 8, 20222, 7878787),
(4332819, '51', 'R1', 9, '2023-02-07', '09:06:24', 'V', '', 41, 1, 20222, 7878787),
(4332819, 'ALL', 'R1', 18, '2023-02-07', '10:38:40', 'V', '', 16, 8, 20222, 7878787),
(4391440, '51', 'R1', 9, '2023-02-07', '09:06:01', 'V', '', 39, 1, 20222, 7878787),
(4391440, 'ALL', 'R1', 18, '2023-02-07', '10:36:06', 'V', '', 5, 8, 20222, 7878787),
(4393863, '51', 'R1', 9, '2023-02-07', '09:05:02', 'V', '', 19, 1, 20222, 88888),
(4393863, 'ALL', 'R1', 16, '2023-02-07', '06:49:31', 'V', '', 1, 6, 20222, 88888),
(4393863, 'ALL', 'R1', 18, '2023-02-07', '10:34:52', 'V', '', 3, 8, 20222, 88888),
(4397311, '52', 'R1', 9, '2023-02-07', '09:04:02', 'V', '', 10, 7, 20222, 77777),
(4397311, 'ALL', 'R1', 18, '2023-02-07', '10:38:50', 'V', '', 19, 8, 20222, 77777),
(4397464, '51', 'R1', 9, '2023-02-07', '09:05:33', 'V', '', 30, 1, 20222, 7878787),
(4397464, 'ALL', 'R1', 18, '2023-02-07', '10:41:53', 'V', '', 38, 8, 20222, 7878787),
(4512807, '52', 'R1', 9, '2023-02-07', '09:03:11', 'V', '', 3, 7, 20231, 88888),
(4512807, 'ALL', 'R1', 18, '2023-02-07', '10:40:15', 'V', '', 27, 8, 20231, 88888),
(4514281, '52', 'R1', 9, '2023-02-07', '09:05:38', 'V', '', 33, 7, 20222, 55555),
(4514281, 'ALL', 'R1', 18, '2023-02-07', '10:41:51', 'V', '', 37, 8, 20222, 55555),
(4514436, '52', 'R1', 9, '2023-02-07', '09:04:33', 'V', '', 18, 7, 20231, 77777),
(4514436, 'ALL', 'R1', 18, '2023-02-07', '10:43:34', 'V', '', 43, 8, 20231, 77777),
(4515081, '52', 'R1', 9, '2023-02-07', '09:05:18', 'V', '', 21, 7, 20231, 55555),
(4515081, 'ALL', 'R1', 18, '2023-02-07', '10:41:12', 'V', '', 32, 8, 20231, 55555),
(4515170, '52', 'R1', 9, '2023-02-07', '09:09:40', 'V', '', 45, 7, 20231, 77777),
(4515170, 'ALL', 'R1', 18, '2023-02-07', '10:41:24', 'V', '', 34, 8, 20231, 77777),
(4525896, '52', 'R1', 9, '2023-02-07', '09:05:26', 'V', '', 26, 7, 20231, 7878787),
(4525896, 'ALL', 'R1', 18, '2023-02-07', '10:40:28', 'V', '', 30, 8, 20231, 7878787),
(4570447, '51', 'R1', 9, '2023-02-07', '09:05:43', 'V', '', 35, 1, 20222, 7878787),
(4570447, 'ALL', 'R1', 18, '2023-02-07', '10:39:30', 'V', '', 23, 8, 20222, 7878787),
(4575313, '51', 'R1', 9, '2023-02-07', '09:05:25', 'V', '', 25, 1, 20222, 7878787),
(4575313, 'ALL', 'R1', 18, '2023-02-07', '10:40:52', 'V', '', 31, 8, 20222, 7878787),
(4575832, '52', 'R1', 9, '2023-02-07', '09:04:10', 'V', '', 13, 7, 20231, 77777),
(4575832, 'ALL', 'R1', 18, '2023-02-07', '10:41:16', 'V', '', 33, 8, 20231, 77777),
(4577754, '51', 'R1', 9, '2023-02-07', '09:06:29', 'V', '', 42, 1, 20222, 55555),
(4577754, 'ALL', 'R1', 18, '2023-02-07', '10:39:19', 'V', '', 22, 8, 20222, 55555),
(4595588, '52', 'R1', 9, '2023-02-07', '09:03:37', 'V', '', 6, 7, 20222, 77777),
(4595588, 'ALL', 'R1', 18, '2023-02-07', '10:42:00', 'V', '', 40, 8, 20222, 77777),
(4595804, '51', 'R1', 9, '2023-02-07', '09:05:35', 'V', '', 32, 1, 20222, 7878787),
(4595804, 'ALL', 'R1', 18, '2023-02-07', '10:38:35', 'V', '', 14, 8, 20222, 7878787),
(4843419, '52', 'R1', 9, '2023-02-07', '09:04:14', 'V', '', 15, 7, 20231, 77777),
(4843419, 'ALL', 'R1', 18, '2023-02-07', '10:39:34', 'V', '', 24, 8, 20231, 77777),
(4843525, '52', 'R1', 9, '2023-02-07', '09:03:56', 'V', '', 7, 7, 20231, 88888),
(4843525, 'ALL', 'R1', 18, '2023-02-07', '10:39:02', 'V', '', 20, 8, 20231, 88888),
(4844627, '52', 'R1', 9, '2023-02-07', '09:03:59', 'V', '', 8, 7, 20222, 88888),
(4844627, 'ALL', 'R1', 18, '2023-02-07', '10:42:53', 'V', '', 41, 8, 20222, 88888),
(7561448, '52', 'R1', 9, '2023-02-07', '09:05:06', 'V', '', 20, 7, 20231, 88888),
(7561448, 'ALL', 'R1', 18, '2023-02-07', '10:43:31', 'V', '', 42, 8, 20231, 88888),
(11295475, '51', 'R1', 9, '2023-02-07', '09:04:11', 'V', '', 14, 1, 20222, 77777),
(11295475, 'ALL', 'R1', 18, '2023-02-07', '10:36:58', 'V', '', 9, 8, 20222, 77777),
(11514203, '51', 'R1', 9, '2023-02-07', '09:07:36', 'V', '', 44, 1, 20222, 88888),
(11514203, 'ALL', 'R1', 18, '2023-02-07', '10:34:46', 'V', '', 2, 8, 20222, 88888),
(11516474, '51', 'R1', 9, '2023-02-07', '09:04:01', 'V', '', 9, 1, 20222, 88888),
(11516474, 'ALL', 'R1', 18, '2023-02-07', '10:38:45', 'V', '', 17, 8, 20222, 88888),
(11521203, '51', 'R1', 9, '2023-02-07', '09:03:36', 'V', '', 5, 1, 20222, 88888),
(11521203, 'ALL', 'R1', 18, '2023-02-07', '10:34:42', 'V', '', 1, 8, 20222, 88888),
(11585580, '51', 'R1', 9, '2023-02-07', '09:04:18', 'V', '', 16, 1, 20222, 88888),
(11585580, 'ALL', 'R1', 18, '2023-02-07', '10:36:07', 'V', '', 6, 8, 20222, 88888);

-- --------------------------------------------------------

--
-- Struktur dari tabel `ringtones`
--

CREATE TABLE `ringtones` (
  `id_alarm` int(2) NOT NULL,
  `Ringtones` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `ringtones`
--

INSERT INTO `ringtones` (`id_alarm`, `Ringtones`) VALUES
(2, 'and-he-showed-me-a-river.mp3'),
(4, 'Don_t Forget.mp3'),
(5, 'K342 - Hidup Tuk Yesus (Miscellaneous Service Audio _ Zoom Sentul).mp3');

-- --------------------------------------------------------

--
-- Struktur dari tabel `schedule`
--

CREATE TABLE `schedule` (
  `batch` varchar(10) NOT NULL,
  `week` varchar(12) NOT NULL,
  `id_activity` int(4) NOT NULL,
  `info` text DEFAULT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `presensi_time` time NOT NULL,
  `status` enum('Aktif','Tidak Aktif') NOT NULL,
  `date` date NOT NULL,
  `participant` enum('ALL','IPS','IPA','') DEFAULT NULL,
  `timer` time NOT NULL,
  `id` int(11) UNSIGNED NOT NULL,
  `nada_alarm` text NOT NULL,
  `id_berita` int(11) NOT NULL,
  `id_trainer` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `schedule`
--

INSERT INTO `schedule` (`batch`, `week`, `id_activity`, `info`, `start_time`, `end_time`, `presensi_time`, `status`, `date`, `participant`, `timer`, `id`, `nada_alarm`, `id_berita`, `id_trainer`) VALUES
('51', 'R1', 9, '', '09:15:00', '10:30:00', '09:03:00', 'Aktif', '2023-02-07', NULL, '09:18:00', 1, 'Don_t Forget.mp3', 66, 7),
('ALL', 'R1', 18, '', '10:45:00', '00:00:00', '10:30:00', 'Aktif', '2023-02-07', NULL, '10:48:00', 2, 'Don_t Forget.mp3', 3, 7),
('ALL', 'R1', 33, '', '15:15:00', '18:30:00', '15:00:00', 'Aktif', '2023-02-07', NULL, '15:18:00', 3, 'and-he-showed-me-a-river.mp3', 1, 5),
('ALL', 'R1', 19, '', '18:45:00', '18:00:00', '18:30:00', 'Aktif', '2023-02-07', NULL, '18:48:00', 4, 'Don_t Forget.mp3', 59, 3),
('ALL', 'R1', 17, '', '19:15:00', '20:30:00', '18:48:00', 'Aktif', '2023-02-07', NULL, '19:18:00', 5, 'Don_t Forget.mp3', 60, 9),
('ALL', 'R1', 16, '', '06:50:00', '07:43:00', '06:46:00', 'Aktif', '2023-02-07', NULL, '06:59:00', 6, 'K342 - Hidup Tuk Yesus (Miscellaneous Service Audio _ Zoom Sentul).mp3', 68, 11),
('52', 'R1', 9, '', '09:15:00', '10:30:00', '09:03:00', 'Aktif', '2023-02-07', NULL, '09:18:00', 7, 'Don_t Forget.mp3', 69, 8),
('ALL', 'R1', 18, '', '10:45:00', '12:00:00', '09:30:00', 'Aktif', '2023-02-07', NULL, '09:48:00', 8, 'Don_t Forget.mp3', 3, 7);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_angkatan`
--

CREATE TABLE `tb_angkatan` (
  `angkatan` varchar(10) DEFAULT NULL,
  `id` int(2) NOT NULL,
  `tgl` date NOT NULL DEFAULT current_timestamp(),
  `semester` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_angkatan`
--

INSERT INTO `tb_angkatan` (`angkatan`, `id`, `tgl`, `semester`) VALUES
('51', 1, '2022-08-23', 20232),
('52', 2, '2023-01-28', 20232),
('ALL', 3, '2023-01-28', 20232);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_daftar_berita`
--

CREATE TABLE `tb_daftar_berita` (
  `id_berita` int(11) NOT NULL,
  `daftar_berita` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_daftar_berita`
--

INSERT INTO `tb_daftar_berita` (`id_berita`, `daftar_berita`) VALUES
(1, 'LESSON ON PRAYER'),
(2, 'WHAT IS LIFE'),
(3, 'THE CHURCH - BRIEF OVERVIEW'),
(59, 'BIBLE'),
(60, 'CHURCH HISTORY'),
(61, 'CHARACTER'),
(62, 'TRUTH'),
(63, 'THE HIDDEN MYSTARY IN GODS ETERNAL ECONOMY'),
(64, 'PERSONAL STUDY TIME'),
(65, 'THE REVALATION OF THE MYSTERY OF CHRIST (1)'),
(66, 'CONSECRATION (1)'),
(67, 'IMAN INJIL PERJANJIAN BARU'),
(68, 'THREE KINDS OF MINISTERS'),
(69, 'WHAT IS LIFE');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_doa`
--

CREATE TABLE `tb_doa` (
  `nip` int(10) NOT NULL,
  `batch` varchar(255) NOT NULL,
  `week` varchar(255) NOT NULL,
  `time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `P` varchar(1) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp(),
  `asisten` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_doa`
--

INSERT INTO `tb_doa` (`nip`, `batch`, `week`, `time`, `P`, `date`, `asisten`) VALUES
(11521203, '51', 'R1', '2023-02-07 03:34:16', '1', '2023-02-07', 88888),
(4311752, '51', 'R1', '2023-02-07 03:35:17', '1', '2023-02-07', 77777),
(4123857, '51', 'R1', '2023-02-07 03:35:21', '1', '2023-02-07', 77777),
(4013125, '1', 'R1', '2023-02-07 03:35:49', '1', '2023-02-07', 55555),
(4303272, '51', 'R1', '2023-02-07 03:36:16', '1', '2023-02-07', 55555),
(4123986, '51', 'R1', '2023-02-07 03:36:40', '1', '2023-02-07', 77777),
(4102260, '52', 'R1', '2023-02-07 03:37:51', '1', '2023-02-07', 7878787),
(4844627, '52', 'R1', '2023-02-07 03:38:02', '1', '2023-02-07', 88888),
(4525896, '52', 'R1', '2023-02-07 03:38:06', '1', '2023-02-07', 7878787),
(4525896, '52', 'R1', '2023-02-07 03:38:08', '1', '2023-02-07', 7878787),
(4320474, '51', 'R1', '2023-02-07 03:38:13', '1', '2023-02-07', 7878787),
(4595804, '51', 'R1', '2023-02-07 03:38:14', '1', '2023-02-07', 7878787),
(4514281, '52', 'R1', '2023-02-07 03:38:19', '1', '2023-02-07', 55555),
(4332819, '51', 'R1', '2023-02-07 03:38:21', '1', '2023-02-07', 7878787),
(4843419, '52', 'R1', '2023-02-07 03:38:28', '1', '2023-02-07', 77777),
(4843525, '52', 'R1', '2023-02-07 03:39:23', '1', '2023-02-07', 88888),
(4266335, '52', 'R1', '2023-02-07 03:39:48', '1', '2023-02-07', 55555),
(4515081, '52', 'R1', '2023-02-07 03:39:59', '1', '2023-02-07', 55555),
(4512807, '52', 'R1', '2023-02-07 03:41:02', '1', '2023-02-07', 88888),
(7561448, '52', 'R1', '2023-02-07 03:42:17', '1', '2023-02-07', 88888),
(4055502, '1', 'R1', '2023-02-07 03:42:24', '1', '2023-02-07', 55555),
(4205576, '52', 'R1', '2023-02-07 03:43:26', '1', '2023-02-07', 55555),
(4514436, '52', 'R1', '2023-02-07 03:44:04', '1', '2023-02-07', 77777),
(4008931, '51', 'R1', '2023-02-07 05:03:53', '1', '2023-02-07', 55555),
(4575313, '51', 'R1', '2023-02-07 05:04:06', '1', '2023-02-07', 7878787),
(11585580, '51', 'R1', '2023-02-07 05:04:09', '1', '2023-02-07', 88888),
(11516474, '51', 'R1', '2023-02-07 05:04:47', '1', '2023-02-07', 88888),
(4123986, '51', 'R1', '2023-02-07 05:04:49', '1', '2023-02-07', 77777),
(11516474, '51', 'R1', '2023-02-07 05:04:59', '1', '2023-02-07', 88888);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_kidung`
--

CREATE TABLE `tb_kidung` (
  `nip` varchar(10) NOT NULL,
  `btach` text NOT NULL,
  `week` text NOT NULL,
  `time` timestamp NOT NULL DEFAULT current_timestamp(),
  `H` int(1) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp(),
  `asisten` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_pameran`
--

CREATE TABLE `tb_pameran` (
  `nip` varchar(10) NOT NULL,
  `batch` text NOT NULL,
  `week` text NOT NULL,
  `time` timestamp NOT NULL DEFAULT current_timestamp(),
  `E` int(11) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp(),
  `asisten` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_semester`
--

CREATE TABLE `tb_semester` (
  `thn_semester` int(11) NOT NULL,
  `keterangan` varchar(50) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp(),
  `status` enum('Aktif','Tidak Aktif') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_semester`
--

INSERT INTO `tb_semester` (`thn_semester`, `keterangan`, `date`, `status`) VALUES
(20222, 'Semester 2', '2023-01-24', 'Aktif'),
(20231, 'Semester 1 ', '2023-01-24', 'Aktif');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_ts`
--

CREATE TABLE `tb_ts` (
  `nip` varchar(10) NOT NULL,
  `batch` text NOT NULL,
  `week` text NOT NULL,
  `time` timestamp NOT NULL DEFAULT current_timestamp(),
  `TS` int(1) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp(),
  `asisten` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_ts`
--

INSERT INTO `tb_ts` (`nip`, `batch`, `week`, `time`, `TS`, `date`, `asisten`) VALUES
('0011514203', '51', 'R1', '2023-02-07 03:34:59', 1, '2023-02-07', 88888),
('0004123857', '51', 'R1', '2023-02-07 03:35:04', 1, '2023-02-07', 77777),
('0004391440', '51', 'R1', '2023-02-07 03:36:00', 1, '2023-02-07', 7878787),
('0004303272', '51', 'R1', '2023-02-07 03:36:27', 1, '2023-02-07', 55555),
('0004515081', '52', 'R1', '2023-02-07 05:04:03', 1, '2023-02-07', 55555),
('0011585580', '51', 'R1', '2023-02-07 05:04:24', 1, '2023-02-07', 88888),
('0011516474', '51', 'R1', '2023-02-07 05:04:36', 1, '2023-02-07', 88888),
('0004205576', '52', 'R1', '2023-02-07 05:07:49', 1, '2023-02-07', 55555);

-- --------------------------------------------------------

--
-- Struktur dari tabel `trainer`
--

CREATE TABLE `trainer` (
  `id_trainer` int(3) NOT NULL,
  `nama_trainer` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `trainer`
--

INSERT INTO `trainer` (`id_trainer`, `nama_trainer`) VALUES
(1, 'Br.Sandi'),
(2, 'Br. Paul Hon'),
(3, 'Br. Paul Aik'),
(4, 'Br. Timothy Feng'),
(5, 'Br. Samuel'),
(6, 'Bro. Radiva'),
(7, 'Bro Ceng Hin'),
(8, 'Bro Ali W'),
(9, 'Bro Ronal'),
(10, 'Bro Peter T'),
(11, 'Bro Estu');

-- --------------------------------------------------------

--
-- Struktur dari tabel `traines`
--

CREATE TABLE `traines` (
  `nip` int(10) NOT NULL,
  `name` varchar(50) NOT NULL,
  `foto` text DEFAULT NULL,
  `angkatan` int(2) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp(),
  `gender` enum('P','L') NOT NULL,
  `qrcode` text DEFAULT NULL,
  `semester` int(11) NOT NULL,
  `Asisten` varchar(255) NOT NULL,
  `idt` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `traines`
--

INSERT INTO `traines` (`nip`, `name`, `foto`, `angkatan`, `date`, `gender`, `qrcode`, `semester`, `Asisten`, `idt`) VALUES
(4393863, 'JERRI CHRISTIAN', NULL, 51, '2023-02-01', 'L', NULL, 20222, '88888', 1),
(4843419, 'LEONARDUS', NULL, 52, '2023-02-01', 'L', NULL, 20231, '77777', 2),
(11521203, 'NAFTALI GAFUR', NULL, 51, '2023-02-01', 'L', NULL, 20222, '88888', 3),
(4515081, 'Filia Delphia T. Setia Budi', NULL, 52, '2023-02-01', 'P', NULL, 20231, '55555', 4),
(11585580, 'Pavel Paulus Polin', NULL, 51, '2023-02-01', 'L', NULL, 20222, '88888', 5),
(11516474, 'Wisnu Mahendra', NULL, 51, '2023-02-01', 'L', NULL, 20222, '88888', 6),
(4123986, 'Yohanes', NULL, 51, '2023-02-01', 'L', NULL, 20222, '77777', 7),
(4123857, 'Yosef Loe', NULL, 51, '2023-02-01', 'L', NULL, 20222, '77777', 8),
(4515170, 'Kenzo Johanis Andreas Mongdong', NULL, 52, '2023-02-05', 'L', NULL, 20231, '77777', 9),
(4514436, 'Johannes Titus Marariha', NULL, 52, '2023-02-05', 'L', NULL, 20231, '77777', 10),
(4575832, 'Jimmy Hermanto', NULL, 52, '2023-02-05', 'L', NULL, 20231, '77777', 11),
(4124067, 'Ayesha Chandra', NULL, 51, '2023-02-05', 'P', NULL, 20222, '7878787', 12),
(4397464, 'Bintang Sinambela', NULL, 51, '2023-02-05', 'P', NULL, 20222, '7878787', 13),
(4570447, 'Devy S', NULL, 51, '2023-02-05', 'P', NULL, 20222, '7878787', 14),
(4303272, 'Eden Kesia', NULL, 51, '2023-02-05', 'P', NULL, 20222, '55555', 15),
(4008890, 'Efliani Enga Lika', NULL, 51, '2023-02-05', 'P', NULL, 20222, '55555', 16),
(4056244, 'Endang Putri', NULL, 51, '2023-02-05', 'P', NULL, 20222, '55555', 17),
(4332819, 'Ester Dian S', NULL, 51, '2023-02-05', 'P', NULL, 20222, '7878787', 18),
(4013125, 'EUODIA RISSEN', NULL, 1, '2023-02-05', 'P', NULL, 20222, '55555', 19),
(4008931, 'Eunike Frentelina', NULL, 51, '2023-02-05', 'P', NULL, 20222, '55555', 20),
(4595804, 'Kabzeel Rehuel', NULL, 51, '2023-02-05', 'P', NULL, 20222, '7878787', 21),
(4577754, 'Linsiawati', NULL, 51, '2023-02-05', 'P', NULL, 20222, '55555', 22),
(4575313, 'Meldina Octoria', NULL, 51, '2023-02-05', 'P', NULL, 20222, '7878787', 23),
(4013188, 'Mellynea Kezyta', NULL, 51, '2023-02-05', 'P', NULL, 20222, '55555', 24),
(4391440, 'Tamariska Victoria', NULL, 51, '2023-02-05', 'P', NULL, 20222, '7878787', 25),
(4320474, 'Veby Purnamagita', NULL, 51, '2023-02-05', 'P', NULL, 20222, '7878787', 26),
(4055502, 'Yustanti Elfrida', NULL, 1, '2023-02-05', 'P', NULL, 20222, '55555', 27),
(4102260, 'Jessica Pebertiga Br. Ginting', NULL, 52, '2023-02-05', 'P', NULL, 20231, '7878787', 28),
(4205576, 'Jessica', NULL, 52, '2023-02-06', 'P', NULL, 20231, '55555', 29),
(4124921, 'Sri Marinda Tarigan', NULL, 52, '2023-02-06', 'P', NULL, 20231, '7878787', 30),
(4266335, 'Steffanie Gabrielle', NULL, 52, '2023-02-06', 'P', NULL, 20231, '55555', 31),
(11514203, 'Leonardo Pandapotan', NULL, 51, '2023-02-06', 'L', NULL, 20222, '88888', 32),
(4525896, 'Wilsa Lilihata', NULL, 52, '2023-02-06', 'P', NULL, 20231, '7878787', 33),
(4844627, 'Samuel Michael Liem', NULL, 52, '2023-02-06', 'L', NULL, 20222, '88888', 34),
(4843525, 'Kevyn John Lobo', NULL, 52, '2023-02-06', 'L', NULL, 20231, '88888', 35),
(4512807, 'Hartato Wahyudi', NULL, 52, '2023-02-06', 'L', NULL, 20231, '88888', 36),
(4397311, 'Dani Samuel Budiawan', NULL, 52, '2023-02-06', 'L', NULL, 20222, '77777', 37),
(7561448, 'Dimas Bayu Nugroho', NULL, 52, '2023-02-06', 'L', NULL, 20231, '88888', 38),
(4351299, 'Gamaliel Akita', NULL, 52, '2023-02-06', 'L', NULL, 20222, '88888', 39),
(507841, 'Musa Nahor Kartiba', NULL, 52, '2023-02-06', 'L', NULL, 20231, '88888', 40),
(11295475, 'Alex Pintor Duge', NULL, 51, '2023-02-06', 'L', NULL, 20222, '77777', 41),
(4595588, 'Haider Yonis', NULL, 52, '2023-02-06', 'L', NULL, 20222, '77777', 42),
(367972, 'Axel Christopher Nathaniel', NULL, 51, '2023-02-06', 'L', NULL, 20222, '77777', 43),
(4311752, 'Baka Pranatha Ginting', NULL, 51, '2023-02-06', 'L', NULL, 20222, '77777', 44),
(4514281, 'Farni Elisabeth Leba', NULL, 52, '2023-02-06', 'P', NULL, 20222, '55555', 45),
(4148324, 'Firman Maolana', NULL, 51, '2023-02-06', 'L', NULL, 20222, '77777', 46),
(11251227, 'Irwan Welki', NULL, 51, '2023-02-06', 'L', NULL, 20222, '88888', 47);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `activity`
--
ALTER TABLE `activity`
  ADD PRIMARY KEY (`id_activity`);

--
-- Indeks untuk tabel `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `asisten`
--
ALTER TABLE `asisten`
  ADD PRIMARY KEY (`id_as`);

--
-- Indeks untuk tabel `presensi`
--
ALTER TABLE `presensi`
  ADD PRIMARY KEY (`nip`,`id_activity`,`schedule_id`);

--
-- Indeks untuk tabel `ringtones`
--
ALTER TABLE `ringtones`
  ADD PRIMARY KEY (`id_alarm`);

--
-- Indeks untuk tabel `schedule`
--
ALTER TABLE `schedule`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_angkatan`
--
ALTER TABLE `tb_angkatan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_daftar_berita`
--
ALTER TABLE `tb_daftar_berita`
  ADD PRIMARY KEY (`id_berita`);

--
-- Indeks untuk tabel `tb_doa`
--
ALTER TABLE `tb_doa`
  ADD PRIMARY KEY (`time`);

--
-- Indeks untuk tabel `tb_kidung`
--
ALTER TABLE `tb_kidung`
  ADD PRIMARY KEY (`time`);

--
-- Indeks untuk tabel `tb_pameran`
--
ALTER TABLE `tb_pameran`
  ADD PRIMARY KEY (`time`);

--
-- Indeks untuk tabel `tb_semester`
--
ALTER TABLE `tb_semester`
  ADD PRIMARY KEY (`thn_semester`);

--
-- Indeks untuk tabel `tb_ts`
--
ALTER TABLE `tb_ts`
  ADD PRIMARY KEY (`time`);

--
-- Indeks untuk tabel `trainer`
--
ALTER TABLE `trainer`
  ADD PRIMARY KEY (`id_trainer`);

--
-- Indeks untuk tabel `traines`
--
ALTER TABLE `traines`
  ADD PRIMARY KEY (`idt`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `asisten`
--
ALTER TABLE `asisten`
  MODIFY `id_as` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `schedule`
--
ALTER TABLE `schedule`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `traines`
--
ALTER TABLE `traines`
  MODIFY `idt` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
