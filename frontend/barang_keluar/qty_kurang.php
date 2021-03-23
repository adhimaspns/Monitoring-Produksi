<?php
	session_start();

	if ($_SESSION['level'] != 'admin') {
		header("location:../../login.php?pesan=bukanadmin");
	}

	include '../../database/koneksi.php'; 
?>
<!DOCTYPE html>
<html lang="pt-BR">
	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<title>Monitoring Biaya Produksi | Data Jasa</title>

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

		<main class="main">
			<section>
				<div class="container">
					<div class="baris baris-tengah">
						<div class="kolom-50">
							<div class="box-konten margin-top-150">
								<h2>Mengurangi Qty Barang</h2>
								<form action="../../backend/barang_keluar/tambah.php" method="POST">

									<?php

										$i    = $_GET['i'];
										$Tr   = $_GET['Tr'];
										$b    = $_GET['b'];

										$sql   = "SELECT * FROM kasir INNER JOIN barang ON kasir.barang_id = barang.id_barang WHERE  id_kasir = '$i' ";
										$query = mysqli_query($host, $sql);
										$data   = mysqli_fetch_assoc($query);

									?>

									<input type="hidden" name="i" value="<?php echo $i?>">
									<input type="hidden" name="Tr" value="<?php echo $Tr?>">
									<input type="hidden" name="b" value="<?php echo $b?>">

									<label>Nama Produk</label>
									<input type="text" class="form" value="<?php echo $data['nama_barang']?>" readonly>

									<label>Qty Awal</label>
									<input type="text" name="qtyawal" class="form" value="<?php echo $data['qty']?>" readonly>

									<label>Qty Yang Dikurangi</label>
									<input type="number" name="qtykurang" class="form" required>

									<input type="submit" value="Simpan" name="qtyKurang" class="tmbl tmbl-hijau">

									<a href="kasir.php?Tr=<?php echo $Tr?>&page=barangkeluar" class="tmbl tmbl-abu-abu">
										Kembali
									</a>
								</form>
							</div>
						</div>
					</div>
				</div>
			</section>
		</main>

	</body>
</html>
