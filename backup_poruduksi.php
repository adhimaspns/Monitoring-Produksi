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

		<aside class="sidebar">
			<nav>
				<ul class="sidebar__nav">
					<li>
						<a href="../../beranda.php" class="sidebar__nav__link">
							<i class="fa fa-home"></i>
							<span class="sidebar__nav__text">Beranda</span>
						</a>
					</li>
					<li>
						<a href="../bahan_baku/index.php" class="sidebar__nav__link">
							<i class="fas fa-archive"></i>
							<span class="sidebar__nav__text">Bahan Baku</span>
						</a>
					</li>
					<li>
						<a href="index.php" class="sidebar__nav__link">
							<i class="fas fa-people-carry"></i>
							<span class="sidebar__nav__text">Bahan Jadi</span>
						</a>
					</li>
					<li>
						<a href="#" class="sidebar__nav__link sidebar-active">
							<i class="fas fa-hammer"></i>
							<span class="sidebar__nav__text">Produksi</span>
						</a>
					</li>
					<li>
						<a onclick="return confirm('Anda yakin ingin logout ?')" href="#" class="sidebar__nav__link link-lgout">
							<i class="fas fa-user"></i>
							<span class="sidebar__nav__text">Logout</span>
						</a>
					</li>
				</ul>
			</nav>
		</aside>

		<main class="main">
			<section>

				<h2>Produksi</h2>

				<div class="breadcrumb">
						<h3>
							<a href="../../beranda.php">Beranda</a> <i class="fa fa-angle-right"></i>
							<span class="akhir-link-breadcrumb">Data Bahan Jadi</span>
						</h3>
				</div>

				<div class="container">
					<div class="baris baris-tengah">

						<div class="kolom-50">
							<div class="box-konten-radius backgorund-e7">
								<center>
									<div class="box-header-radius background-biru teks-putih">
										<h2 class="text-center">Bahan Baku</h2>
									</div>
								</center>

								<div class="box-badan-konten">
									<form action="" method="">

										<label>Bahan Baku</label>
										<select name="" class="form-radius">
                      <?php
                        include '../../database/koneksi.php';
                        $sql   = "SELECT * FROM bhn_baku";
                        $query = mysqli_query($host, $sql);
                        while ($bhn_bku = mysqli_fetch_assoc($query) ) {
                        
                      ?>
                      
											<option value=""><?php echo $bhn_bku['nama_bhn_baku']; ?></option>

                      <?php
                        }                      
                      ?>
										</select>

										<button type="submit" name="" class="tmbl-radius tmbl-hijau float-right margin-20-0">
											<i class="fa fa-plus fa-lg"></i>
										</button>
									</form>
								</div>

							</div>
						</div>

						<div class="kolom-50">
							<div class="box-konten-radius backgorund-e7">
								<center>
									<div class="box-header-radius background-biru teks-putih">
										<h2 class="text-center">Bahan Jadi</h2>
									</div>
								</center>

								<div class="box-badan-konten">
									<form action="" method="">

										<label>Bahan Jadi</label>
										<select name="" class="form-radius">
                      <?php
                        include '../../database/koneksi.php';
                        $sql   = "SELECT * FROM bhn_jadi";
                        $query = mysqli_query($host, $sql);
                        while ($bhn_jdi = mysqli_fetch_assoc($query) ) {
                        
                      ?>

											<option value=""><?php echo $bhn_jdi['nama_bhn_jadi']; ?></option>

                      <?php
                        }
                      ?>
										</select>

										<button type="submit" name="" class="tmbl-radius tmbl-hijau float-right margin-20-0">
											<i class="fa fa-plus fa-lg"></i>
										</button>
									</form>
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
												<th>Nama Produk</th>
												<th>Nama Item</th>
												<th>Qty</th>
												<th>Harga Satuan</th>
												<th>Sub Total</th>
												<th>Aksi</th>
											</tr>

											<tr>
												<td>1</td>
												<td>Cowek</td>
												<td>Tanah Liat</td>
												<td>
                          1
                          <a href="">
														<i class="fa fa-edit"></i>
													</a>
												</td>
												<td>Rp. 200.000</td>
												<td>Rp. 200.000</td>
												<td>
													<a href="">
														<i class="fa fa-trash"></i>
													</a>
												</td>
											</tr>

											<tr>
												<td>2</td>
												<td>Layah Bolong</td>
												<td>Kayu Bakar</td>
												<td>
													4
													<a href="">
														<i class="fa fa-edit"></i>
													</a>
												</td>
												<td>Rp. 15.000</td>
												<td>Rp. 60.000</td>
												<td>
													<a href="">
														<i class="fa fa-trash"></i>
													</a>
												</td>
											</tr>

										</table>
									</div>

									<div class="kolom-kalulasi-sementara">
										<div class="box-header-radius-20 background-hijau teks-putih float-right margin-20-0">
											Total
											<b> : Rp. 1.500.0000</b>
										</div>
									</div>
								</div>

							</div>

						</div>

					</div>
				</div>

			</section>

		</main>

	</body>
</html>
