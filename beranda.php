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
		<link rel="stylesheet" href="assets/css/main.css" />
		<link rel="stylesheet" href="assets/css/style.css" />
		<link rel="stylesheet" href="assets/css/sidebar.css" />
	</head>
	<body>
	<?php
		include 'database/koneksi.php';
		include 'frontend/layout/sidebar.php';
	?>
		<main class="main">
			<section>
				<h2>Monitoring Biaya Produksi</h2>
				<h3>Beranda</h3>
				<div class="breadcrumb">
					<h3>
						Beranda
					</h3>
				</div>

				<div class="container">
					<div class="baris baris-tengah">

						<div class="kolom-25">
							<div class="box-konten-radius background-biru padding-10">
								<h2 class="teks-putih text-center-sm">150</h2>
								<p class="teks-putih text-center-sm">
									Penjualan Bulan Ini
								</p>
								<!-- <p class="teks-center">
									Lorem ipsum dolor sit amet, consectetur adipisicing elit. Repudiandae aut sapiente similique atque totam beatae, esse odio doloremque deleniti dignissimos expedita repellendus accusantium iusto nihil, harum consequuntur quia error sit.
								</p> -->
							</div>
						</div>

						<div class="kolom-25">
							<div class="box-konten-radius background-hijau padding-10">
								<h2 class="teks-putih text-center-sm">150</h2>
								<p class="teks-putih text-center-sm">
									Penjualan Bulan Ini
								</p>
							</div>
						</div>

						<div class="kolom-25">
							<div class="box-konten-radius background-info padding-10">
								<h2 class="teks-putih text-center-sm">150</h2>
								<p class="teks-putih text-center-sm">
									Penjualan Bulan Ini
								</p>
							</div>
						</div>

						<div class="kolom-25">
							<div class="box-konten-radius background-kuning padding-10">
								<h2 class="teks-hitam text-center-sm">150</h2>
								<p class="teks-hitam text-center-sm">
									Penjualan Bulan Ini
								</p>
							</div>
						</div>

					</div>
				</div>
				
      </section>

		</main>

	</body>
</html>
