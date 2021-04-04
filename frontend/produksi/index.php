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
		<title>Monitoring Biaya Produksi | Data Produksi</title>

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
				<h3>Produksi</h3>
				<div class="breadcrumb">
					<h3>
						<a href="../../beranda.php?page=beranda">Beranda</a> <i class="fa fa-angle-right"></i>
						<span class="akhir-link-breadcrumb">Produksi</span>
					</h3>
				</div>

				<div class="container">

					<div class="baris">

						<a href="tambah_produksi.php?page=produksi" class="tmbl tmbl-biru margin-top-20-0">
							<i class="fa fa-plus"></i> Produksi Baru
						</a>

						<div class="kolom-100 margin-top-50 margin-bottom-100">

							<h2>Histori Produksi</h2>
							<div class="box-konten-radius backgorund-e7">
								<div class="box-badan-konten">

									<div class="table-box">
										<table class="table-responsive">
											<tr class="thead-dark">
												<th>No</th>
												<th>Tanggal Produksi</th>
												<th>Nama Produk</th>
												<th>Stok Produksi</th>
												<th>Stok Barang Tersedia</th>
												<th>Aksi</th>
											</tr>

											<?php  

												//? Pagination
												$halaman = 10;
												$page    = isset($_GET["halaman"]) ? (int)$_GET["halaman"] :1;
												$mulai   = ($page>1) ? ($page * $halaman) - $halaman : 0;
												$result  = mysqli_query($host, "SELECT * FROM produksi");
												$total   = mysqli_num_rows($result);
												$pages   = ceil($total/$halaman);
                      
                        $nomor = 1;
                        $sql   = "SELECT * FROM produksi ORDER BY tgl_produksi DESC LIMIT $mulai, $halaman";
                        $query = mysqli_query($host, $sql);
                        while ($data = mysqli_fetch_assoc($query) ) {
                      ?>
                      <tr>
                        <td><?= $nomor++?></td>
                        <td><?= date('d M Y', strtotime($data['tgl_produksi'])) ?></td>
                        <td><?= $data['nama_produk']?></td>
                        <td>
													<?php 
														if ($data['stok_produk'] >= 10) {
															echo number_format($data['stok_produk'],0,',','.') . " " . "<span class='lencana-radius lencana-hijau'>" . $data['satuan_stok_produk'] . "</span>" ;
														} elseif ($data['stok_produk'] >= 0) {
															echo "<span class='teks-merah'>" .  number_format($data['stok_produk'],0,',','.') . "</span>" . " " . "<span class='lencana-radius lencana-hijau'>" . $data['satuan_stok_produk'] . "</span>" ;
														} elseif ($data['stok_produk'] = 0) {
															echo "<span class='lencana-radius lencana-merah'>Stok Habis</span>";
														}
													?>
												</td>
												<td>
													<?php
														$id_produksi = $data['id_produksi'];
														//! Select Stok Terkini Barang 
														$selectStokBarang = "SELECT * FROM barang WHERE produksi_id = '$id_produksi'";
														$queryStokBarang  = mysqli_query($host, $selectStokBarang);
														$dataStokBarang   = mysqli_fetch_assoc($queryStokBarang);
														$stok             = $dataStokBarang['stok_barang'];

														if ($stok != 0) {
															echo number_format($stok,0,',','.') . " " . "<span class='lencana-radius lencana-hijau'>" . $data['satuan_stok_produk'] . "</span>" ;
														} else {
															echo "<span class='lencana-radius lencana-merah'>Stok Sudah Habis</span>";
														}
														
													?>
												</td>
                        <td>
                          <a href="detail_produksi.php?ip=<?php echo $data['id_produksi']?>&page=produksi" class="tmbl tmbl-biru">
                            <i class="fa fa-eye"></i>
                          </a>
                        </td>
                      </tr>
                      <?php } ?>
										</table>
									</div>
								</div>
							</div>

							<div class="penomoran">
								<?php
									for ($i=1; $i <= $pages ; $i++) { 
								?>
									<a href="?halaman=<?php echo $i; ?>&page=produksi" class="tmbl tmbl-abu-abu margin-20-0">
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
