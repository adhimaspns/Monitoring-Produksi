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
							<a href="index.php?page=produksi">Produksi</a> <i class="fa fa-angle-right"></i>
							<span class="akhir-link-breadcrumb">Detail Data Produksi</span>
						</h3>
				</div>

				<div class="container">
					<div class="baris">
						<!-- Cek Data & Tampilkan -->
						<?php

							$ip = $_GET['ip'];


							//! CEK DATA WHERE ID 
							$cekData   =  "SELECT * FROM detail_produksi WHERE produksi_id = '$ip' "; 
							$queryData = mysqli_query($host, $cekData);
							$cekdId    = mysqli_num_rows($queryData);

							if ($cekdId != null) {

								//! SELECT DATA WHERE ID 
								$sql        = "SELECT * FROM detail_produksi INNER JOIN produksi ON detail_produksi.produksi_id = produksi.id_produksi WHERE produksi_id = '$ip' ";
								$query      = mysqli_query($host, $sql);
								$list_biaya = mysqli_fetch_assoc($query);


								//! SELECT SUM WHERE ID
								$sqlSum     = "SELECT SUM(sub_total) AS total_biaya_produksi FROM detail_produksi WHERE produksi_id = '$ip' "; 
								$querySum   = mysqli_query($host, $sqlSum);
								$dataSum    = mysqli_fetch_assoc($querySum);


								//! ARITMATIKA 
								$hargaSatuan = $dataSum['total_biaya_produksi'] / $list_biaya['stok_produk'] + $list_biaya['untung_produk'];
								$cuan        = $list_biaya['stok_produk'] * $list_biaya['untung_produk'];

								//! Variabel 
								$produksi_id      = $list_biaya['produksi_id'];
								$total_biaya      = $dataSum['total_biaya_produksi'];
								$stok_produk      = $list_biaya['stok_produk'];

								//! Select Data barang  
								$selectStokBarang = "SELECT * FROM barang WHERE produksi_id = '$ip' ";
								$queryStokBarang  = mysqli_query($host, $selectStokBarang);
								$dataStokBarang   = mysqli_fetch_assoc($queryStokBarang);
								$stokBarang       = $dataStokBarang['stok_barang'];

						?>

							<div class="kolom-100 margin-top-50 margin-bottom-100">

								<h2>Kalkulasi Biaya Produksi & Harga Jual</h2>
								<div class="box-konten-radius backgorund-e7">
									<div class="box-badan-konten">
										<div class="table-box">
											<table class="table-responsive">
												<tr class="thead-dark">
													<th>Nama Produk</th>
													<th>Tanggal Produksi</th>
													<th>Biaya Produksi</th>
													<th>Stok Produk</th>
													<th>Keinginan Untung Per Item</th>
													<th>Harga Jual Per Item</th>
													<th>Estimasi Keuntungan Bersih Yang Didapat</th>
												</tr>

												<tr>
													<td><?= $list_biaya['nama_produk'] ?></td>
													<td><?= date('d M Y', strtotime($list_biaya['tgl_produksi'])) ?></td>
													<td><?= "Rp. " . number_format($dataSum['total_biaya_produksi'],0, ',' , '.') ?></td>
													<td><?= $list_biaya['stok_produk'] . " " . $list_biaya['satuan_stok_produk'] ?></td>
													<td>
														<?= "Rp. " . number_format($list_biaya['untung_produk'], 0, ',' , '.') ?>
														<?php
															if ($stokBarang != 0) {
																echo "
																	<a href='edit_untung.php?ip=$produksi_id&biaya_produksi=$total_biaya&stok=$stok_produk' class='lencana lencana-kuning'>
																		<i class='fa fa-edit'></i>
																	</a>
																";
															}
														?>
													</td>
													<td><?= "Rp. " . number_format($hargaSatuan, 0, ',' , '.') ?></td>
													<td class="background-hijau teks-putih"><?= "Rp. " . number_format($cuan, 0, ',' , '.') ?></td>
												</tr>
											</table>
											<i class="teks-mati">
												<b>* Estimasi Keuntungan Bersih</b> adalah keuntungan yang didapat jika semua barang telah laku terjual
											</i>
										</div>
									</div>
								</div>
							</div>

							<div class="kolom-50">
								<h2>Detail Bahan</h2>
								<?php
								if ($stokBarang != 0) {
									echo "
									<a href='edit_detail_produksi.php?ip=$produksi_id&page=produksi' class='tmbl tmbl-kuning float-left'>
										Edit Bahan
									</a>
									";
								}
								?>
								
							</div>

							<div class="kolom-100 margin-bottom-50">
								<div class="kolom-50-kiri">
									<div class="box-konten-radius backgorund-e7">
										<center>
											<div class="box-header-radius-80 background-biru teks-putih">
												<h2 class="text-center">Bahan Baku</h2>
											</div>
										</center>
										<div class="box-badan-konten">
											<div class="table-box">
												<table class="table-responsive">
													<tr class="thead-dark">
														<th>No</th>
														<th>Nama Bahan</th>
														<th>Qty</th>
														<th>Harga Satuan</th>
														<th>Sub Total</th>
													</tr>

													<?php
													
														$nomor = 1;
														$dataBahanBaku = "SELECT * FROM detail_produksi INNER JOIN produksi ON detail_produksi.produksi_id = produksi.id_produksi INNER JOIN bahan ON detail_produksi.bhn_id = bahan.id_bahan  WHERE produksi_id = '$ip' AND kategori = 'bahan baku' ";
														$query         = mysqli_query($host, $dataBahanBaku);
														while ($bahanBaku = mysqli_fetch_assoc($query) ) {

													?>
													<tr>
														<td><?= $nomor++ ?></td>
														<td><?= $bahanBaku['nama_bahan'] ?></td>
														<td><?= $bahanBaku['qty'] . " " .  $bahanBaku['satuan'] ?></td>
														<td><?= "Rp. " . number_format($bahanBaku['harga'], 0, ',' , '.') ?></td>
														<td><?= "Rp. " . number_format($bahanBaku['sub_total'], 0, ',' , '.') ?></td>
													</tr>
													<?php } ?>
												</table>
											</div>
										</div>
										<center>
											<div class="kolom-kalulasi-sementara margin-bottom-20">
												<div class="box-header-radius-80 background-hijau teks-putih padding-10">
													<?php

														$dataBahanBaku = "SELECT * FROM detail_produksi INNER JOIN produksi ON detail_produksi.produksi_id = produksi.id_produksi INNER JOIN bahan ON detail_produksi.bhn_id = bahan.id_bahan  WHERE produksi_id = '$ip' AND kategori = 'bahan baku' ";
														$query         = mysqli_query($host, $dataBahanBaku);
														$data          = mysqli_fetch_assoc($query);
														$kategori      = $data['kategori'];
														$nama_produk   = $data['nama_produk'];

														$sqlTotal   = mysqli_query($host, "SELECT SUM(sub_total) AS total_baku FROM detail_produksi INNER JOIN bahan ON detail_produksi.bhn_id = bahan.id_bahan  WHERE produksi_id = '$ip' AND kategori = 'bahan baku' ");
														$total      = mysqli_fetch_assoc($sqlTotal);

													?>

													Total
													<b> : <?= "Rp. " . number_format($total['total_baku'],0,',','.') ?></b>
												</div>
											</div>
										</center>
									</div>
								</div>
								<div class="kolom-50-kanan">
									<div class="box-konten-radius backgorund-e7">
										<center>
											<div class="box-header-radius-80 background-biru teks-putih">
												<h2 class="text-center">Bahan Jadi</h2>
											</div>
										</center>
										<div class="box-badan-konten">
											<div class="table-box">
												<table class="table-responsive">
													<tr class="thead-dark">
														<th>No</th>
														<th>Nama Bahan</th>
														<th>Qty</th>
														<th>Harga Satuan</th>
														<th>Sub Total</th>
													</tr>

													<?php
													
														$nomor = 1;
														$dataBahanBaku = "SELECT * FROM detail_produksi INNER JOIN produksi ON detail_produksi.produksi_id = produksi.id_produksi INNER JOIN bahan ON detail_produksi.bhn_id = bahan.id_bahan  WHERE produksi_id = '$ip' AND kategori = 'bahan jadi' ";
														$query         = mysqli_query($host, $dataBahanBaku);
														while ($bahanBaku = mysqli_fetch_assoc($query) ) {

													?>
													<tr>
														<td><?= $nomor++ ?></td>
														<td><?= $bahanBaku['nama_bahan'] ?></td>
														<td><?= $bahanBaku['qty'] . " " .  $bahanBaku['satuan'] ?></td>
														<td><?= "Rp. " . number_format($bahanBaku['harga'], 0, ',' , '.') ?></td>
														<td><?= "Rp. " . number_format($bahanBaku['sub_total'], 0, ',' , '.') ?></td>
													</tr>
													<?php } ?>
												</table>
											</div>
											<center>
												<div class="kolom-kalulasi-sementara">
													<div class="box-header-radius-80 background-hijau teks-putih padding-10">
														<?php

															$dataBahanBaku = "SELECT * FROM detail_produksi INNER JOIN produksi ON detail_produksi.produksi_id = produksi.id_produksi INNER JOIN bahan ON detail_produksi.bhn_id = bahan.id_bahan  WHERE produksi_id = '$ip' AND kategori = 'bahan jadi' ";
															$query         = mysqli_query($host, $dataBahanBaku);
															$data          = mysqli_fetch_assoc($query);
															$kategori      = $data['kategori'];
															$nama_produk   = $data['nama_produk'];
														
															$sqlTotal      = mysqli_query($host, "SELECT SUM(sub_total) AS total_jadi FROM detail_produksi INNER JOIN produksi ON detail_produksi.produksi_id = produksi.id_produksi INNER JOIN bahan ON detail_produksi.bhn_id = bahan.id_bahan  WHERE produksi_id = '$ip' AND kategori = 'bahan jadi' ");
															$total         = mysqli_fetch_assoc($sqlTotal);

														?>

														Total
														<b> : <?= "Rp. " . number_format($total['total_jadi'],0,',','.') ?></b>
													</div>
												</div>
											</center>
										</div>
									</div>
								</div>
							</div>

							<?php } ?>
						<!-- Cek Data & Tampilkan -->

						<!-- Cek Data Kosong -->
							<?php

								$ip = $_GET['ip'];

								//! CEK DATA WHERE ID 
								$cekData   =  "SELECT * FROM detail_produksi WHERE produksi_id = '$ip' "; 
								$queryData = mysqli_query($host, $cekData);
								$cekdId    = mysqli_num_rows($queryData);

								if ($cekdId == null) {

							?>
							<div class="kolom-100 margin-top-50 margin-bottom-100">

								<h2>Kalkulasi Biaya Produksi & Harga Jual</h2>
								<a href="produksi.php?id_produksi=<?php echo $ip ?>" class="tmbl tmbl-biru margin-20-0">
									Tambah Data Bahan
								</a>
								<div class="box-konten-radius backgorund-e7">
									<div class="box-badan-konten">
										<div class="table-box">
											<table class="table-responsive">
												<tr class="thead-dark">
													<th>Nama Produk</th>
													<th>Tanggal Produksi</th>
													<th>Biaya Produksi</th>
													<th>Stok Produk</th>
													<th>Keinginan Untung Per Item</th>
													<th>Harga Jual Per Item</th>
													<th>Estimasi Keuntungan Yang Didapat</th>
												</tr>
											</table>
											<p class="teks-center teks-mati">Data Belum Di isi</p>
										</div>
									</div>
								</div>
							</div>
							<?php }?>
						<!-- Cek Data Kosong -->

					</div>

					<a href="index.php?page=produksi" class="tmbl tmbl-abu-abu margin-20-0 margin-bottom-50">
						Kembali
					</a>

				</div>
			</section>
		</main>

	</body>
</html>
