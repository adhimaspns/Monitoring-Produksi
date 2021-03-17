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
		<link rel="stylesheet" href="../../assets/css/main.css" />
		<link rel="stylesheet" href="../../assets/css/style.css" />
		<link rel="stylesheet" href="../../assets/css/sidebar.css" />
	</head>
	<body>
	<?php
		include '../../database/koneksi.php';
		include '../layout/sidebar.php';
	?>
		<main class="main">
			<section>
				<h2>Barang Keluar</h2>
				<div class="breadcrumb">
            <h3>
							<a href="../../beranda.php?page=beranda">Beranda</a> <i class="fa fa-angle-right"></i>
							<span class="akhir-link-breadcrumb">Barang Keluar</span>
						</h3>
				</div>

				<div class="container">
					<div class="baris">
						<div class="kolom-100">

              <!-- Trigger/Open The Modal -->
              <button id="myBtn" class="tmbl tmbl-biru margin-20-0">
                <i class="fa fa-plus"></i> Barang Keluar
              </button>

              <!-- The Modal -->
              <div id="myModal" class="modal">

                <!-- Modal content -->
                <div class="modal-content">
                  <span class="close">
                    <i class="fa fa-times"></i>
                  </span>
                  <h2 class="teks-center">Data Barang Keluar</h2>

                    <form action="../../backend/barang_keluar/tambah.php" method="POST">
                      <label>Nama Pembeli</label>
                      <input type="text" name="nama_pembeli" class="form-radius" placeholder="Cth : Bambang Putro Aji" required>

                      <label>Keterangan</label>
                      <textarea name="keterangan_transaksi" class="form-radius textarea-no-resize" placeholder="Tambahkan Keterangan" required></textarea>

                      <label>Nama Pegawai Kasir</label>
                      <input type="text" name="nama_kasir" class="form-radius" placeholder="Cth : Adhimas Putra" required>

                      <input type="submit" name="simpan_tr" class="tmbl-radius tmbl-biru margin-20-0" value="Simpan">
                    </form>

                </div>

              </div>

							<div class="table-box">

								<!-- <div class="kolom-20 float-left">
									<?php
										if (isset($_GET['cari'])) {
											$cari = $_GET['cari'];

											echo "<b> Hasil Pencarian : " .$cari. "</b>";
										}
									
									?>
								</div> -->

								<!-- <div class="kolom-20 float-right margin-20-0">
									
									<form action="cari.php?page=databarang" method="post">	
										<label>Carikan</label>
										<input type="text" name="cari" class="form" placeholder="Ketikan Sesuatu..."> 
										
										<input type="submit" name="btncari" value="Cari" class="tmbl tmbl-hijau">
									</form>
								</div> -->


								<table class="table-responsive">
									<tr class="thead-dark">
										<th>No</th>
										<th>Tanggal Transaksi</th>
										<th>No Transaksi</th>
										<th>Pembeli</th>
										<th>Keterangan</th>
										<th>Aksi</th>
									</tr>

									<?php

										//? Pagination
										// $halaman = 10;
										// $page    = isset($_GET["halaman"]) ? (int)$_GET["halaman"] :1;
										// $mulai   = ($page>1) ? ($page * $halaman) - $halaman : 0;
										// $result  = mysqli_query($host, "SELECT * FROM bahan WHERE kategori = 'bahan baku'");
										// $total   = mysqli_num_rows($result);
										// $pages   = ceil($total/$halaman);

										$no    = 1;
										$sql   = "SELECT * FROM barang INNER JOIN produksi ON barang.produksi_id = produksi.id_produksi ORDER BY nama_barang ASC";
										$query = mysqli_query($host, $sql);

										while ($data = mysqli_fetch_assoc($query) ) {

									?>
									<tr>
										<!-- <td><?= $no++ ?></td>
										<td><?= $data['nama_barang'] ?></td>
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
										</td> -->
									</tr>
									<?php } ?>
								</table>
							</div>

							<!-- <div class="penomoran">

								<?php
									for ($i=1; $i <= $pages ; $i++) { 

								?>
									<a href="?halaman=<?php echo $i; ?>&page=databarang" class="tmbl tmbl-abu-abu margin-20-0">
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
							</div> -->

						</div>

							
					</div>
				</div>

				
      </section>

		</main>

    <!-- Javascript -->
    <script>
      // Get the modal
      var modal = document.getElementById("myModal");

      // Get the button that opens the modal
      var btn = document.getElementById("myBtn");

      // Get the <span> element that closes the modal
      var span = document.getElementsByClassName("close")[0];

      // When the user clicks the button, open the modal 
      btn.onclick = function() {
        modal.style.display = "block";
      }

      // When the user clicks on <span> (x), close the modal
      span.onclick = function() {
        modal.style.display = "none";
      }

      // When the user clicks anywhere outside of the modal, close it
      window.onclick = function(event) {
        if (event.target == modal) {
          modal.style.display = "none";
        }
      }
    </script>

	</body>
</html>