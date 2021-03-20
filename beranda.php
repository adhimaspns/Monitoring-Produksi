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
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
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
				<h2>
					Monitoring Biaya Produksi | <span id="span"></span>
				</h2>
				<h3>Beranda</h3>
				<div class="breadcrumb">
					<h3>
						Beranda
					</h3>
				</div>

				<div class="container">
					<div class="baris baris-tengah">

						<?php
							$today = date('Ymd');
							$month = date('m', strtotime($today));

							//! Keuntungan Hari Ini
							$sumUntungHariIni   = "SELECT SUM(untung_item_detail) AS untung_hari_ini FROM detail_transaksi WHERE tgl_transaksi = '$today' ";
							$querySumUntungHrini= mysqli_query($host, $sumUntungHariIni);
							$totalUntungHrini   = mysqli_fetch_assoc($querySumUntungHrini);

							//! Omzet Bulanan
							$sumOmzetBulanan   		= "SELECT SUM(sub_total) AS omzet_bulanan FROM detail_transaksi WHERE tgl_transaksi = '$month' ";
							$querySumOmzetBulanan = mysqli_query($host, $sumOmzetBulanan);
							$omzetBulanan         = mysqli_fetch_assoc($querySumOmzetBulanan);
						?>

						<div class="kolom-25">
							<div class="box-konten-radius background-biru padding-20">
								<h2 class="teks-putih text-center-sm letter-spacing-2px">
									<?= "Rp. " . number_format($totalUntungHrini['untung_hari_ini'],0,',','.') . ",-" ?>
								</h2>
								<p class="teks-putih text-center-sm">
									Keuntungan Hari Ini
								</p>
								<!-- <p class="teks-center">
									Lorem ipsum dolor sit amet, consectetur adipisicing elit. Repudiandae aut sapiente similique atque totam beatae, esse odio doloremque deleniti dignissimos expedita repellendus accusantium iusto nihil, harum consequuntur quia error sit.
								</p> -->
							</div>
						</div>

						<div class="kolom-25">
							<div class="box-konten-radius background-hijau padding-20">
								<h2 class="teks-putih text-center-sm letter-spacing-2px">
									<?= "Rp. " . number_format($omzetBulanan['omzet_bulanan'],0,',','.') . ",-" ?>
								</h2>
								<p class="teks-putih text-center-sm">
									<!-- Omzet Bulan <?php echo date('F', strtotime($today)) ?> -->
									Omzet Bulan Ini
								</p>
							</div>
						</div>

						<div class="kolom-25">
							<div class="box-konten-radius background-info padding-20">
								<h2 class="teks-putih text-center-sm letter-spacing-2px">150</h2>
								<p class="teks-putih text-center-sm">
									Penjualan Bulan Ini
								</p>
							</div>
						</div>

						<div class="kolom-25">
							<div class="box-konten-radius background-kuning padding-20">
								<h2 class="teks-hitam text-center-sm letter-spacing-2px">150</h2>
								<p class="teks-hitam text-center-sm">
									Penjualan Bulan Ini
								</p>
							</div>
						</div>

					</div>
				</div>
				
      </section>

		</main>

		<script>
			var span = document.getElementById('span');

			function time() {
				var d = new Date();
				var s = d.getSeconds();
				var m = d.getMinutes();
				var h = d.getHours();
				span.textContent = 
					("0" + h).substr(-2) + ":" + ("0" + m).substr(-2) + ":" + ("0" + s).substr(-2);
			}

			setInterval(time, 1000);

		</script>

	</body>
</html>
