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
				<h2>Data Bahan Baku</h2>
				<div class="breadcrumb">
						<h3>
							<a href="../../../beranda.php?page=beranda">Beranda</a> <i class="fa fa-angle-right"></i>
							<a href="../index.php?page=bahan">Data Bahan</a> <i class="fa fa-angle-right"></i>
							<span class="akhir-link-breadcrumb">Data Bahan Baku</span>
						</h3>
				</div>

				<div class="container">
					<div class="baris">
						<div class="kolom-100 margin-bottom-100">

							<a href="index.php?page=databarang" class="tmbl tmbl-abu-abu margin-20-0">
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
									
								</div>

								<table class="table-responsive">
									<tr class="thead-dark">
										<th>No</th>
										<th>Nama Produk</th>
										<th>Tanggal Produksi</th>
										<th>Stok</th>
										<th>Aksi</th>
									</tr>

									<?php
									
										include '../../database/koneksi.php';

										//? Pagination
										// $halaman = 10;
										// $page    = isset($_GET["halaman"]) ? (int)$_GET["halaman"] :1;
										// $mulai   = ($page>1) ? ($page * $halaman) - $halaman : 0;
										// $result  = mysqli_query($host, "SELECT * FROM barang INNER JOIN produksi ON barang.produksi_id = produksi.id_produksi");
										// $total   = mysqli_num_rows($result);
										// $pages   = ceil($total/$halaman);

										//? Pencarian 
										if (isset($_POST['btncari']))  {
											$cari        = $_POST['cari'];
											$sql_cari    = "SELECT * FROM barang INNER JOIN produksi ON barang.produksi_id = produksi.id_produksi WHERE nama_barang LIKE '%".$cari."%' ";
											$query       = mysqli_query($host, $sql_cari);
										} else {

											$sql   = "SELECT * FROM barang ORDER BY nama_barang ASC";
											$query = mysqli_query($host, $sql);
										}
										
										$no  = 1;
										while ($data = mysqli_fetch_assoc($query) ) {
											
									?>
									
									<tr>
										<td><?php echo $no++;?></td>
										<td><?php echo $data['nama_barang']; ?></td>
										<td><?= date('d M Y', strtotime($data['tgl_produksi'])) ?></td>
										<td>
											<?php 
												if ($data['stok_barang'] >= 10) {
													echo number_format($data['stok_barang'],0,',','.') . " " . "<span class='lencana-radius lencana-hijau'>" . $data['satuan_stok_barang'] . "</span>" ;
												} elseif ($data['stok_barang'] >= 0) {
													echo "<span class='teks-merah'>" .  number_format($data['stok_barang'],0,',','.') . "</span>" . " " . "<span class='lencana-radius lencana-hijau'>" . $data['satuan_stok_barang'] . "</span>" ;
												} elseif ($data['stok_barang'] = 0) {
													echo "<span class='lencana-radius lencana-merah'>Stok Habis</span>";
												}
											?>
										</td>
										<td>
											<a onclick="return confirm('Anda yakin ingin menghapus data ?')" href="../../backend/data_barang/hapus.php?id_barang=<?php echo $data['id_barang']?>" class="tmbl tmbl-merah">
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
