

if(!empty($_GET['ket']) && $_GET['ket'] == 'bhn_baku'){
  // echo "BAHAN BAKU";
  $bhn_id = $_POST['bhn_id'];
  $qty = 1;
  $id_grup = $_GET['id_grup'];
  $produksi_id = '';

  //CEK QTY
  $sqlCek = mysqli_query($host, "SELECT * FROM temp WHERE bhn_id = '$bhn_id' AND id_grup = '$id_grup' ");
  $cekId = mysqli_num_rows($sqlCek);
  if($cekId != 0){
    $qtyAwal = mysqli_fetch_assoc($sqlCek);
    $qtyAkhir = $qtyAwal['qty']+$qty;
    $sql = mysqli_query($host, "UPDATE temp SET qty = '$qtyAkhir' WHERE bhn_id = '$bhn_id' AND id_grup = '$id_grup'");
  }else{
    $sql = mysqli_query($host, "INSERT INTO temp VALUES('','$id_grup','$bhn_id','$qty','$produksi_id')");
  }

  if($sql){
    echo "<script>window.location.href='../../frontend/produksi/index.php?id_grup=$id_grup'</script>";
  }else{
    echo "<script>alert('Operasi Gagal');window.location.href='../../frontend/produksi/index.php?id_grup=$id_grup'</script>";
  }
}
elseif(!empty($_GET['ket']) && $_GET['ket'] == 'bhn_jadi'){
  // echo "BAHAN JADI";
  $bhn_id = $_POST['bhn_id'];
  $qty = 1;
  $id_grup = $_GET['id_grup'];
  $produksi_id = '';
  //CEK QTY
  $sqlCek = mysqli_query($host, "SELECT * FROM temp WHERE bhn_id = '$bhn_id' AND id_grup = '$id_grup' ");
  $cekId = mysqli_num_rows($sqlCek);
  if($cekId != 0){
    $qtyAwal = mysqli_fetch_assoc($sqlCek);
    $qtyAkhir = $qtyAwal['qty']+$qty;
    $sql = mysqli_query($host, "UPDATE temp SET qty = '$qtyAkhir' WHERE bhn_id = '$bhn_id' AND id_grup = '$id_grup'");
  }else{
    $sql = mysqli_query($host, "INSERT INTO temp VALUES('','$id_grup','$bhn_id','$qty','$produksi_id')");
  }

  if($sql){
    echo "<script>window.location.href='../../frontend/produksi/index.php?id_grup=$id_grup'</script>";
  }else{
    echo "<script>alert('Operasi Gagal');window.location.href='../../frontend/produksi/index.php?id_grup=$id_grup'</script>";
  }
}

//proses simpan
elseif(!empty($_GET['type']) && $_GET['type'] == 'tambah_produk'){
  $nama_produk = $_POST['nama_produk'];
  $produksi_id = $_GET['id_grup'];

  //INSERT DATA ke tabel Produksi
  $sql = mysqli_query($host, "INSERT INTO produksi VALUES(0,'$produksi_id','$nama_produk')");
  //UPDATE DATA kolom produksi_id DI TABLE temp
  $sql = mysqli_query($host, "UPDATE temp SET produksi_id = '$produksi_id'");
  if($sql){
    echo "<script>window.location.href='../../beranda.php'</script>";
  }else{
    echo "<script>alert('Operasi Gagal');window.location.href='../../beranda.php'</script>";
  }
}

























