-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 11 Des 2021 pada 11.34
-- Versi server: 10.4.8-MariaDB
-- Versi PHP: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `koperasi_web`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `anggota`
--

CREATE TABLE `anggota` (
  `id_anggota` varchar(10) NOT NULL,
  `nama` varchar(25) NOT NULL,
  `jenis_kelamin` varchar(10) NOT NULL,
  `alamat` varchar(25) NOT NULL,
  `tanggungan` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `anggota`
--

INSERT INTO `anggota` (`id_anggota`, `nama`, `jenis_kelamin`, `alamat`, `tanggungan`) VALUES
('AGS12345', 'Agus Samsudin', 'Laki-Laki', 'Sidareja', '2'),
('And12345', 'Andi Cahyono', 'Laki-laki', 'Sidareja', '9'),
('Ben12345', 'Beni', 'Laki-Laki', 'Gunungpati', '3'),
('Dev12345', 'Devira Norma Sari', 'Perempuan', 'Gunungpati', '1');

-- --------------------------------------------------------

--
-- Struktur dari tabel `angsur`
--

CREATE TABLE `angsur` (
  `kode_pinjaman` varchar(10) NOT NULL,
  `id_anggota` varchar(10) NOT NULL,
  `id_petugas` varchar(10) NOT NULL,
  `tanggal_pembayaran` varchar(10) NOT NULL,
  `angsuran_ke` varchar(10) NOT NULL,
  `jumlah` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `angsur`
--

INSERT INTO `angsur` (`kode_pinjaman`, `id_anggota`, `id_petugas`, `tanggal_pembayaran`, `angsuran_ke`, `jumlah`) VALUES
('P1001', 'Dev12345', 'PAGU123', '2021-12-22', '0', 400000),
('P1001', 'Dev12345', 'PAGU123', '2021-12-22', '0', 400000),
('P1001', 'Dev12345', 'PAGU123', '2021-12-22', '0', 400000),
('P1002', 'AGS12345', 'PAGU123', '2021-12-30', '0', 200000),
('P1004', 'Ben12345', 'PAGU123', '2021-12-24', '4', 240000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `jaminan`
--

CREATE TABLE `jaminan` (
  `kode_jaminan` varchar(10) NOT NULL,
  `jenis_jaminan` varchar(25) NOT NULL,
  `no_pemilik` varchar(25) NOT NULL,
  `alamat` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `jaminan`
--

INSERT INTO `jaminan` (`kode_jaminan`, `jenis_jaminan`, `no_pemilik`, `alamat`) VALUES
('RMH-001', 'Rumah', '00020304450', 'Bumireja'),
('RMH78', 'Rumah', '1234509976', 'Gunungpati');

-- --------------------------------------------------------

--
-- Struktur dari tabel `menyimpan`
--

CREATE TABLE `menyimpan` (
  `id_anggota` varchar(10) NOT NULL,
  `kode_simpanan` varchar(10) NOT NULL,
  `tanggal` varchar(20) NOT NULL,
  `jumlah` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `menyimpan`
--

INSERT INTO `menyimpan` (`id_anggota`, `kode_simpanan`, `tanggal`, `jumlah`) VALUES
('Dev12345', '001', '10/12/2020', 1000000),
('Dev12345', '002', '10/12/2021', 2000000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pelunasan`
--

CREATE TABLE `pelunasan` (
  `no_pelunasan` varchar(10) NOT NULL,
  `id_anggota` varchar(10) NOT NULL,
  `kode_jaminan` varchar(10) NOT NULL,
  `jumlah_pelunasan` int(15) NOT NULL,
  `tgl_pelunasan` varchar(10) NOT NULL,
  `status` char(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pelunasan`
--

INSERT INTO `pelunasan` (`no_pelunasan`, `id_anggota`, `kode_jaminan`, `jumlah_pelunasan`, `tgl_pelunasan`, `status`) VALUES
('2131341334', 'Dev12345', 'RMH78', 8000000, '2021-12-31', 'Lunas');

-- --------------------------------------------------------

--
-- Struktur dari tabel `penarikan`
--

CREATE TABLE `penarikan` (
  `kode_penarikan` varchar(10) NOT NULL,
  `id_anggota` varchar(10) NOT NULL,
  `no_transaksi` varchar(10) NOT NULL,
  `jml_penarikan` int(15) NOT NULL,
  `kode_simpanan` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `petugas`
--

CREATE TABLE `petugas` (
  `id_petugas` varchar(10) NOT NULL,
  `nama_petugas` varchar(25) NOT NULL,
  `jenis_kelamin` varchar(25) NOT NULL,
  `bagian` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `petugas`
--

INSERT INTO `petugas` (`id_petugas`, `nama_petugas`, `jenis_kelamin`, `bagian`) VALUES
('PAGU123', 'Agung Surono', 'Laki-Laki', 'Teller'),
('PSAN123', 'Santoso Dwi', 'Laki-Laki', 'Kepala'),
('PSUS123', 'Susi Lestari', 'Perempuan', 'Teller');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pinjaman`
--

CREATE TABLE `pinjaman` (
  `kode_pinjaman` varchar(10) NOT NULL,
  `besar_pinjaman` int(15) NOT NULL,
  `lama_angsuran` int(5) NOT NULL,
  `bunga` float NOT NULL,
  `besar_angsuran` int(15) NOT NULL,
  `id_anggota` varchar(10) NOT NULL,
  `id_petugas` varchar(10) NOT NULL,
  `kode_jaminan` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pinjaman`
--

INSERT INTO `pinjaman` (`kode_pinjaman`, `besar_pinjaman`, `lama_angsuran`, `bunga`, `besar_angsuran`, `id_anggota`, `id_petugas`, `kode_jaminan`) VALUES
('P1001', 5000000, 36, 0.1, 140000, 'And12345', 'PSUS123', 'RMH-001'),
('P1002', 10000000, 36, 0.1, 288000, 'AGS12345', 'PSUS123', 'RMH012'),
('P1003', 8000000, 10, 0.1, 800000, 'Dev12345', 'PAGU123', 'RMH78'),
('P1004', 8000000, 10, 0.1, 800000, 'Ben12345', 'PAGU123', 'RMH67');

-- --------------------------------------------------------

--
-- Struktur dari tabel `simpanan`
--

CREATE TABLE `simpanan` (
  `kode_simpanan` varchar(10) NOT NULL,
  `nama_simpanan` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `simpanan`
--

INSERT INTO `simpanan` (`kode_simpanan`, `nama_simpanan`) VALUES
('001', 'simpanan pokok'),
('002', 'simpanan wajib'),
('003', 'simpanan bebas');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `anggota`
--
ALTER TABLE `anggota`
  ADD PRIMARY KEY (`id_anggota`);

--
-- Indeks untuk tabel `angsur`
--
ALTER TABLE `angsur`
  ADD KEY `kode_pinjaman` (`kode_pinjaman`),
  ADD KEY `id_petugas` (`id_petugas`),
  ADD KEY `id_anggota` (`id_anggota`);

--
-- Indeks untuk tabel `jaminan`
--
ALTER TABLE `jaminan`
  ADD PRIMARY KEY (`kode_jaminan`);

--
-- Indeks untuk tabel `menyimpan`
--
ALTER TABLE `menyimpan`
  ADD KEY `menyimpan_ibfk_1` (`id_anggota`),
  ADD KEY `menyimpan_ibfk_2` (`kode_simpanan`);

--
-- Indeks untuk tabel `pelunasan`
--
ALTER TABLE `pelunasan`
  ADD PRIMARY KEY (`no_pelunasan`),
  ADD UNIQUE KEY `id_anggota` (`id_anggota`),
  ADD UNIQUE KEY `kode_jaminan` (`kode_jaminan`);

--
-- Indeks untuk tabel `penarikan`
--
ALTER TABLE `penarikan`
  ADD PRIMARY KEY (`kode_penarikan`),
  ADD UNIQUE KEY `kode_simpanan` (`kode_simpanan`),
  ADD KEY `penarikan_ibfk_1` (`id_anggota`);

--
-- Indeks untuk tabel `petugas`
--
ALTER TABLE `petugas`
  ADD PRIMARY KEY (`id_petugas`);

--
-- Indeks untuk tabel `pinjaman`
--
ALTER TABLE `pinjaman`
  ADD PRIMARY KEY (`kode_pinjaman`),
  ADD UNIQUE KEY `id_anggota` (`id_anggota`),
  ADD UNIQUE KEY `kode_jaminan` (`kode_jaminan`),
  ADD KEY `pinjaman_ibfk_2` (`id_petugas`);

--
-- Indeks untuk tabel `simpanan`
--
ALTER TABLE `simpanan`
  ADD PRIMARY KEY (`kode_simpanan`);

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `angsur`
--
ALTER TABLE `angsur`
  ADD CONSTRAINT `angsur_ibfk_1` FOREIGN KEY (`kode_pinjaman`) REFERENCES `pinjaman` (`kode_pinjaman`),
  ADD CONSTRAINT `angsur_ibfk_2` FOREIGN KEY (`id_petugas`) REFERENCES `petugas` (`id_petugas`),
  ADD CONSTRAINT `angsur_ibfk_3` FOREIGN KEY (`id_anggota`) REFERENCES `anggota` (`id_anggota`);

--
-- Ketidakleluasaan untuk tabel `jaminan`
--
ALTER TABLE `jaminan`
  ADD CONSTRAINT `jaminan_ibfk_1` FOREIGN KEY (`kode_jaminan`) REFERENCES `pinjaman` (`kode_jaminan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `menyimpan`
--
ALTER TABLE `menyimpan`
  ADD CONSTRAINT `menyimpan_ibfk_1` FOREIGN KEY (`id_anggota`) REFERENCES `anggota` (`id_anggota`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `menyimpan_ibfk_2` FOREIGN KEY (`kode_simpanan`) REFERENCES `simpanan` (`kode_simpanan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `pelunasan`
--
ALTER TABLE `pelunasan`
  ADD CONSTRAINT `pelunasan_ibfk_1` FOREIGN KEY (`id_anggota`) REFERENCES `anggota` (`id_anggota`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pelunasan_ibfk_2` FOREIGN KEY (`kode_jaminan`) REFERENCES `jaminan` (`kode_jaminan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `penarikan`
--
ALTER TABLE `penarikan`
  ADD CONSTRAINT `penarikan_ibfk_1` FOREIGN KEY (`id_anggota`) REFERENCES `menyimpan` (`id_anggota`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `penarikan_ibfk_2` FOREIGN KEY (`kode_simpanan`) REFERENCES `menyimpan` (`kode_simpanan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `pinjaman`
--
ALTER TABLE `pinjaman`
  ADD CONSTRAINT `pinjaman_ibfk_1` FOREIGN KEY (`id_anggota`) REFERENCES `anggota` (`id_anggota`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pinjaman_ibfk_2` FOREIGN KEY (`id_petugas`) REFERENCES `petugas` (`id_petugas`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
