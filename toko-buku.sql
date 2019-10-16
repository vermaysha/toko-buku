-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: 16 Okt 2019 pada 22.09
-- Versi Server: 10.1.41-MariaDB-0ubuntu0.18.04.1
-- PHP Version: 7.3.10-1+ubuntu18.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `toko-buku`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `books`
--

CREATE TABLE `books` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `penerbit` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `pengarang` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `harga` int(10) UNSIGNED NOT NULL,
  `sinopsis` text COLLATE utf8_unicode_ci NOT NULL,
  `detail` text COLLATE utf8_unicode_ci NOT NULL,
  `photos` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `media`
--

CREATE TABLE `media` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `path` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `permalink` varchar(200) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `settings`
--

CREATE TABLE `settings` (
  `id` int(5) UNSIGNED NOT NULL,
  `setting_key` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `setting_val` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `autoload` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data untuk tabel `settings`
--

INSERT INTO `settings` (`id`, `setting_key`, `setting_val`, `autoload`) VALUES
(1, 'site_url', 'localhost/toko-buku/', 1),
(2, 'use_https', '0', 1),
(3, 'site_name', 'Garang Media', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `username` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(96) COLLATE utf8_unicode_ci NOT NULL,
  `level` set('admin','user') COLLATE utf8_unicode_ci NOT NULL,
  `last_login` datetime DEFAULT NULL,
  `remember_token` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `level`, `last_login`, `remember_token`) VALUES
(1, 'admin', '$argon2i$v=19$m=65536,t=4,p=1$OHlJOFY3MkFaaGxOU2suQQ$R8gQ9j10fAuLbGkJl6+wEqDWt7ycn+KnmlBYGo9aWo4', 'admin', '2019-10-16 20:01:55', NULL),
(7, 'fakeaccount', '$argon2i$v=19$m=65536,t=4,p=1$b2wvTFV4bGN3Q1ZRNGFWRg$xfSOFFSguWFUBxx0xokSquxL4JWZIbrjp4tx8+sfIkU', 'user', '2019-10-16 19:07:41', NULL),
(8, 'fakeaccount12', '$argon2i$v=19$m=65536,t=4,p=1$VUxmR01vSHc4OWFVSTlKSQ$DRWzfZ2CWf1w5UXsQv8T/UoUQekIhQ6bRfZ2hFmvMGY', 'user', '2019-10-16 19:10:42', NULL),
(9, 'fakeaccount12312', '$argon2i$v=19$m=65536,t=4,p=1$RTQvZG1SVE9vL25rVGJuRQ$XfJs0xMDD5u1LkYbBZNvdFeIfF8zkmx5kooAtCg628M', 'user', '2019-10-16 19:11:52', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users_meta`
--

CREATE TABLE `users_meta` (
  `id` int(10) UNSIGNED NOT NULL,
  `meta_key` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `meta_value` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `id_user` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data untuk tabel `users_meta`
--

INSERT INTO `users_meta` (`id`, `meta_key`, `meta_value`, `id_user`) VALUES
(1, 'fullname', 'Administrator', 1),
(2, 'fullname', 'INI AKUN PALSU', 7),
(3, 'asdsad', 'asda', 7),
(4, 'fullname', 'Ini AKun palsu', 8),
(5, 'fullname', 'Fake Account', 9);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `media`
--
ALTER TABLE `media`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_meta`
--
ALTER TABLE `users_meta`
  ADD PRIMARY KEY (`id`),
  ADD KEY `meta_key` (`meta_key`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `media`
--
ALTER TABLE `media`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `users_meta`
--
ALTER TABLE `users_meta`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