<?php

  include '../../database/koneksi.php';

  // Simpan pra produksi
  if (isset($_POST['btnbuat'])) {
    
    $nama_produk = $_POST['nama_produk'];

    $insert_pra_produksi    = "INSERT INTO pra_produksi VALUES(0, '$nama_produk')";
    $query_pra_produksi     = mysqli_query($host, $insert_pra_produksi);

    // select get Id
    $select_pra_produksi    = mysqli_query($host, "SELECT * FROM pra_produksi");
    $list                   = mysqli_fetch_assoc($select_pra_produksi);
    $id_rencana_produksi    = $list['id_rencana_produksi'];

    if($query_pra_produksi ){
      echo "<script>window.location.href='../../frontend/produksi/index.php?id_rencana_produksi=$id_rencana_produksi'</script>";
    }else{
      echo "<script>alert('Operasi Gagal');window.location.href='../../frontend/produksi/index.php?id_grup=$id_grup'</script>";
    }
  }

  // Bahan Baku
  if (!empty($_GET['ket']) && $_GET['ket'] == 'bhn_baku' ) {

    $bhn_id               = $_POST['bhn_id'];
    $rencana_produksi_id  = $_GET['rencana_produksi_id'];
    $qty                  = 1;


    //! CEK QTY
    $sqlCek   = mysqli_query($host, "SELECT * FROM temp WHERE bhn_id = '$bhn_id' AND rencana_produksi_id = '$rencana_produksi_id' ");
    $cekId    = mysqli_num_rows($sqlCek);

    if ($cekId != 0) {

      //! Akan dijalankan jika ada data dengan id sesuai yang di dapat dari $cekId
      $qtyAwal   = mysqli_fetch_assoc($sqlCek); // menampilkan qty awal dari tabel temp
      $qtyAkhir  = $qtyAwal['qty'] + $qty;  // menambahkan qty jika data barang ada pada tabel temp

      //! Update Qty
      $sqlUpdate = "UPDATE temp SET qty = '$qtyAkhir' WHERE bhn_id = '$bhn_id' AND rencana_produksi_id = '$rencana_produksi_id' ";
      $query     = mysqli_query($host, $sqlUpdate);


    } else {
      //! Jika data tidak ditemukan, maka akan menambahkan data baru dalam table temp
      $sqlInsert  = "INSERT INTO temp VALUES('', '$rencana_produksi_id', '$bhn_id', '$qty')"; 
      $query      = mysqli_query($host, $sqlInsert);
    }

    if($query){
      echo "<script>window.location.href='../../frontend/produksi/index.php?id_rencana_produksi=$rencana_produksi_id'</script>";
    }else{
      echo "<script>alert('Operasi Gagal');window.location.href='../../frontend/produksi/index.php?id_rencana_produksi=$rencana_produksi_id'</script>";
    }
    
  }


   // Bahan Jadi
   if (!empty($_GET['ket']) && $_GET['ket'] == 'bhn_jadi' ) {

    $bhn_id               = $_POST['bhn_id'];
    $rencana_produksi_id  = $_GET['rencana_produksi_id'];
    $qty                  = 1;


    //! CEK QTY
    $sqlCek   = mysqli_query($host, "SELECT * FROM temp WHERE bhn_id = '$bhn_id' AND rencana_produksi_id = '$rencana_produksi_id' ");
    $cekId    = mysqli_num_rows($sqlCek);

    if ($cekId != 0) {

      //! Akan dijalankan jika ada data dengan id sesuai yang di dapat dari $cekId
      $qtyAwal   = mysqli_fetch_assoc($sqlCek); // menampilkan qty awal dari tabel temp
      $qtyAkhir  = $qtyAwal['qty'] + $qty;  // menambahkan qty jika data barang ada pada tabel temp

      //! Update Qty
      $sqlUpdate = "UPDATE temp SET qty = '$qtyAkhir' WHERE bhn_id = '$bhn_id' AND rencana_produksi_id = '$rencana_produksi_id' ";
      $query     = mysqli_query($host, $sqlUpdate);


    } else {
      //! Jika data tidak ditemukan, maka akan menambahkan data baru dalam table temp
      $sqlInsert  = "INSERT INTO temp VALUES('', '$rencana_produksi_id', '$bhn_id', '$qty')"; 
      $query      = mysqli_query($host, $sqlInsert);
    }

    if($query){
      echo "<script>window.location.href='../../frontend/produksi/index.php?id_rencana_produksi=$rencana_produksi_id'</script>";
    }else{
      echo "<script>alert('Operasi Gagal');window.location.href='../../frontend/produksi/index.php?id_rencana_produksi=$rencana_produksi_id'</script>";
    }
    
  }

