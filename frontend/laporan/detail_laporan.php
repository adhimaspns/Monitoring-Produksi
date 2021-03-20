<!DOCTYPE html>
<html lang="pt-BR">
	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<title>Monitoring Biaya Produksi | Beranda</title>

		<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>

		<link
			rel="stylesheet"
			href="https://cdn.materialdesignicons.com/4.9.95/css/materialdesignicons.min.css"
		/>
		<link
			rel="stylesheet"
			href="https://fonts.googleapis.com/css?family=Roboto&display=swap"
		/>
		<link rel="stylesheet" href="../../assets/css/main.css" />
		<link rel="stylesheet" href="../../assets/css/style.css" />
		<link rel="stylesheet" href="../../assets/css/sidebar.css" />
	</head>
	<body>
	<?php
		include '../../database/koneksi.php';
		include '../../frontend/layout/sidebar.php';
	?>
		<main class="main">
			<section>
				<h2>Monitoring Biaya Produksi</h2>
				<h3>Laporan Barang Keluar</h3>
				<div class="breadcrumb">
          <h3>
						<a href="../../beranda.php?page=beranda">Beranda</a> <i class="fa fa-angle-right"></i>
						<a href="index.php?page=laporan">Data Laporan Barang Keluar</a> <i class="fa fa-angle-right"></i>
						<span class="akhir-link-breadcrumb">Detail Laporan Barang Keluar</span>
					</h3>
				</div>

				<div class="container margin-bottom-100">
					<div class="baris">
            <div class="kolom-50-kiri">
              <div class="box-konten">
                <center>
                  <div class="box-header-radius-80 background-biru teks-putih margin-bottom-50">
                    <h3>Data Transaksi</h3>
                  </div>
                </center>

                <?php

                  $Tr                    = $_GET['Tr'];
                  $sqlSelectTransaksi    = "SELECT * FROM transaksi WHERE no_transaksi = '$Tr' ";
                  $querySelectTransaksi  = mysqli_query($host, $sqlSelectTransaksi);
                  $DetailTransaksi       = mysqli_fetch_assoc($querySelectTransaksi);

                ?>
                <form>
                  <label>Nama Pembeli</label>
                  <input type="text" class="form" value="<?= $DetailTransaksi['nama_pembeli'] ?>" readonly>

                  <label>Nomor Transaksi</label>
                  <input type="text" class="form" value="<?= $DetailTransaksi['no_transaksi'] ?>" readonly>

                  <label>Keterangan Transaksi</label>
                  <label>Keterangan</label>
                  <textarea class="form textarea-no-resize" rows="5" readonly><?= $DetailTransaksi['keterangan'] ?></textarea>

                  <label>Petugas Kasir</label>
                  <input type="text" class="form" value="<?= $DetailTransaksi['nama_kasir'] ?>" readonly>
                </form>
              </div>
            </div>
            <div class="kolom-50-kanan">
              <div class="box-konten-radius backgorund-e7 padding-20">
                <center>
                  <div class="box-header-radius-80 background-biru teks-putih margin-bottom-50">
                    <h3>Kalkulasi Keuntungan</h3>
                  </div>
                </center>

                <div class="table-box">
                  <?php
                    $sqlKalkulasiUntung   = "SELECT * FROM detail_transaksi INNER JOIN barang ON detail_transaksi.barang_id = barang.id_barang WHERE nomor_tr = '$Tr' ";
                    $queryKalkulasiUntung = mysqli_query($host, $sqlKalkulasiUntung);
                    $dataKalulasi         = mysqli_fetch_assoc($queryKalkulasiUntung);
                    $cekDataKalkulasi     = mysqli_num_rows($queryKalkulasiUntung);

                    //! Sum Subtotal 
                    $sqlDetailBarangSub   = "SELECT SUM(sub_total) AS sub_total FROM detail_transaksi WHERE nomor_tr = '$Tr' ";
                    $queryDetailBarangSub = mysqli_query($host, $sqlDetailBarangSub);
                    $dataSubDetail_barang = mysqli_fetch_assoc($queryDetailBarangSub);

                    //! Sum Keuntungan Pertransaksi
                    $sumUntungTransaksi      = "SELECT SUM(untung_item_detail) AS untung_bersih FROM detail_transaksi WHERE nomor_tr = '$Tr' ";
                    $querySumUntungTransaksi = mysqli_query($host, $sumUntungTransaksi);
                    $keuntunganBersih        = mysqli_fetch_assoc($querySumUntungTransaksi); 
                  ?>
                  <table class="table-responsive">
                    <tr>
                      <td>Barang Yang Terjual</td>
                      <td> <span class="teks-hitam"> : </span> 
                        <?= $cekDataKalkulasi . " " . "<span class='lencana-radius lencana-hijau'>" . $dataKalulasi['satuan_stok_barang'] ."</span>"  ?>
                      </td>
                    </tr>
                      <td>Omzet Yang Di Dapat</td>
                      <td class="background-putih teks-hijau"> <span class="teks-hitam"> : </span> 
                      <?= "Rp. " . number_format($dataSubDetail_barang['sub_total'],0,',','.') ?>
                      </td>
                    </tr>
                    </tr>
                      <td>Keuntungan Bersih Yang Didapat</td>
                      <td class="background-putih teks-hijau"> <span class="teks-hitam"> : </span> 
                      <?= "Rp. " . number_format($keuntunganBersih['untung_bersih'],0,',','.') ?>
                      </td>
                    </tr>
                  </table>
                </div>
              </div>
            </div>
            <div class="kolom-100 margin-top-50">
              <center>
                <div class="box-header-radius-80 background-biru teks-putih margin-bottom-50">
                  <h3>Barang Yang Di Beli</h3>
                </div>
              </center>
              <div class="table-box">
                <table class="table-responsive">
                  <tr class="thead-dark">
                    <th>No</th>
                    <th>Nama Barang</th>
                    <th>Qty</th>
                    <th>Harga Satuan</th>
                    <th>Sub Total</th>
                  </tr>

                  <?php

                    $no                = 1;
                    $sqlDetailBarang   = "SELECT * FROM detail_transaksi INNER JOIN barang ON detail_transaksi.barang_id = barang.id_barang WHERE nomor_tr = '$Tr' ";
                    $queryDetailBarang = mysqli_query($host, $sqlDetailBarang);
                    while ($DetailBarang = mysqli_fetch_assoc($queryDetailBarang)) {

                  ?>
                  <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $DetailBarang['nama_barang'] ?></td>
                    <td><?= $DetailBarang['qty'] . " " . $DetailBarang['satuan_stok_barang'] ?></td>
                    <td><?= "Rp. " . number_format($DetailBarang['harga_jual_item'],0,',','.') ?></td>
                    <td><?= "Rp. " . number_format($DetailBarang['sub_total'],0,',','.') ?></td>
                  </tr>
                  <?php } ?>

                  <tr>
                    <td colspan="4">Total Pembelian</td>
                    <td class="background-hijau teks-putih">
                      <?= "Rp. " . number_format($dataSubDetail_barang['sub_total'],0,',','.') ?>
                    </td>
                  </tr>
                </table>
              </div>
              <a href="index.php?page=laporan" class="tmbl tmbl-abu-abu margin-20-0">
                Kembali
              </a>
            </div>

          </div>
				</div>
      </section>
		</main>
	</body>
</html>
