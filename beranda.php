<?php
	session_start();

	if ($_SESSION['level'] != 'admin') {
		header("location:login.php?pesan=bukanadmin");
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
					Monitoring Biaya Produksi
				</h2>
				<h3 class="text-right">
					<?= tgl_indo(date('Y-m-d'))?>
					--
					<span class="lencana-radius lencana-biru" id="span"></span>
				</h3>

				<h3>Beranda</h3>
				<div class="breadcrumb">
					<h3>
						Beranda
					</h3>
				</div>

				<div class="container margin-bottom-100">
					<div class="baris baris-tengah">

						<?php
							$today = date('Y-m-d');
							$month = date('m', strtotime($today));

							$orderdate  = explode('-', $today);
							$years      = $orderdate[0];
							$month      = $orderdate[1];
							$day        = $orderdate[2];

							function tgl_indo($today){
								$bulan = array (
									1 =>   'Januari',
									'Februari',
									'Maret',
									'April',
									'Mei',
									'Juni',
									'Juli',
									'Agustus',
									'September',
									'Oktober',
									'November',
									'Desember'
								);
								$pecahkan = explode('-', $today);

								return $pecahkan[2] . ' ' . $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[0];
							}

							//! Keuntungan Hari Ini
							$sumUntungHariIni   = "SELECT SUM(untung_item_detail) AS untung_hari_ini FROM detail_transaksi WHERE tgl_transaksi = '$today' ";
							$querySumUntungHrini= mysqli_query($host, $sumUntungHariIni);
							$totalUntungHrini   = mysqli_fetch_assoc($querySumUntungHrini);

							//! Keuntungan Bulanan
							$untungBulanan    	= "SELECT SUM(untung_item_detail) AS untung_bulanan FROM detail_transaksi WHERE YEAR(tgl_transaksi) = $years AND MONTH(tgl_transaksi) = $month  ";
							$queryBulanan     	= mysqli_query($host, $untungBulanan);
							$totalUntungBulanan = mysqli_fetch_assoc($queryBulanan);

							//! Omzet Bulanan
							$sumOmzetBulanan   		= "SELECT SUM(sub_total) AS omzet_bulanan FROM detail_transaksi WHERE YEAR(tgl_transaksi) = $years AND MONTH(tgl_transaksi) = $month ";
							$querySumOmzetBulanan = mysqli_query($host, $sumOmzetBulanan);
							$omzetBulanan         = mysqli_fetch_assoc($querySumOmzetBulanan);

							//! Omzet Harian 
							$sumOmzetHarian       = "SELECT SUM(sub_total) AS omzet_harian FROM detail_transaksi WHERE tgl_transaksi = '$today' ";
							$queryOmzetharian     = mysqli_query($host, $sumOmzetHarian);
							$omzetHarian          = mysqli_fetch_assoc($queryOmzetharian);

							//! Barang Terjual Harian 
							$barangJualHarian    = "SELECT SUM(qty) AS jual_harian_barang FROM detail_transaksi WHERE tgl_transaksi = '$today' ";
							$queryJualHarian     = mysqli_query($host, $barangJualHarian);
							$hitungJualHarian    = mysqli_fetch_assoc($queryJualHarian);
							$cekDataJualHarian   = mysqli_num_rows($queryJualHarian);


							//! Barang Terjual Bulanan
							$barangJualBulanan   = "SELECT SUM(qty) AS jual_bulanan_barang FROM detail_transaksi WHERE YEAR(tgl_transaksi) = $years AND MONTH(tgl_transaksi) = $month ";
							$queryJualBulanan    = mysqli_query($host, $barangJualBulanan);
							$hitungJualBulanan   = mysqli_fetch_assoc($queryJualBulanan); 
							$cekDataJualBulanan  = mysqli_num_rows($queryJualBulanan);
						?>

						<div class="kolom-25">
							<div class="box-konten-radius background-biru padding-20">
								<h3 class="teks-putih text-center-sm letter-spacing-2px">
									<?= "Rp. " . number_format($totalUntungHrini['untung_hari_ini'],0,',','.') . ",-" ?>
								</h3>
								<p class="teks-putih text-center-sm">
									Keuntungan Hari Ini
								</p>
							</div>
						</div>

						<div class="kolom-25">
							<div class="box-konten-radius background-hijau padding-20">
								<h3 class="teks-putih text-center-sm letter-spacing-2px">
									<?= "Rp. " . number_format($totalUntungBulanan['untung_bulanan'],0,',','.') . ",-" ?>
								</h3>
								<p class="teks-putih text-center-sm">
									Keuntungan Bulan Ini
								</p>
							</div>
						</div>

						<div class="kolom-25">
							<div class="box-konten-radius background-abu-abu padding-20">
								<h3 class="teks-putih text-center-sm letter-spacing-2px">
								<?= "Rp. " . number_format($omzetHarian['omzet_harian'],0,',','.') . ",-" ?>
								</h3>
								<p class="teks-putih text-center-sm">
									Omzet Hari Ini
								</p>
							</div>
						</div>

						<div class="kolom-25">
							<div class="box-konten-radius background-merah padding-20">
								<h3 class="teks-putih text-center-sm letter-spacing-2px">
								<?= "Rp. " . number_format($omzetBulanan['omzet_bulanan'],0,',','.') . ",-" ?>
								</h3>
								<p class="teks-putih text-center-sm">
									Omzet Bulan Ini
								</p>
							</div>
						</div>

						<div class="kolom-25">
							<div class="box-konten-radius background-info padding-20">
								<h3 class="teks-putih text-center-sm letter-spacing-2px">
									<?php
										if ($hitungJualHarian['jual_harian_barang'] == null) {
											echo 0;
										} else {
											echo $hitungJualHarian['jual_harian_barang'];
										}
									?>
									Pcs
								</h3>
								<p class="teks-putih text-center-sm">
									Barang Terjual Hari Ini
								</p>
							</div>
						</div>

						<div class="kolom-25">
							<div class="box-konten-radius background-kuning padding-20">
								<h3 class="teks-hitam text-center-sm letter-spacing-2px">
									<?php
										if ($hitungJualBulanan['jual_bulanan_barang'] == null) {
											echo 0;
										}else {
											echo $hitungJualBulanan['jual_bulanan_barang'];
										}
									?> 
									Pcs
								</h3>
								<p class="teks-hitam text-center-sm">
									Barang Terjual Bulan Ini
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