?>
















































<!-- Paling Bner -->
<?php include '../../database/koneksi.php'; ?>
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
	<?php
		include '../layout/sidebar.php';
	?>
		<main class="main">
			<section>

				<h2>Produksi</h2>

				<div class="breadcrumb">
						<h3>
							<a href="../../beranda.php">Beranda</a> <i class="fa fa-angle-right"></i>
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
											$id_rencana_produksi  = $_GET['id_rencana_produksi'];

											$sql_produk  = mysqli_query($host, "SELECT * FROM pra_produksi WHERE id_rencana_produksi = '$id_rencana_produksi' ");
											$data_produk = mysqli_fetch_assoc($sql_produk); 
										?>
										<label>Nama Produk</label>
										<input type="text" name="" class="form" value="<?php echo$data_produk['nama_produk'] ?>" readonly>
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

													
													<form action="../../backend/temp/tambah_bahan.php?ket=bhn_baku&rencana_produksi_id=<?php echo $id_rencana_produksi ?>" method="POST">

														<label>Bahan Baku</label>
														<select name="bhn_id" class="form-radius">
															<?php
																$sql   = "SELECT * FROM bahan WHERE kategori = 'bahan baku'";
																$query = mysqli_query($host, $sql);
																while ($bhn_bku = mysqli_fetch_assoc($query) ) {
																
															?>
															
															<option value="<?php echo $bhn_bku['id_bahan']?>"><?php echo $bhn_bku['nama_bahan']; ?></option>

															<?php
																}                      
															?>
														</select>

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
													<form action="../../backend/temp/tambah_bahan.php?ket=bhn_jadi&rencana_produksi_id=<?php echo $id_rencana_produksi ?>" method="POST">

														<label>Bahan Jadi</label>
														<select name="bhn_id" class="form-radius">
															<?php
																$sql   = "SELECT * FROM bahan WHERE kategori = 'bahan jadi' ";
																$query = mysqli_query($host, $sql);
																while ($bhn_jdi = mysqli_fetch_assoc($query) ) {
																
															?>

															<option value="<?php echo $bhn_jdi['id_bahan']; ?>"><?php echo $bhn_jdi['nama_bahan']; ?></option>

															<?php
																}
															?>
														</select>

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
												$sql = "SELECT * FROM temp 
																INNER JOIN bahan ON temp.bhn_id = bahan.id_bahan 
																WHERE rencana_produksi_id = '$id_rencana_produksi'
																";
												$query = mysqli_query($host,$sql);

												while ($temp = mysqli_fetch_assoc($query)) {
													
											?>
										
											<tr>
												<td><?= $nomer++ ?></td>
												<td><?= $temp['nama_bahan'] ?></td>
												<td><?= $temp['kategori'] ?></td>
												<td>
													<?= $temp['qty'] ?>
													<a href="" class="teks-kuning">
														<i class="fa fa-edit color"> </i>
													</a>
												</td>
												<td><?= "Rp " . number_format($temp['harga'],0,',','.')  ?></td>
												<td><?= "Rp " . number_format($temp['sub_total'],0,',','.') ?></td>
												<td>
													<a href="" class="teks-merah">
														<i class="fa fa-trash"></i>
													</a>
												</td>
											</tr>
											<?php
												}											
											?>

										</table>

										<form action="../../backend/temp/tambah_bahan.php?rencana_produksi_id=<?php echo $id_rencana_produksi ?>" method="post">
											<input type="hidden" name="rencana_produksi_id" value="<?php echo $id_rencana_produksi ?>">
											<input type="submit" value="Simpan" class="tmbl tmbl-hijau margin-20-0" name="hapus_temp">
										</form>
										
									</div>

									<div class="kolom-kalulasi-sementara">
										<div class="box-header-radius-20 background-hijau teks-putih float-right margin-20-0">
											<?php
											
												$sqlTotal   = mysqli_query($host, "SELECT SUM(sub_total) AS total FROM temp");
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
