<?php
	session_start();

	if ($_SESSION['level'] != 'admin') {
		header("location:../../login.php?pesan=bukanadmin");
	}

?>
<!DOCTYPE html>
<html lang="pt-BR">
	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<title>Monitoring Biaya Produksi | Laporan</title>

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
		include '../../frontend/layout/sidebar.php';
	?>
		<main class="main">
			<section>
				<h2>Monitoring Biaya Produksi</h2>
				<h3>Laporan Barang Keluar</h3>
				<div class="breadcrumb">
          <h3>
						<a href="../../beranda.php?page=beranda">Beranda</a> <i class="fa fa-angle-right"></i>
						<span class="akhir-link-breadcrumb">Data Laporan Barang Keluar</span>
					</h3>
				</div>

				<div class="container margin-bottom-100">
					<div class="baris baris-tengah">
            <div class="kolom-50">
              <div class="box-konten-radius padding-20 backgorund-e7">
                <center>
                  <div class="box-header-radius-80 background-biru teks-putih margin-bottom-50">
                    <h3>Tampilkan Laporan Berdasarkan Tanggal</h3>
                  </div>
                </center>

                <!-- Trigger/Open The Modal -->
                <center>
                  <button id="myBtn" class="tmbl tmbl-abu-abu">Pilih Tanggal</button>
                </center>

                <!-- The Modal -->
                <div id="myModal" class="modal">
                  <!-- Modal content -->
                  <div class="modal-content">
                    <span class="close">&times;</span>
                    <h2 class="text-center">Tentukan Tanggal</h2>

                    <div class="form-box-clear">
                      <form action="laporan_per_tanggal.php?page=laporan" method="POST">
                        <label>Tanggal Awal</label>
                        <input type="date" name="tgl_awal" class="form-radius">

                        <label>Tanggal Akhir</label>
                        <input type="date" name="tgl_akhir" class="form-radius">

                        <input type="submit" name="tampil_dari_tanggal" value="Tampilkan" class="tmbl tmbl-biru">
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="kolom-100 margin-top-50">
              <a target="blank" href="cetak_excel.php" class="tmbl tmbl-hijau margin-20-0">
              <i class="fa fa-file-excel"></i>
              </a>
              <div class="table-box">
                <table class="table-responsive">
                  <tr class="thead-dark">
                    <th>No</th>
                    <th>Tanggal Pembelian</th>
                    <th>Nomor Nota</th>
                    <th>Petugas Kasir</th>
                    <th>Aksi</th>
                  </tr>

                  <?php

                    //? Pagination
										$halaman = 15;
										$page    = isset($_GET["halaman"]) ? (int)$_GET["halaman"] :1;
										$mulai   = ($page>1) ? ($page * $halaman) - $halaman : 0;
										$result  = mysqli_query($host, "SELECT * FROM laporan_brg_keluar");
										$total   = mysqli_num_rows($result);
										$pages   = ceil($total/$halaman);

                    $no                 = 1;
                    $sqlSelectLaporan   = "SELECT * FROM laporan_brg_keluar";
                    $querySelectLaporan = mysqli_query($host, $sqlSelectLaporan);
                    while ($dataLaporan = mysqli_fetch_assoc($querySelectLaporan)) {

                  ?>
                  <tr>
                    <td><?= $no++ ?></td>
                    <td><?= date('d M Y', strtotime($dataLaporan['tgl_laporan']))  ?></td>
                    <td><?= $dataLaporan['nomor_transaksi'] ?></td>
                    <td><?= $dataLaporan['petugas_kasir'] ?></td>
                    <td>
                      <a href="detail_laporan.php?Tr=<?= $dataLaporan['nomor_transaksi'] ?>&page=laporan" class="tmbl tmbl-biru">
                        <i class="fa fa-eye"></i>
                      </a>
                      <a target="blank" href="cetak_nota.php?Tr=<?php echo $dataLaporan['nomor_transaksi']?>" class="tmbl tmbl-merah">
                        <i class="fa fa-file-pdf"></i>
                      </a>
                    </td>
                  </tr>
                  <?php } ?>
                </table>
              </div>
              <div class="penomoran">

								<?php
									for ($i=1; $i <= $pages ; $i++) { 

								?>
									<a href="?halaman=<?php echo $i; ?>&page=laporan" class="tmbl tmbl-abu-abu margin-20-0">
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
