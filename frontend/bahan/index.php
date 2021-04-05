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
		<title>Monitoring Biaya Produksi | Data Bahan</title>

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
				<h3>Data Bahan Baku & Bahan Pendukung</h3>
				
				<div class="breadcrumb">
						<h3>
							<a href="../../beranda.php?page=beranda">Beranda</a> <i class="fa fa-angle-right"></i>
							<span class="akhir-link-breadcrumb">Data Bahan Baku & Bahan Pendukung</span>
						</h3>
				</div>

				<div class="container margin-bottom-100">
					<div class="baris baris-tengah">
						<div class="kolom-50-kiri">
							<div class="box-konten-radius backgorund-e7 padding-20">
								<center>
									<a href="bhn_baku/index.php?page=bahan">
										<div class="box-header-radius-80 background-biru teks-putih">
											<h2>Data Bahan Baku</h2>
										</div>
									</a>
								</center>
							</div>
						</div>

						<div class="kolom-50-kanan">
							<div class="box-konten-radius backgorund-e7 padding-20">
								<center>
									<a href="bhn_jadi/index.php?page=bahan">
										<div class="box-header-radius-80 background-hijau teks-putih">
											<h2>Data Bahan Pendukung</h2>
										</div>
									</a>
								</center>
							</div>
						</div>

						<div class="kolom-100 margin-top-50">
							<h2>Pratinjau Bahan Bahan</h2>
							<div class="box-konten-radius backgorund-e7 padding-20">
								<div class="table-box">
									<table class="table-responsive">
										<tr>
											<th>No</th>
											<th>Bahan</th>
											<th>Satuan</th>
											<th>Harga Persatuan</th>
											<th>Kategori</th>
										</tr>

										<?php

											include '../../database/koneksi.php';

											//! Select data bahan
											$no     = 1;
											$sql    = "SELECT * FROM bahan ORDER BY nama_bahan ASC LIMIT 10";
											$query  = mysqli_query($host, $sql);
											while ($listBahan = mysqli_fetch_assoc($query) ) {

										?>

										<tr>
											<td><?php echo $no++ ?></td>
											<td><?php echo $listBahan['nama_bahan'] ?></td>
											<td><?php echo $listBahan['kuantitas'] . " " . $listBahan['satuan'] ?></td>
											<td><?php echo "Rp. " . number_format($listBahan['harga'], 0, ',' , '.') ?></td>
											<td>
												<?php 
													if ($listBahan['kategori'] == 'bahan baku') {
														echo "<span class='lencana lencana-biru'>" . ucwords(strtolower($listBahan['kategori']))  ."</span>";
													} else {
														echo "<span class='lencana lencana-hijau'>Bahan Pendukung</span>";
													}
												?>
											</td>
										</tr>

										<?php } ?>
									</table>
								</div>
							</div>
						</div>
					</div>
				</div>
			</section>
		</main>
	</body>
</html>
