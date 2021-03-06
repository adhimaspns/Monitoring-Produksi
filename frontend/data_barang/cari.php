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
		<title>Monitoring Biaya Produksi | Data Barang</title>

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
			include '../layout/sidebar.php';
		?>

		<main class="main">
			<section>
				<h2>Monitoring Biaya Produksi</h2>
				<h3>Data Barang</h3>
				<div class="breadcrumb">
					<h3>
						<a href="../../beranda.php?page=beranda">Beranda</a> <i class="fa fa-angle-right"></i>
						<a href="index.php?page=databarang">Data Barang</a> <i class="fa fa-angle-right"></i>
						<span class="akhir-link-breadcrumb">Cari Data Barang</span>
					</h3>
				</div>

				<div class="container">
					<div class="baris">
						<div class="kolom-100 margin-bottom-100">
							<a href="index.php?page=databarang" class="tmbl tmbl-abu-abu margin-20-0">
								Kembali
							</a>
							<div class="table-box">

								<div class="kolom-20 float-left">
									<?php
										if (isset($_POST['btncari'])) {
											$cari = $_POST['cari'];

											echo "<b> Hasil Pencarian : " .$cari. "</b>";
										}
									?>
								</div>

								<table class="table-responsive">
									<tr class="thead-dark">
										<th>No</th>
										<th>Tanggal Produksi</th>
										<th>Nama Produk</th>
										<th>Stok</th>
										<th>Harga Jual</th>
									</tr>

									<?php
									
										include '../../database/koneksi.php';

										//? Pencarian 
										if (isset($_POST['btncari']))  {
											$cari        = $_POST['cari'];
											$sql_cari    = "SELECT * FROM barang INNER JOIN produksi ON barang.produksi_id = produksi.id_produksi WHERE nama_barang LIKE '%".$cari."%' AND stok_barang != 0 ";
											$query       = mysqli_query($host, $sql_cari);
										}

										$no  = 1;
										while ($data = mysqli_fetch_assoc($query) ) {

									?>
									<tr>
										<td><?php echo $no++;?></td>
										<td><?= date('d M Y', strtotime($data['tgl_produksi'])) ?></td>
										<td><?php echo $data['nama_barang']; ?></td>
										<td>
											<?php 
												if ($data['stok_barang'] >= 10) {
													echo number_format($data['stok_barang'],0,',','.') . " " . "<span class='lencana-radius lencana-hijau'>" . $data['satuan_stok_barang'] . "</span>" ;
												} elseif ($data['stok_barang'] >= 0) {
													echo "<span class='teks-merah'>" .  number_format($data['stok_barang'],0,',','.') . "</span>" . " " . "<span class='lencana-radius lencana-hijau'>" . $data['satuan_stok_barang'] . "</span>" ;
												} elseif ($data['stok_barang'] = 0) {
													echo "<span class='lencana-radius lencana-merah'>Stok Habis</span>";
												}
											?>
										</td>
										<td>
											<?php echo "Rp. " . number_format($data['harga_jual_item'],0,',','.') ?>
										</td>
									</tr>
									<?php
										}
									?>
								</table>
							</div>
						</div>
					</div>
				</div>
			</section>
		</main>
	</body>
</html>
