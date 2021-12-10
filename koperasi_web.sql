-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 10 Des 2021 pada 12.33
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
('Bud12345', 'Budi Sudarsono', 'Laki-laki', 'Sekaran', '2'),
('Dev12345', 'Devira Norma Sari', 'Perempuan', 'Gunungpati', '1');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jaminan`
--

CREATE TABLE `jaminan` (
  `kode_jaminan` varchar(10) NOT NULL,
  `jenis_jaminan` varchar(25) NOT NULL,
  `no_pemilik` varchar(25) NOT NULL,
  `alamat` varchar(25) NOT NULL,
  `kode_pinjaman` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `menyimpan`
--

CREATE TABLE `menyimpan` (
  `id_anggota` varchar(10) NOT NULL,
  `kode_simpanan` varchar(10) NOT NULL,
  `tahun` date NOT NULL,
  `jumlah` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `menyimpan`
--

INSERT INTO `menyimpan` (`id_anggota`, `kode_simpanan`, `tahun`, `jumlah`) VALUES
('Bud12345', '001', '0000-00-00', 200000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pelunasan`
--

CREATE TABLE `pelunasan` (
  `no_pelunasan` varchar(10) NOT NULL,
  `id_anggota` varchar(10) NOT NULL,
  `kode_jaminan` varchar(10) NOT NULL,
  `jumlah_pelunasan` int(15) NOT NULL,
  `tgl_pelunasan` date NOT NULL,
  `status` char(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `penarikan`
--

CREATE TABLE `penarikan` (
  `kode_penarikan` varchar(10) NOT NULL,
  `no_transaksi` varchar(10) NOT NULL,
  `jml_penarikan` int(15) NOT NULL,
  `jml_saldo` int(15) NOT NULL,
  `kode_simpanan` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `petugas`
--

CREATE TABLE `petugas` (
  `id_petugas` varchar(10) NOT NULL,
  `nama` varchar(25) NOT NULL,
  `jenis_kelamin` varchar(25) NOT NULL,
  `bagian` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  `no_angsuran` int(5) NOT NULL,
  `id_anggota` varchar(10) NOT NULL,
  `id_petugas` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
-- Indeks untuk tabel `jaminan`
--
ALTER TABLE `jaminan`
  ADD PRIMARY KEY (`kode_jaminan`),
  ADD UNIQUE KEY `kode_pinjaman` (`kode_pinjaman`);

--
-- Indeks untuk tabel `menyimpan`
--
ALTER TABLE `menyimpan`
  ADD KEY `id_anggota` (`id_anggota`),
  ADD KEY `kode_simpanan` (`kode_simpanan`);

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
  ADD UNIQUE KEY `kode_simpanan` (`kode_simpanan`);

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
  ADD UNIQUE KEY `no_angsuran` (`no_angsuran`),
  ADD UNIQUE KEY `id_anggota` (`id_anggota`),
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
-- Ketidakleluasaan untuk tabel `jaminan`
--
ALTER TABLE `jaminan`
  ADD CONSTRAINT `jaminan_ibfk_1` FOREIGN KEY (`kode_pinjaman`) REFERENCES `pinjaman` (`kode_pinjaman`);

--
-- Ketidakleluasaan untuk tabel `menyimpan`
--
ALTER TABLE `menyimpan`
  ADD CONSTRAINT `menyimpan_ibfk_1` FOREIGN KEY (`id_anggota`) REFERENCES `anggota` (`id_anggota`),
  ADD CONSTRAINT `menyimpan_ibfk_2` FOREIGN KEY (`kode_simpanan`) REFERENCES `simpanan` (`kode_simpanan`);

--
-- Ketidakleluasaan untuk tabel `pelunasan`
--
ALTER TABLE `pelunasan`
  ADD CONSTRAINT `pelunasan_ibfk_1` FOREIGN KEY (`id_anggota`) REFERENCES `anggota` (`id_anggota`),
  ADD CONSTRAINT `pelunasan_ibfk_2` FOREIGN KEY (`kode_jaminan`) REFERENCES `jaminan` (`kode_jaminan`);

--
-- Ketidakleluasaan untuk tabel `penarikan`
--
ALTER TABLE `penarikan`
  ADD CONSTRAINT `penarikan_ibfk_1` FOREIGN KEY (`kode_simpanan`) REFERENCES `simpanan` (`kode_simpanan`);

--
-- Ketidakleluasaan untuk tabel `pinjaman`
--
ALTER TABLE `pinjaman`
  ADD CONSTRAINT `pinjaman_ibfk_1` FOREIGN KEY (`id_anggota`) REFERENCES `anggota` (`id_anggota`),
  ADD CONSTRAINT `pinjaman_ibfk_2` FOREIGN KEY (`id_petugas`) REFERENCES `petugas` (`id_petugas`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
