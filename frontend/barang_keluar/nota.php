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
		<title>Monitoring Biaya Produksi | Nota Pembelian</title>

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
							<span class="akhir-link-breadcrumb">Transaksi Selesai</span>
						</h3>
				</div>

				<div class="container">
					<div class="baris baris-tengah">
            <div class="kolom-70">
              <div class="box-konten-radius backgorund-e7 padding-20">

                <center>
                  <div class="box-header-radius-80 background-hijau teks-putih padding-10">
                    <h2>Transaksi Berhasil</h2>
                  </div>
                </center>
                
                <div class="margin-top-50">

                  <?php

                    $Tr  = $_GET['Tr'];

                    $sqlLaporan   = "SELECT * FROM laporan_brg_keluar WHERE nomor_transaksi = '$Tr' ";
                    $queryLaporan = mysqli_query($host, $sqlLaporan);
                    $dataLaporan  = mysqli_fetch_assoc($queryLaporan);
                  ?>

                  <table class="margin-bottom-20">
                    <tr class="paragh">
                      <td>
                        <span class="teks-bold">Tanggal </span>
                      </td>
                      <td> : <?php echo date('d M Y', strtotime($dataLaporan['tgl_laporan'])) ?> </td>
                    </tr>
                    <tr class="paragh">
                      <td>
                        <span class="teks-bold">No Nota </span>
                      </td>
                      <td> : <?php echo $Tr ?> </td>
                    </tr>
                    <tr class="paragh">
                      <td>
                        <span class="teks-bold">Kasir </span>
                      </td>
                      <td> : <?php echo $dataLaporan['petugas_kasir'] ?> </td>
                    </tr>
                  </table>

                  <div class="table-box">
                    <table class="table-responsive">
                      <tr class="thead-dark">
                          <th>No</th>
                          <th>Barang</th>
                          <th>Qty</th>
                          <th>@Harga Satuan</th>
                          <th>Subtotal</th>
                      </tr>

                      <?php

                        $no        = 1;
                        $sqlNota   = "SELECT * FROM detail_transaksi INNER JOIN barang ON detail_transaksi.barang_id = barang.id_barang WHERE nomor_tr = '$Tr' ORDER BY nama_barang ASC ";
                        $queryNota = mysqli_query($host, $sqlNota);

                        while ($detail = mysqli_fetch_assoc($queryNota) ) {

                      ?>

                      <tr>
                        <td><?php echo $no++?></td>
                        <td><?php echo $detail['nama_barang'] ?></td>
                        <td><?php echo $detail['qty'] . " " . $detail['satuan_stok_barang'] ?></td>
                        <td><?php echo "Rp. " . number_format($detail['harga_item'],0,',','.') ?></td>
                        <td><?php echo "Rp. " . number_format($detail['sub_total'],0,',','.') ?></td>
                      </tr>

                      <?php } ?>
                    </table>
                  </div>

                </div>

                <div class="kolom-kalulasi-sementara">
                  <div class="box-header-radius-30 background-hijau teks-putih float-right margin-20-0">
                    <?php
                    
                      $sqlTotal   = "SELECT SUM(sub_total) AS total FROM detail_transaksi  WHERE nomor_tr = '$Tr' ";
                      $queryTotal = mysqli_query($host, $sqlTotal);
                      $total      = mysqli_fetch_assoc($queryTotal);

                    ?>
                    Total
                    <b> : <?= "Rp. " . number_format($total['total'],0,',','.') ?></b>
                  </div>
                </div>

              </div>
              <center class="margin-bottom-100 margin-top-50">
                <a href="index.php?page=barangkeluar" class="tmbl tmbl-abu-abu">
                <i class="fa fa-shopping-cart"></i> Barang Keluar
                </a> 
                <a target="_blank" href="cetak_nota.php?Tr=<?php echo $Tr ?>" class="tmbl tmbl-biru">
                  <i class="fa fa-clipboard"></i> Cetak Nota
                </a>
              </center>
            </div>
					</div>
				</div>

				
      </section>

		</main>

	</body>
</html>