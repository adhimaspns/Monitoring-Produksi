-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 16 Mar 2021 pada 03.07
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
-- Struktur dari tabel `barang`
--

CREATE TABLE `barang` (
  `id_barang` int(20) NOT NULL,
  `nama_barang` varchar(100) NOT NULL,
  `stok_barang` int(200) NOT NULL,
  `satuan_stok_barang` varchar(100) NOT NULL,
  `untung_barang` int(100) NOT NULL,
  `harga_jual_item` int(20) NOT NULL,
  `produksi_id` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `barang`
--

INSERT INTO `barang` (`id_barang`, `nama_barang`, `stok_barang`, `satuan_stok_barang`, `untung_barang`, `harga_jual_item`, `produksi_id`) VALUES
(2, 'Kendil (tanggung)', 380, 'Pcs', 750, 2800, '86'),
(3, 'Cowek ', 1000, 'Pcs', 750, 1275, '87'),
(7, 'Layah Bolong', 1500, 'Pcs', 750, 1107, '90'),
(9, 'Kren', 500, 'Pcs', 850, 850, '92');

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
(55, 86, 7, 2, 100100000),
(57, 86, 12, 380, 95000),
(58, 86, 13, 380, 95000),
(59, 86, 14, 380, 114000),
(60, 86, 11, 1, 75000),
(61, 86, 1, 1, 200000),
(62, 87, 1, 1, 200000),
(63, 87, 11, 1, 75000),
(64, 87, 7, 2, 100100000),
(65, 87, 10, 1, 50000),
(73, 90, 11, 1, 75000),
(74, 90, 7, 2, 100100000),
(77, 90, 1, 1, 200000),
(78, 90, 2, 4, 60000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_transaksi`
--

CREATE TABLE `detail_transaksi` (
  `id_detail_transaksi` int(11) NOT NULL,
  `nomor_tr` varchar(50) NOT NULL,
  `barang_id` varchar(20) NOT NULL,
  `qty` int(13) NOT NULL,
  `sub_total` int(13) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `kasir`
--

CREATE TABLE `kasir` (
  `id_kasir` int(11) NOT NULL,
  `nomor_tr` varchar(50) NOT NULL,
  `barang_id` int(20) NOT NULL,
  `qty` int(20) NOT NULL,
  `sub_total_kasir` int(13) NOT NULL
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
  `harga_jual` int(20) NOT NULL,
  `tgl_produksi` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `produksi`
--

INSERT INTO `produksi` (`id_produksi`, `nama_produk`, `stok_produk`, `satuan_stok_produk`, `untung_produk`, `harga_jual`, `tgl_produksi`) VALUES
(86, 'Kendil (tanggung)', 380, 'Pcs', 750, 2800, '2021-03-10'),
(87, 'Cowek ', 1000, 'Pcs', 750, 1275, '2021-03-10'),
(90, 'Layah Bolong', 1500, 'Pcs', 750, 1107, '2021-03-16'),
(92, 'Kren', 500, 'Pcs', 850, 850, '2021-03-16');

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

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi`
--

CREATE TABLE `transaksi` (
  `id_tbl_transaksi` int(100) NOT NULL,
  `no_transaksi` varchar(40) NOT NULL,
  `nama_pembeli` varchar(100) NOT NULL,
  `keterangan` text DEFAULT NULL,
  `nama_kasir` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `transaksi`
--

INSERT INTO `transaksi` (`id_tbl_transaksi`, `no_transaksi`, `nama_pembeli`, `keterangan`, `nama_kasir`) VALUES
(7, '202103140001', 'Bambang Setyo Nur Cahyo', 'anjay ini keterangan lho ', 'Adhimas P');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `bahan`
--
ALTER TABLE `bahan`
  ADD PRIMARY KEY (`id_bahan`);

--
-- Indeks untuk tabel `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id_barang`);

--
-- Indeks untuk tabel `detail_produksi`
--
ALTER TABLE `detail_produksi`
  ADD PRIMARY KEY (`id_detail_produksi`);

--
-- Indeks untuk tabel `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
  ADD PRIMARY KEY (`id_detail_transaksi`);

--
-- Indeks untuk tabel `kasir`
--
ALTER TABLE `kasir`
  ADD PRIMARY KEY (`id_kasir`);

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
-- Indeks untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_tbl_transaksi`),
  ADD UNIQUE KEY `no_transaksi` (`no_transaksi`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `bahan`
--
ALTER TABLE `bahan`
  MODIFY `id_bahan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT untuk tabel `barang`
--
ALTER TABLE `barang`
  MODIFY `id_barang` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `detail_produksi`
--
ALTER TABLE `detail_produksi`
  MODIFY `id_detail_produksi` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- AUTO_INCREMENT untuk tabel `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
  MODIFY `id_detail_transaksi` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `kasir`
--
ALTER TABLE `kasir`
  MODIFY `id_kasir` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `produksi`
--
ALTER TABLE `produksi`
  MODIFY `id_produksi` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=93;

--
-- AUTO_INCREMENT untuk tabel `temp`
--
ALTER TABLE `temp`
  MODIFY `id_temp` int(13) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=173;

--
-- AUTO_INCREMENT untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id_tbl_transaksi` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
