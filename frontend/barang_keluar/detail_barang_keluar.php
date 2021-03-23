<?php
	session_start();

	if ($_SESSION['level'] != 'admin') {
		header("location:../../login.php?pesan=bukanadmin");
	}

?>
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
		include '../layout/sidebar.php';
	?>
		<main class="main">
			<section>
				<h2>Monitoring Biaya Produksi</h2>
				<h3>Barang Keluar</h3>
				<div class="breadcrumb">
          <h3>
            <a href="../../beranda.php?page=beranda">Beranda</a> <i class="fa fa-angle-right"></i>
            <a href="index.php?page=barangkeluar">Barang Keluar</a> <i class="fa fa-angle-right"></i>
            <span class="akhir-link-breadcrumb">Detail Barang Keluar</span>
          </h3>
				</div>

				<div class="container margin-bottom-100">
					<div class="baris">
						<div class="kolom-100">
              <div class="table-box">
                <table class="table-responsive">
                  <tr class="thead-dark">
                    <th>No</th>
                    <th>Barang</th>
                    <th>Qty</th>
                    <th>Harga Satuan</th>
                    <th>Subtotal</th>
                    <!-- <th>Grand Total</th> -->
                  </tr>

                  <?php
                    $Tr  = $_GET['Tr'];

                    $no                   = 1;
                    $sqlDetailTransaksi   = "SELECT * FROM detail_transaksi INNER JOIN barang ON detail_transaksi.barang_id = barang.id_barang WHERE nomor_tr = '$Tr' ";
                    $queryDetailTransaksi = mysqli_query($host, $sqlDetailTransaksi);
                    while ($data  = mysqli_fetch_assoc($queryDetailTransaksi) ) {

                  ?>
                  <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $data['nama_barang'] ?></td>
                    <td><?= $data['qty'] . " " . "<span class='lencana-radius lencana-hijau'>". $data['satuan_stok_barang'] ."</span>" ?></td>
                    <td><?= "Rp. " . number_format($data['harga_jual_item'],0,',','.') ?></td>
                    <td><?= "Rp. " . number_format($data['sub_total'],0,',','.') ?></td>
                  </tr>
                  <?php } ?>
                  <tr>
                    <!-- <td colspan="1"></td> -->
                    <td colspan="4">Grand Total</td>
                    <td colspan="1" class="background-hijau teks-putih">20.0000</td>
                  </tr>
                </table>
              </div>
              <a href="index.php?page=barangkeluar" class="tmbl tmbl-abu-abu margin-20-0">
                Kembali
              </a>
            </div>
					</div>
				</div>
      </section>
		</main>
	</body>
</html>