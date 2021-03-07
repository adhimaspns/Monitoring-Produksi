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
				<h2>Data Bahan Jadi</h2>
				<div class="breadcrumb">
						<h3>
							<a href="../../../beranda.php?page=beranda">Beranda</a> <i class="fa fa-angle-right"></i>
							<a href="../index.php?page=bahan">Data Bahan</a> <i class="fa fa-angle-right"></i>
							<a href="index.php?page=bahan">Data Bahan Jadi</a> <i class="fa fa-angle-right"></i>
							<span class="akhir-link-breadcrumb">Cari Bahan Jadi</span>
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

								<div class="kolom-20 float-right margin-20-0">
									
									<!-- <form action="index.php?page=bahan" method="get">	
										<label>Carikan</label>
										<input type="text" name="cari" class="form" placeholder="Ketikan Sesuatu..."> 
										
										<input type="submit" value="Cari" class="tmbl tmbl-hijau">
									</form> -->
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

										//? Pagination
										$halaman = 10;
										$page    = isset($_GET["halaman"]) ? (int)$_GET["halaman"] :1;
										$mulai   = ($page>1) ? ($page * $halaman) - $halaman : 0;
										$result  = mysqli_query($host, "SELECT * FROM bahan WHERE kategori = 'bahan jadi'");
										$total   = mysqli_num_rows($result);
										$pages   = ceil($total/$halaman);

										//? Pencarian 
										if (isset($_POST['btncari']))  {
											$cari        = $_POST['cari'];
											$sql_cari    = "SELECT * FROM bahan WHERE kategori = 'bahan jadi' AND nama_bahan LIKE '%".$cari."%' LIMIT $mulai, $halaman";
											$query       = mysqli_query($host, $sql_cari);
										} else {

											$sql   = "SELECT * FROM bahan WHERE kategori = 'bahan jadi' ORDER BY nama_bahan ASC LIMIT $mulai, $halaman";
											$query = mysqli_query($host, $sql);
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

							<div class="penomoran">

								<?php
									for ($i=1; $i <= $pages ; $i++) { 

								?>
									<a href="?halaman=<?php echo $i; ?>&page=bahan" class="tmbl tmbl-abu-abu margin-20-0">
											<?php echo $i; ?>
										</a>
								<?php
									}
								?>

								<table style="margin-bottom: 50px;">
									<tr>
										<td>Jumlah data per halaman </td>
										<td>
											: <span class="lencana-radius lencana-info"><?php echo $halaman; ?></span> 
										</td>
									</tr>
									<tr>
										<td>Total data</td>
										<td> : <span class="lencana-radius lencana-info"><?php echo $total; ?></span> </td>
									</tr>
									<tr>
										<td>Halaman ke</td>
										<td> : <span class="lencana-radius lencana-info"><?php echo $page; ?></span> </td>
									</tr>
									<tr>
										<td>Total halaman</td>
										<td> : <span class="lencana-radius lencana-info"><?php echo $pages; ?></span> </td>
									</tr>
								</table>

							</div>
							
						</div>

					</div>
				</div>
			</section>

		</main>

	</body>
</html>
