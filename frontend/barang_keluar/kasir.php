<?php include '../../database/koneksi.php';  ?>
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

				<div class="container margin-bottom-100">
					<div class="baris">

            <div class="kolom-50 margin-bottom-50">

              <?php
              
                $Tr    = $_GET['Tr'];

                $sql           = "SELECT * FROM transaksi WHERE no_transaksi = '$Tr' ";
                $query         = mysqli_query($host, $sql);
                $detailDataTr  = mysqli_fetch_assoc($query); 
              
              ?>

              <div class="form-box-clear">
                <center>
                  <div class="box-header-radius margin-bottom-20 background-biru teks-putih">
                    <h2>Data Transaksi</h2>
                  </div>
                </center>
                <form>

                  <label>Nomor Transaksi</label>
                  <input type="text" class="form background-hijau teks-putih" value="<?= $detailDataTr['no_transaksi'] ?>" readonly>

                  <label>Nama Pembeli</label>
                  <input type="text" class="form" value="<?= $detailDataTr['nama_pembeli'] ?>" readonly>

                  <label>Keterangan</label>
                  <textarea class="form textarea-no-resize" rows="5" readonly><?= $detailDataTr['keterangan'] ?></textarea>

                  <label>Nama Petugas Kasir</label>
                  <input type="text" class="form" value="<?= $detailDataTr['nama_kasir'] ?>" readonly>
                </form>
              </div>

              <div class="box-konten-radius backgorund-e7">
                <center>
                  <div class="box-header-radius-80 background-hijau teks-putih">
                    <h2>Barang</h2>
                  </div>
                </center>

                <!-- Trigger/Open The Modal -->
                <center>
                  <button id="myBtn" class="tmbl tmbl-hijau margin-20-0">
                    <i class="fa fa-plus"></i>
                  </button>
                </center>

                <!-- The Modal -->
                <div id="myModal" class="modal">

                  <!-- Modal content -->
                  <div class="modal-content">
                    <span class="close">
                      <i class="fa fa-times"></i>
                    </span>
                    <h2 class="teks-center">Daftar Barang</h2>

                      <form action="../../backend/barang_keluar/tambah.php?Tr=<?= $Tr ?>" method="POST">
                        <label>Nama Barang</label>
                        <select name="barang_id" class="form-radius">
                          <?php
                        
                            $sql   = "SELECT * FROM barang";
                            $query = mysqli_query($host, $sql);
                            while ($listBarang = mysqli_fetch_assoc($query) ) {

                          ?>
                            <option value="<?= $listBarang['id_barang'] ?>"><?= $listBarang['nama_barang'] ?></option>
                          <?php } ?>

                        </select>

                        <label>Qty</label>
                        <input type="number" name="jumlah_qty" class="form-radius" value="1">


                        <input type="submit" name="simpan_barang" class="tmbl-radius tmbl-hijau margin-20-0" value="Simpan">
                      </form>

                  </div>

                </div>
              </div>

            </div>


						<div class="kolom-100">

							<div class="table-box">


								<table class="table-responsive">
									<tr class="thead-dark">
										<th>No</th>
										<th>Nama Barang</th>
										<th>Qty</th>
										<th>Harga Satuan</th>
										<th>Sub Total</th>
										<th>Aksi</th>
									</tr>

									<?php
                  
                    $no       = 1;
                    $sqlData  = "SELECT * FROM kasir INNER JOIN barang ON kasir.barang_id = barang.id_barang WHERE nomor_tr  = '$Tr' ORDER BY nama_barang ASC ";
                    $query    = mysqli_query($host, $sqlData);
                    while ($dataProduk  = mysqli_fetch_assoc($query) ) {

                  ?>

                  <tr>
                    <td><?php echo $no++ ?></td>
                    <td><?php echo $dataProduk['nama_barang'] ?></td>
                    <td><?php echo $dataProduk['qty'] . " " . $dataProduk['satuan_stok_barang'] ?></td>
                    <td><?php echo "@ " . "Rp. " . number_format($dataProduk['harga_jual_item'],0,',','.') ?></td>
                    <td><?php echo "Rp. " . number_format($dataProduk['sub_total_kasir'],0,',','.') ?></td>
                    <td>
                      <a onclick="return confirm('Yakin nih mau di hapus ?')" href="">
                        <i class="fa fa-trash teks-merah"></i>
                      </a>
                    </td>
                  </tr>

                  <?php } ?>
								</table>

                <form action="../../backend/temp/hapus_temp.php" method="post">
                  <input type="submit" value="Simpan" class="tmbl tmbl-hijau margin-20-0" name="hapus_temp">
                </form>

							</div>

              <div class="kolom-kalulasi-sementara">
                <div class="box-header-radius-20 background-hijau teks-putih float-right margin-20-0">
                  <?php
                  
                    $sqlTotal   = "SELECT SUM(sub_total_kasir) AS total FROM kasir";
                    $queryTotal = mysqli_query($host, $sqlTotal);
                    $total      = mysqli_fetch_assoc($queryTotal);

                  ?>

                  Total
                  <b> : <?= "Rp " . number_format($total['total'],0,',','.') ?></b>
                  <!-- <b> : Rp. 250.000</b> -->
                </div>
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