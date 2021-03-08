<?php include '../../database/koneksi.php'; ?>
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

				<h2>Produksi</h2>

				<div class="breadcrumb">
						<h3>
							<a href="../../beranda.php?page=beranda">Beranda</a> <i class="fa fa-angle-right"></i>
							<span class="akhir-link-breadcrumb">Produksi</span>
						</h3>
				</div>

				<div class="container">

					<div class="baris">

						<div class="kolom-50-kiri">
								<center>
									<div class="box-header-radius background-biru teks-putih">
										<h2 class="text-center">Nama Produk</h2>
									</div>
								</center>

								<div class="box-konten-radius backgorund-e7 padding-20 margin-top-10">
									<form action="" method="POST">

										<?php
											$id_produksi  = $_GET['id_produksi'];

											$sql_produk  = mysqli_query($host, "SELECT * FROM produksi WHERE id_produksi = '$id_produksi' ");
											$data_produk = mysqli_fetch_assoc($sql_produk); 
										?>
										<label>Nama Produk</label>
										<input type="text" name="" class="form" value="<?php echo $data_produk['nama_produk'] ?>" readonly>

										<label>Estimasi Stok</label>
										<input type="text" name="" class="form" value="<?php echo $data_produk['stok_produk'] ?>" readonly>

										<label>Satuan</label>
										<input type="text" name="" class="form" value="<?php echo $data_produk['satuan_stok_produk'] ?>" readonly>

										<label>Keinginan Untung Per Item</label>
										<input type="text" name="" class="form" value="<?php echo "Rp. " . number_format($data_produk['untung_produk'],0,',','.') ?>" readonly>
									</form>
								</div>

						</div>

						<div class="kolom-100 margin-top-50 margin-bottom-50">
							<h2>Bahan Bahan</h2>
							
							<div class="kolom-50-kiri">
								<div class="box-konten-radius backgorund-e7">
									<center>
										<div class="box-header-radius-80 background-biru teks-putih">
											<h2 class="text-center">Bahan Baku</h2>
										</div>
									</center>

									<div class="box-badan-konten">
										<center>
											<button onclick="btn1()" id="BtnBaku" class="tmbl tmbl-biru margin-20-0">
												Tambah Bahan Baku
											</button>

											<!-- The Modal -->
											<div id="myModal1" class="modal">

												<!-- Modal content -->
												<div class="modal-content">
													<span class="close" id="close1" >
														<i class="fa fa-times"> </i>
													</span>
													<h2>Tambah Bahan Baku</h2>

													
													<form action="../../backend/produksi/edit_detail_produksi.php?ket=bhn_baku&id_produksi=<?php echo $id_produksi ?>" method="POST">

														<label>Bahan Baku</label>
														<select name="bhn_id" class="form-radius">
															<?php
																$sql   = "SELECT * FROM bahan WHERE kategori = 'bahan baku'";
																$query = mysqli_query($host, $sql);
																while ($bhn_bku = mysqli_fetch_assoc($query) ) {
																
															?>
															
															<option value="<?php echo $bhn_bku['id_bahan']?>">
																<?php echo $bhn_bku['nama_bahan'] . " --- " . $bhn_bku['satuan'] . " @" . "Rp " . number_format($bhn_bku['harga'],0,',','.') ?>
															</option>

															<?php
																}                      
															?>
														</select>

														<label>Jumlah</label>
														<input type="number" name="qty" class="form-radius" value="1">

														<button type="submit" name="bahan_baku" class="tmbl-radius tmbl-hijau margin-20-0">
															<i class="fa fa-plus fa-lg"></i>
														</button>
													</form>
												</div>

											</div>
										</center>
									</div>

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
										<center>
											<button onclick="btn2()" id="myBtn" class="tmbl tmbl-biru margin-20-0">
												Tambah Bahan Jadi
											</button>

											<!-- The Modal -->
											<div id="myModal2" class="modal">

												<!-- Modal content -->
												<div class="modal-content">
													<!-- <span class="close" id="close" >&times;</span> -->
													<span class="close" id="close2" >
														<i class="fa fa-times"> </i>
													</span>
													<h2>Tambah Bahan Jadi</h2>
													<form action="../../backend/produksi/edit_detail_produksi.php?ket=bhn_jadi&id_produksi=<?php echo $id_produksi ?>" method="POST">

														<label>Bahan Jadi</label>
														<select name="bhn_id" class="form-radius">
															<?php
																$sql   = "SELECT * FROM bahan WHERE kategori = 'bahan jadi' ";
																$query = mysqli_query($host, $sql);
																while ($bhn_jdi = mysqli_fetch_assoc($query) ) {
																
															?>

															<option value="<?php echo $bhn_jdi['id_bahan']; ?>"><?php echo $bhn_jdi['nama_bahan'] . " --- " . $bhn_jdi['satuan'] . " @" . "Rp " . number_format($bhn_jdi['harga'],0,',','.') ?></option>

															<?php
																}
															?>
														</select>

														<label>Jumlah</label>
														<input type="number" name="jumlah_qty" class="form-radius" value="1">

														<button type="submit" name="simpan_bhn_jadi" class="tmbl-radius tmbl-hijau margin-20-0">
															<i class="fa fa-plus fa-lg"></i>
														</button>
													</form>
												</div>

											</div>
										</center>
									</div>

								</div>


							</div>

						</div>

						<div class="kolom-100 margin-top-50 margin-bottom-100">

							<h2>Kalkulasi Sementara Biaya Produksi</h2>
							<div class="box-konten-radius backgorund-e7">
								<div class="box-badan-konten">

									<div class="table-box">
										<table class="table-responsive">
											<tr class="thead-dark">
												<th>No</th>
												<th>Nama Bahan</th>
												<th>Kategori</th>
												<th>Qty</th>
												<th>Harga Satuan</th>
												<th>Sub Total</th>
												<th>Aksi</th>
											</tr>

											<?php
											
												$nomer = 1;
												$sql = "SELECT * FROM detail_produksi INNER JOIN bahan ON detail_produksi.bhn_id = bahan.id_bahan WHERE produksi_id = '$id_produksi' ORDER BY nama_bahan  ";
												$query = mysqli_query($host,$sql);

												while ($dt = mysqli_fetch_assoc($query)) {

											?>

											<tr>
												<td><?= $nomer++ ?></td>
												<td><?= $dt['nama_bahan'] ?></td>
												<td><?= $dt['kategori'] ?></td>
												<td>
													<?= $dt['qty'] . " " . $dt['satuan'] ?>
													<a href="edit_qty_detail_produksi.php?id_detail_produksi=<?php echo $dt['id_detail_produksi']?>&produksi_id=<?php echo $id_produksi ?>&bhn_id=<?php echo $dt['bhn_id']?>" class="lencana lencana-kuning">
														<i class="fa fa-edit"></i>
													</a>
												</td>
												<td><?= "Rp " . number_format($dt['harga'],0,',','.')  ?></td>
												<td><?= "Rp " . number_format($dt['sub_total'],0,',','.') ?></td>
												<td>
													<a onclick="return confirm('Anda yakin ingin hapus item ?')" href="../../backend/produksi/hapus_item_detail_produksi.php?id_detail_produksi=<?php echo $dt['id_detail_produksi']?>&produksi_id=<?php echo $id_produksi ?>" class="teks-merah">
														<i class="fa fa-trash"></i>
													</a>
												</td>
											</tr>

											<?php
												}											
											?>

										</table>

                    <a href="detail_produksi.php?id_produksi=<?php echo $id_produksi ?>&page=produksi" class="tmbl tmbl-hijau margin-20-0">
                      Simpan
                    </a>

									</div>

									<div class="kolom-kalulasi-sementara">
										<div class="box-header-radius-20 background-hijau teks-putih float-right margin-20-0">
											<?php
											
												$sqlTotal   = mysqli_query($host, "SELECT SUM(sub_total) AS total FROM detail_produksi WHERE produksi_id = '$id_produksi' ");
												$total      = mysqli_fetch_assoc($sqlTotal);

											?>

											Total
											<b> : <?= "Rp " . number_format($total['total'],0,',','.') ?></b>
										</div>
									</div>

								</div>

							</div>

						</div>

					</div>

				</div>

			</section>

		</main>

		<script>
			// Get the modal
			var modal1 = document.getElementById("myModal1");
			var modal2 = document.getElementById("myModal2");
			var modal3 = document.getElementById("myModal3");
			// Get the <span> element that closes the modal
			var close1 = document.getElementById("close1");
			var close2 = document.getElementById("close2");
			var close3 = document.getElementById("close3");

			function btn1(){
				modal1.style.display = "block";
			}
			function btn2(){
				modal2.style.display = "block";
			}
			function btn3(){
				modal3.style.display = "block";
			}
			
			//TOMBOL CLOSE
			close1.onclick = function() {
				modal1.style.display = "none";
			}
			close2.onclick = function() {
				modal2.style.display = "none";
			}
			close3.onclick = function() {
				modal3.style.display = "none";
			}
		</script>

	</body>
</html>
