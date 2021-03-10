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
				<h2>Data Barang</h2>
				<div class="breadcrumb">
            <h3>
							<a href="../../beranda.php?page=beranda">Beranda</a> <i class="fa fa-angle-right"></i>
							<a href="index.php?page=databarang">Data Barang</a> <i class="fa fa-angle-right"></i>
							<span class="akhir-link-breadcrumb">Detail Data Barang</span>
						</h3>
				</div>

				<div class="container">
					<div class="baris">
						<div class="kolom-100">
							<div class="box-konten-radius backgorund-e7">
                  <center>
                    <div class="box-header-radius-80 background-biru teks-putih">
                      <h2>Data Detail Barang</h2>
                    </div>
                  </center>
									<div class="box-badan-konten">
                    <?php

                      $id_barang = $_GET['id_barang'];
                    
                      $sql    = "SELECT * FROM barang WHERE id_barang = '$id_barang' ";
                      $query  = mysqli_query($host, $sql);
                      $data   = mysqli_fetch_assoc($query);
                    
                    ?>
										<div class="table-box">
                      <?php?>
											<table class="table-responsive">

												<tr>
													<td>Nama Produk</td>
													<td>: <?= $data['nama_barang'] ?></td>
												</tr>

                        <tr>
													<td>Stok Barang</td>
													<td>: <?= $data['stok_barang'] . " " . $data['satuan_stok_barang']  ?></td>
												</tr>

                        <tr>
													<td>Untung Per Item</td>
													<td>: <?= $data['untung_barang'] ?></td>
												</tr>

												
											</table>
										</div>
									</div>
								</div>
							</div>
					</div>
				</div>

				
      </section>

		</main>

	</body>
</html>