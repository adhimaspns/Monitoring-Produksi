-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 23 Mar 2021 pada 18.41
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
(17, 'Tanah Liat ', '2021-03-19', 1, 'Pick Up', 200000, 'bahan baku'),
(18, 'Kayu', '2021-03-19', 1, 'Ikat ', 15000, 'bahan baku'),
(19, 'Kawul', '2021-03-19', 1, 'Tosa ', 75000, 'bahan baku'),
(20, 'Selep Tanah Liat', '2021-03-19', 1, 'Orang', 100000, 'bahan jadi'),
(21, 'Jasa Citak Kendil', '2021-03-19', 1, 'Pcs Kendil', 250, 'bahan jadi'),
(22, 'Jasa Ngeramut Kendil', '2021-03-19', 1, 'Pcs Kendil', 250, 'bahan jadi'),
(23, 'Ongkos Bakar Kendil', '2021-03-19', 1, 'Pcs Kendil', 300, 'bahan jadi'),
(24, 'Ongkos Bakar Cowek ', '2021-03-19', 1, 'Pcs Cowek', 150, 'bahan jadi'),
(25, 'Konsumsi', '2021-03-19', 1, 'Orang', 50000, 'bahan jadi');

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
(10, 'Cowek', 0, 'Pcs', 1000, 1835, '93'),
(11, 'Kendil', 0, 'Pcs', 1000, 4129, '94'),
(12, 'Cowek', 900, 'Pcs', 1500, 2185, '95');

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
(82, 93, 17, 1, 200000),
(83, 93, 18, 4, 60000),
(84, 93, 19, 1, 75000),
(85, 93, 20, 2, 200000),
(86, 93, 24, 1000, 150000),
(87, 93, 25, 3, 150000),
(89, 94, 18, 4, 60000),
(90, 94, 19, 1, 75000),
(91, 94, 20, 2, 200000),
(92, 94, 21, 380, 95000),
(93, 94, 22, 380, 95000),
(94, 94, 23, 380, 114000),
(95, 94, 25, 3, 150000),
(96, 94, 17, 2, 400000),
(97, 95, 17, 1, 200000),
(98, 95, 18, 4, 60000),
(99, 95, 19, 1, 75000),
(100, 95, 20, 2, 200000),
(101, 95, 25, 3, 150000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_transaksi`
--

CREATE TABLE `detail_transaksi` (
  `id_detail_transaksi` int(11) NOT NULL,
  `tgl_transaksi` date NOT NULL,
  `nomor_tr` varchar(50) NOT NULL,
  `barang_id` varchar(20) NOT NULL,
  `qty` int(13) NOT NULL,
  `harga_item` int(20) NOT NULL,
  `untung_item_detail` int(20) NOT NULL,
  `sub_total` int(13) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `detail_transaksi`
--

INSERT INTO `detail_transaksi` (`id_detail_transaksi`, `tgl_transaksi`, `nomor_tr`, `barang_id`, `qty`, `harga_item`, `untung_item_detail`, `sub_total`) VALUES
(67, '2021-03-20', '202103200013', '10', 100, 1835, 100000, 183500),
(68, '2021-03-20', '202103200013', '11', 100, 4129, 100000, 412900),
(69, '2021-03-20', '202103200014', '10', 25, 1835, 25000, 45875),
(70, '2021-03-21', '202103210001', '10', 50, 1835, 50000, 91750),
(71, '2021-03-21', '202103210002', '10', 120, 1835, 120000, 220200),
(72, '2021-03-21', '202103210003', '10', 5, 1835, 5000, 9175),
(73, '2021-03-22', '202103220001', '12', 100, 2185, 150000, 218500);

-- --------------------------------------------------------

--
-- Struktur dari tabel `kasir`
--

CREATE TABLE `kasir` (
  `id_kasir` int(11) NOT NULL,
  `nomor_tr` varchar(50) NOT NULL,
  `barang_id` int(20) NOT NULL,
  `qty` int(20) NOT NULL,
  `harga_item` int(20) NOT NULL,
  `untung_item_kasir` int(20) NOT NULL,
  `sub_total_kasir` int(13) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `laporan_brg_keluar`
--

CREATE TABLE `laporan_brg_keluar` (
  `id_laporan` int(11) NOT NULL,
  `tgl_laporan` date NOT NULL,
  `nomor_transaksi` varchar(20) NOT NULL,
  `omzet` int(20) NOT NULL,
  `petugas_kasir` varchar(50) NOT NULL,
  `ket_laporan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `laporan_brg_keluar`
--

INSERT INTO `laporan_brg_keluar` (`id_laporan`, `tgl_laporan`, `nomor_transaksi`, `omzet`, `petugas_kasir`, `ket_laporan`) VALUES
(6, '2021-03-20', '202103200013', 596400, 'Adhimas Pns', 'Beli Cowek 100'),
(7, '2021-03-20', '202103200014', 45875, 'Adhimas Pns', 'Beli Kendil 25'),
(8, '2021-03-21', '202103210001', 91750, 'Adhimas Pns', 'Beli Cowek'),
(9, '2021-03-21', '202103210002', 220200, 'Adhimas Pns', 'Beli Cowek'),
(10, '2021-03-21', '202103210003', 9175, 'Adhimas Pns', 'Beli Cowek'),
(11, '2021-03-22', '202103220001', 218500, 'Adhimas ', 'Beli Cowek');

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
(93, 'Cowek', 1000, 'Pcs', 1000, 1835, '2021-03-19'),
(94, 'Kendil', 380, 'Pcs', 1000, 4129, '2021-03-19'),
(95, 'Cowek', 1000, 'Pcs', 1500, 2185, '2021-03-22');

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
(24, '202103200013', 'Saji', 'Beli Cowek 100', 'Adhimas Pns'),
(25, '202103200014', 'Bambang Tri', 'Beli Kendil 25', 'Adhimas Pns'),
(26, '202103210001', 'Putra', 'Beli Cowek', 'Adhimas Pns'),
(27, '202103210002', 'Bambang Hadi Prayitno', 'Beli Cowek', 'Adhimas Pns'),
(28, '202103210003', 'Tri Wahyu', 'Beli Cowek', 'Adhimas Pns'),
(29, '202103220001', 'Galoh', 'Beli Cowek', 'Adhimas ');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `username` text NOT NULL,
  `password` text NOT NULL,
  `level` varchar(10) NOT NULL
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
-- Indeks untuk tabel `laporan_brg_keluar`
--
ALTER TABLE `laporan_brg_keluar`
  ADD PRIMARY KEY (`id_laporan`);

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
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `bahan`
--
ALTER TABLE `bahan`
  MODIFY `id_bahan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT untuk tabel `barang`
--
ALTER TABLE `barang`
  MODIFY `id_barang` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `detail_produksi`
--
ALTER TABLE `detail_produksi`
  MODIFY `id_detail_produksi` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=102;

--
-- AUTO_INCREMENT untuk tabel `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
  MODIFY `id_detail_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- AUTO_INCREMENT untuk tabel `kasir`
--
ALTER TABLE `kasir`
  MODIFY `id_kasir` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

--
-- AUTO_INCREMENT untuk tabel `laporan_brg_keluar`
--
ALTER TABLE `laporan_brg_keluar`
  MODIFY `id_laporan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `produksi`
--
ALTER TABLE `produksi`
  MODIFY `id_produksi` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=96;

--
-- AUTO_INCREMENT untuk tabel `temp`
--
ALTER TABLE `temp`
  MODIFY `id_temp` int(13) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=192;

--
-- AUTO_INCREMENT untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id_tbl_transaksi` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
