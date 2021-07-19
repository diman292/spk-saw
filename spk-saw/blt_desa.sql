-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 21 Jun 2021 pada 09.32
-- Versi server: 10.4.8-MariaDB
-- Versi PHP: 7.1.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `blt_desa`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `alternatif`
--

CREATE TABLE `alternatif` (
  `id_alternatif` int(10) NOT NULL,
  `nama_alternatif` varchar(25) NOT NULL,
  `alamat` text NOT NULL,
  `tanggal_input` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `alternatif`
--

INSERT INTO `alternatif` (`id_alternatif`, `nama_alternatif`, `alamat`, `tanggal_input`) VALUES
(222232, 'Sodrih', 'Kp. sana sini', '2021-06-14'),
(222233, 'Ucok', 'Kp. sana sini', '2021-06-15'),
(222234, 'Udin', 'sd', '2021-06-14'),
(222235, 'Bambang', 'Kp. sana sini', '2021-06-15'),
(222236, 'Fikri', 'Kp. sana sini', '2021-06-15'),
(222237, 'Biqi', 'Kp. sana sini', '2021-06-15'),
(222238, 'komar', 'Kp. sana sini', '2021-06-15'),
(222239, 'Adi', 'Kp. Mana Aja boleh', '2021-06-15'),
(222240, 'Sueb', 'Kp. Apa', '2021-06-15'),
(222241, 'Hala', 'Kp. Sana Sini Oke', '2021-06-15'),
(222242, 'contoj', 'as', '2021-06-15');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kriteria`
--

CREATE TABLE `kriteria` (
  `id_kriteria` int(10) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `type` enum('benefit','cost') NOT NULL,
  `bobot` float NOT NULL,
  `ada_pilihan` tinyint(1) DEFAULT NULL,
  `urutan_order` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `kriteria`
--

INSERT INTO `kriteria` (`id_kriteria`, `nama`, `type`, `bobot`, `ada_pilihan`, `urutan_order`) VALUES
(40, 'Tingkat kesejahteraan', 'benefit', 0.4, 1, 1),
(42, 'Jenis Kelamin', 'benefit', 0.2, 1, 3),
(44, 'Pekerjaan', 'benefit', 0.2, 1, 4),
(46, 'Usia', 'benefit', 0.2, 1, 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `nilai_alternatif`
--

CREATE TABLE `nilai_alternatif` (
  `id_nilai_alternatif` int(11) NOT NULL,
  `id_alternatif` int(10) NOT NULL,
  `id_kriteria` int(10) NOT NULL,
  `nilai` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `nilai_alternatif`
--

INSERT INTO `nilai_alternatif` (`id_nilai_alternatif`, `id_alternatif`, `id_kriteria`, `nilai`) VALUES
(222332, 222232, 40, 5),
(222333, 222232, 42, 1),
(222335, 222232, 44, 3),
(222336, 222233, 40, 5),
(222337, 222233, 42, 3),
(222339, 222233, 44, 5),
(222340, 222234, 40, 5),
(222341, 222234, 42, 1),
(222343, 222234, 44, 5),
(222396, 222235, 40, 1),
(222397, 222235, 42, 3),
(222399, 222235, 44, 3),
(222400, 222236, 40, 3),
(222401, 222236, 42, 1),
(222403, 222236, 44, 3),
(222404, 222237, 40, 1),
(222405, 222237, 42, 3),
(222407, 222237, 44, 3),
(222408, 222238, 40, 3),
(222409, 222238, 42, 3),
(222411, 222238, 44, 1),
(222412, 222239, 40, 5),
(222413, 222239, 42, 1),
(222415, 222239, 44, 5),
(222416, 222240, 40, 5),
(222417, 222240, 42, 3),
(222419, 222240, 44, 5),
(222420, 222241, 40, 1),
(222421, 222241, 42, 1),
(222423, 222241, 44, 1),
(222429, 222232, 46, 2),
(222433, 222233, 46, 4),
(222437, 222234, 46, 5),
(222441, 222235, 46, 5),
(222445, 222236, 46, 3),
(222449, 222237, 46, 4),
(222453, 222238, 46, 2),
(222457, 222239, 46, 1),
(222461, 222240, 46, 5),
(222465, 222241, 46, 1),
(222476, 222242, 40, 1),
(222477, 222242, 46, 3),
(222478, 222242, 42, 3),
(222479, 222242, 44, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pilihan_kriteria`
--

CREATE TABLE `pilihan_kriteria` (
  `id_pil_kriteria` int(10) NOT NULL,
  `id_kriteria` int(10) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `nilai` float NOT NULL,
  `urutan_order` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pilihan_kriteria`
--

INSERT INTO `pilihan_kriteria` (`id_pil_kriteria`, `id_kriteria`, `nama`, `nilai`, `urutan_order`) VALUES
(49, 40, 'Rendah', 5, 1),
(50, 40, 'Menengah', 3, 2),
(52, 40, 'Tinggi', 1, 3),
(55, 42, 'Perempuan', 3, 2),
(56, 42, 'Laki-Laki', 1, 1),
(60, 44, 'karyawan', 1, 1),
(61, 44, 'Wirausaha / Pekerja Rentan', 3, 2),
(63, 44, 'Tidak Bekerja', 5, 3),
(64, 46, 'Dibawah 35 Tahun', 1, 1),
(65, 46, '36 - 45 Tahun', 2, 2),
(66, 46, '46 - 55 Tahun', 3, 3),
(67, 46, '56 - 65 Tahun', 4, 4),
(68, 46, 'DIatas 66 Tahun', 5, 5);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id_user` int(5) NOT NULL,
  `username` varchar(16) NOT NULL,
  `password` varchar(50) NOT NULL,
  `nama` varchar(70) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `alamat` varchar(100) DEFAULT NULL,
  `role` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`, `nama`, `email`, `alamat`, `role`) VALUES
(8, 'user', '12dea96fec20593566ab75692c9949596833adc9', 'user', 'user@gmail.com', 'user', '2'),
(10, 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'admin', 'admin@contoh.com', 'ererer', '1'),
(15, 'demo', '89e495e7941cf9e40e6980d14a16bf023ccd4c91', 'demo', 'demo@asa.com', 'demo', '2');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `alternatif`
--
ALTER TABLE `alternatif`
  ADD PRIMARY KEY (`id_alternatif`);

--
-- Indeks untuk tabel `kriteria`
--
ALTER TABLE `kriteria`
  ADD PRIMARY KEY (`id_kriteria`);

--
-- Indeks untuk tabel `nilai_alternatif`
--
ALTER TABLE `nilai_alternatif`
  ADD PRIMARY KEY (`id_nilai_alternatif`),
  ADD UNIQUE KEY `id_kambing_2` (`id_alternatif`,`id_kriteria`),
  ADD KEY `id_kambing` (`id_alternatif`),
  ADD KEY `id_kriteria` (`id_kriteria`);

--
-- Indeks untuk tabel `pilihan_kriteria`
--
ALTER TABLE `pilihan_kriteria`
  ADD PRIMARY KEY (`id_pil_kriteria`),
  ADD KEY `id_kriteria` (`id_kriteria`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `alternatif`
--
ALTER TABLE `alternatif`
  MODIFY `id_alternatif` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=222243;

--
-- AUTO_INCREMENT untuk tabel `kriteria`
--
ALTER TABLE `kriteria`
  MODIFY `id_kriteria` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT untuk tabel `nilai_alternatif`
--
ALTER TABLE `nilai_alternatif`
  MODIFY `id_nilai_alternatif` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=222480;

--
-- AUTO_INCREMENT untuk tabel `pilihan_kriteria`
--
ALTER TABLE `pilihan_kriteria`
  MODIFY `id_pil_kriteria` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `nilai_alternatif`
--
ALTER TABLE `nilai_alternatif`
  ADD CONSTRAINT `nilai_alternatif_ibfk_1` FOREIGN KEY (`id_alternatif`) REFERENCES `alternatif` (`id_alternatif`),
  ADD CONSTRAINT `nilai_alternatif_ibfk_2` FOREIGN KEY (`id_kriteria`) REFERENCES `kriteria` (`id_kriteria`);

--
-- Ketidakleluasaan untuk tabel `pilihan_kriteria`
--
ALTER TABLE `pilihan_kriteria`
  ADD CONSTRAINT `pilihan_kriteria_ibfk_1` FOREIGN KEY (`id_kriteria`) REFERENCES `kriteria` (`id_kriteria`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
