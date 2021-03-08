-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 08 Mar 2021 pada 22.58
-- Versi server: 10.4.11-MariaDB
-- Versi PHP: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `monitoring_produksi`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `bahan`
--

CREATE TABLE `bahan` (
  `id_bahan` int(11) NOT NULL,
  `nama_bahan` varchar(100) NOT NULL,
  `tgl` date NOT NULL,
  `kuantitas` int(12) NOT NULL,
  `satuan` varchar(100) NOT NULL,
  `harga` int(11) NOT NULL,
  `kategori` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `bahan`
--

INSERT INTO `bahan` (`id_bahan`, `nama_bahan`, `tgl`, `kuantitas`, `satuan`, `harga`, `kategori`) VALUES
(1, 'Tanah Liat', '2021-02-17', 1, 'Pick Up', 200000, 'bahan baku'),
(2, 'Kayu Bakar', '2021-02-17', 1, 'Ikat', 15000, 'bahan baku'),
(4, 'Oker Warna Merah', '2021-02-17', 1, 'Plastik 1 Kiloan', 10000, 'bahan jadi'),
(7, 'Jasa Selep Tanah', '2021-02-22', 1, 'Orang', 100000, 'bahan jadi'),
(9, 'Solar', '2021-03-03', 1, 'Botol Aqua 1,5 Liter', 9000, 'bahan baku'),
(10, 'Konsumsi', '2021-03-03', 1, 'Orang', 50000, 'bahan jadi'),
(11, 'Kawul (jerami)', '2021-03-04', 1, 'Tosa', 75000, 'bahan baku'),
(12, 'Jasa Citak Kendil', '2021-03-07', 1, 'Pcs', 250, 'bahan jadi'),
(13, 'Jasa Ngelus Kendil', '2021-03-07', 1, 'Pcs', 250, 'bahan jadi'),
(14, 'Ongkos Bakar Kendil', '2021-03-07', 1, 'Pcs ', 300, 'bahan jadi');

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_produksi`
--

CREATE TABLE `detail_produksi` (
  `id_detail_produksi` int(12) NOT NULL,
  `produksi_id` int(12) NOT NULL,
  `bhn_id` int(12) NOT NULL,
  `qty` int(12) NOT NULL,
  `sub_total` int(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `detail_produksi`
--

INSERT INTO `detail_produksi` (`id_detail_produksi`, `produksi_id`, `bhn_id`, `qty`, `sub_total`) VALUES
(8, 82, 1, 1, 600000),
(9, 82, 2, 4, 60000),
(10, 82, 7, 2, 200000),
(30, 84, 12, 380, 95000),
(31, 84, 13, 380, 95000),
(32, 84, 14, 380, 114000),
(38, 84, 2, 4, 60000),
(39, 84, 11, 1, 75000),
(45, 84, 1, 1, 200000),
(46, 84, 7, 2, 200000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pra_produksi`
--

CREATE TABLE `pra_produksi` (
  `id_rencana_produksi` int(11) NOT NULL,
  `nama_produk` varchar(100) NOT NULL,
  `stok_pra_produksi` int(12) NOT NULL,
  `satuan_pra_produksi` varchar(100) NOT NULL,
  `untung_pra_produksi` int(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `produksi`
--

CREATE TABLE `produksi` (
  `id_produksi` int(12) NOT NULL,
  `nama_produk` varchar(100) NOT NULL,
  `stok_produk` int(12) NOT NULL,
  `satuan_stok_produk` varchar(100) NOT NULL,
  `untung_produk` int(12) NOT NULL,
  `tgl_produksi` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `produksi`
--

INSERT INTO `produksi` (`id_produksi`, `nama_produk`, `stok_produk`, `satuan_stok_produk`, `untung_produk`, `tgl_produksi`) VALUES
(82, 'Cowek', 1000, 'Pcs', 2000, '2021-03-03'),
(84, 'Kendil Tanggung', 380, 'Pcs', 2500, '2021-03-04');

-- --------------------------------------------------------

--
-- Struktur dari tabel `temp`
--

CREATE TABLE `temp` (
  `id_temp` int(13) NOT NULL,
  `produksi_id` int(11) NOT NULL,
  `bhn_id` varchar(100) NOT NULL,
  `qty` int(11) NOT NULL,
  `sub_total` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `bahan`
--
ALTER TABLE `bahan`
  ADD PRIMARY KEY (`id_bahan`);

--
-- Indeks untuk tabel `detail_produksi`
--
ALTER TABLE `detail_produksi`
  ADD PRIMARY KEY (`id_detail_produksi`);

--
-- Indeks untuk tabel `pra_produksi`
--
ALTER TABLE `pra_produksi`
  ADD PRIMARY KEY (`id_rencana_produksi`);

--
-- Indeks untuk tabel `produksi`
--
ALTER TABLE `produksi`
  ADD PRIMARY KEY (`id_produksi`);

--
-- Indeks untuk tabel `temp`
--
ALTER TABLE `temp`
  ADD PRIMARY KEY (`id_temp`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `bahan`
--
ALTER TABLE `bahan`
  MODIFY `id_bahan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT untuk tabel `detail_produksi`
--
ALTER TABLE `detail_produksi`
  MODIFY `id_detail_produksi` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT untuk tabel `pra_produksi`
--
ALTER TABLE `pra_produksi`
  MODIFY `id_rencana_produksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT untuk tabel `produksi`
--
ALTER TABLE `produksi`
  MODIFY `id_produksi` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

--
-- AUTO_INCREMENT untuk tabel `temp`
--
ALTER TABLE `temp`
  MODIFY `id_temp` int(13) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=142;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
