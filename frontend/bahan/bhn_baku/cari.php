<?php
	session_start();

	if ($_SESSION['level'] != 'admin') {
		header("location:../../../login.php?pesan=bukanadmin");
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
		<link rel="stylesheet" href="../../../assets/css/main.css" />
		<link rel="stylesheet" href="../../../assets/css/style.css" />
		<link rel="stylesheet" href="../../../assets/css/sidebar.css" />
	</head>
	<body>

		<?php
			include '../../layout/sidebar.php';
		?>

		<main class="main">
			<section>
				<h2>Monitoring Biaya Produksi</h2>
				<h3>Data Bahan Baku</h3>
				<div class="breadcrumb">
					<h3>
						<a href="../../../beranda.php?page=beranda">Beranda</a> <i class="fa fa-angle-right"></i>
						<a href="../index.php?page=bahan">Data Bahan</a> <i class="fa fa-angle-right"></i>
						<span class="akhir-link-breadcrumb">Data Bahan Baku</span>
					</h3>
				</div>

				<div class="container">
					<div class="baris">
						<div class="kolom-100">
							<a href="index.php?page=bahan" class="tmbl tmbl-abu-abu margin-20-0">
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
										<th>Bahan Baku</th>
										<th>Tanggal Beli</th>
										<th>Satuan</th>
										<th>Harga Satuan</th>
										<th>Aksi</th>
									</tr>

									<?php

										include '../../../database/koneksi.php';

										//? Pencarian 
										if (isset($_POST['btncari']))  {
											$cari        = $_POST['cari'];
											$sql_cari    = "SELECT * FROM bahan WHERE kategori = 'bahan baku' AND nama_bahan LIKE '%".$cari."%'";
											$query       = mysqli_query($host, $sql_cari);
										} 

										$no  = 1;
										while ($data = mysqli_fetch_assoc($query) ) {

									?>
									<tr>
										<td><?php echo $no++;?></td>
										<td><?php echo $data['nama_bahan']; ?></td>
										<td><?php echo date('d F Y', strtotime($data['tgl']))?></td>
										<td><?php echo $data['kuantitas'] . " " . $data['satuan']?></td>
										<td><?php echo "Rp " . number_format($data['harga'],0,',','.')?></td>
										<td>
											<a href="edit.php?id_bahan=<?php echo $data['id_bahan'];?>&page=bahanbaku" class="tmbl tmbl-kuning">
												<i class="fa fa-edit"></i>
											</a>
											<a onclick="return confirm('Anda yakin ingin menghapus data ?')" href="../../backend/bahan_baku/hapus.php?id_bahan=<?php echo $data['id_bahan'];?>" class="tmbl tmbl-merah">
												<i class="fa fa-trash"></i>
											</a>
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
