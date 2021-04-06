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
		<title>Monitoring Biaya Produksi | Kasir</title>

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
	?>

    <aside class="sidebar">
      <nav>
        <ul class="sidebar__nav">
          <li>
            <a onclick="return confirm('Anda punya perubahan yang belum disimpan, Anda yakin hendak meninggalkan halaman ini?')" href="/Monitoring/beranda.php?page=beranda" class="sidebar__nav__link <?php if($_GET['page'] == 'beranda'){  ?>sidebar-active <?php }?>">
              <i class="fa fa-home"></i>
              <span class="sidebar__nav__text">Beranda</span>
            </a>
          </li>
          <li>
            <a onclick="return confirm('Anda punya perubahan yang belum disimpan, Anda yakin hendak meninggalkan halaman ini?')" href="/Monitoring/frontend/bahan/index.php?page=bahan" class="sidebar__nav__link <?php if($_GET['page'] == 'bahan'){  ?>sidebar-active <?php } ?>">
              <i class="fas fa-archive"></i>
              <span class="sidebar__nav__text">Data Bahan</span>
            </a>
          </li>
          <li>
            <a onclick="return confirm('Anda punya perubahan yang belum disimpan, Anda yakin hendak meninggalkan halaman ini?')" href="/Monitoring/frontend/produksi/index.php?page=produksi" class="sidebar__nav__link <?php if($_GET['page'] == 'produksi'){  ?>sidebar-active <?php } ?>">
              <i class="fas fa-hammer"></i>
              <span class="sidebar__nav__text">Produksi</span>
            </a>
          </li>
          <li>
            <a onclick="return confirm('Anda punya perubahan yang belum disimpan, Anda yakin hendak meninggalkan halaman ini?')" href="/Monitoring/frontend/data_barang/index.php?page=databarang" class="sidebar__nav__link <?php if($_GET['page'] == 'databarang'){  ?>sidebar-active <?php } ?>">
              <i class="fas fa-box"></i>
              <span class="sidebar__nav__text">Data Barang</span>
            </a>
          </li>
          <li>
            <a onclick="return confirm('Anda punya perubahan yang belum disimpan, Anda yakin hendak meninggalkan halaman ini?')" href="/Monitoring/frontend/barang_keluar/index.php?page=barangkeluar" class="sidebar__nav__link <?php if($_GET['page'] == 'barangkeluar'){  ?>sidebar-active <?php } ?>">
              <i class="fas fa-shopping-cart"></i>
              <span class="sidebar__nav__text">Barang Keluar</span>
            </a>
          </li>
          <li>
            <a onclick="return confirm('Anda punya perubahan yang belum disimpan, Anda yakin hendak meninggalkan halaman ini?')" href="/Monitoring/frontend/laporan/index.php?page=laporan" class="sidebar__nav__link <?php if($_GET['page'] == 'laporan'){  ?>sidebar-active <?php } ?>">
              <i class="fas fa-clipboard"></i>
              <span class="sidebar__nav__text">Laporan</span>
            </a>
          </li>
          <li>
            <a onclick="return confirm('Anda punya perubahan yang belum disimpan, Anda yakin hendak meninggalkan halaman ini?')" href="#" class="sidebar__nav__link link-lgout">
              <i class="fas fa-user"></i>
              <span class="sidebar__nav__text">Logout</span>
            </a>
          </li>
        </ul>
      </nav>
    </aside>

		<main class="main">
			<section>
        <h2>Monitoring Biaya Produksi</h2>
				<h3>Barang Keluar</h3>
				<div class="breadcrumb">
          <h3>
            <a onclick="return confirm('Anda punya perubahan yang belum disimpan, Anda yakin hendak meninggalkan halaman ini?')" href="../../beranda.php?page=beranda">Beranda</a> <i class="fa fa-angle-right"></i>
            <a onclick="return confirm('Anda punya perubahan yang belum disimpan, Anda yakin hendak meninggalkan halaman ini?')" href="../../beranda.php?page=beranda">Barang Keluar</a> <i class="fa fa-angle-right"></i>
            <span class="akhir-link-breadcrumb">Kasir</span>
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

                //! Select Data Selain Data Transaksi Saat Ini
                $selectData      = "SELECT * FROM kasir WHERE NOT nomor_tr = '$Tr' ";
                $queryData       = mysqli_query($host, $selectData);
                $cekData         = mysqli_num_rows($queryData);

                //! Jika Ada Data Pada Tabel Kasir Selain Nomor Transaksi Saat Ini, Maka Hapus
                if ($cekData != 0) {

                  //! Hapus Multi Data 
                  while ($Data = mysqli_fetch_assoc($queryData)) {

                    $nmrTrs     = $Data['nomor_tr'];
                    $barang_id  = $Data['barang_id'];
                    $qtyKasir   = $Data['qty'];

                    //! Select Qty Where $barang_id
                    $sqlStokBrg   = "SELECT stok_barang FROM barang WHERE id_barang = '$barang_id' ";
                    $queryStokBrg = mysqli_query($host, $sqlStokBrg);
                    $dataStok     = mysqli_fetch_assoc($queryStokBrg);
                    $stokBarang   = $dataStok['stok_barang'];

                    //! Aritmatika Pengembalian stok
                    $stokKembali  = $stokBarang + $qtyKasir;

                    //! Update Stok Barang Where $barang_id
                    $sqlUpdateStokBrg  = "UPDATE barang SET stok_barang = '$stokKembali' WHERE id_barang = '$barang_id' ";
                    $queryUpdateBrg    = mysqli_query($host, $sqlUpdateStokBrg);
                    
                    //! Hapus Data Transaksi (belum di selesaikan) Where $nmrTrs

                      //! Hapus Data Kasir 
                      $sqlHpusKasir   = "DELETE FROM kasir WHERE nomor_tr = '$nmrTrs' ";
                      $queryHpusKasir = mysqli_query($host, $sqlHpusKasir);
                    
                      //! Hapus Data Detail Transaksi 
                      $sqlHpusDetail    = "DELETE FROM detail_transaksi WHERE nomor_tr = '$nmrTrs' ";
                      $queryHpusDetail  = mysqli_query($host, $sqlHpusDetail);

                      //! Hapus Data Transaksi
                      $sqlHpusTransaksi     = "DELETE FROM transaksi WHERE no_transaksi  = '$nmrTrs' "; 
                      $queryHpusTransaksi   = mysqli_query($host, $sqlHpusTransaksi);
                  }
                }
              ?>

              <div class="form-box-clear">
                <center>
                  <div class="box-header-radius margin-bottom-20 background-biru teks-putih">
                    <h2>Data Transaksi</h2>
                  </div>
                </center>

                <form class="margin-bottom-50">
                  <label>Nomor Transaksi</label>
                  <input type="text" class="form background-hijau teks-putih" value="<?= $detailDataTr['no_transaksi'] ?>" readonly>

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
                        
                            $sql   = "SELECT * FROM barang WHERE stok_barang != 0";
                            $query = mysqli_query($host, $sql);
                            while ($listBarang = mysqli_fetch_assoc($query) ) {

                          ?>
                            <option value="<?= $listBarang['id_barang'] ?>"><?= $listBarang['nama_barang'] . " | " . " Stok : " . $listBarang['stok_barang'] . " | " ?><?= "@" . "Rp. " . number_format($listBarang['harga_jual_item'],0,',','.') ?></option>
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
                    $sqlData  = "SELECT * FROM kasir INNER JOIN barang ON kasir.barang_id = barang.id_barang WHERE nomor_tr  = '$Tr' AND qty != 0 ORDER BY nama_barang ASC ";
                    $query    = mysqli_query($host, $sqlData);
                    while ($dataProduk  = mysqli_fetch_assoc($query) ) {

                  ?>

                  <tr>
                    <td><?php echo $no++ ?></td>
                    <td><?php echo $dataProduk['nama_barang'] ?></td>
                    <td>
                      <a href="qty_kurang.php?i=<?php echo $dataProduk['id_kasir']?>&Tr=<?php echo $Tr ?>&b=<?php echo $dataProduk['id_barang'] ?>">
                        <i class="fa fa-minus-square teks-kuning"></i>
                      </a>
                      <?php echo $dataProduk['qty'] . " " . $dataProduk['satuan_stok_barang'] ?>
                      <a href="qty_tambah.php?i=<?php echo $dataProduk['id_kasir']?>&Tr=<?php echo $Tr ?>&b=<?php echo $dataProduk['id_barang'] ?>">
                        <i class="fa fa-plus-square teks-biru"></i>
                      </a>
                    </td>
                    <td><?php echo "@ " . "Rp. " . number_format($dataProduk['harga_jual_item'],0,',','.') ?></td>
                    <td><?php echo "Rp. " . number_format($dataProduk['sub_total_kasir'],0,',','.') ?></td>
                    <td>
                      <a onclick="return confirm('Yakin nih mau di hapus ?')" href="../../backend/barang_keluar/hapus_item_barang.php?i=<?php echo $dataProduk['id_kasir']?>&Tr=<?php echo $Tr ?>&b=<?php echo $dataProduk['id_barang'] ?>">
                        <i class="fa fa-trash teks-merah"></i>
                      </a>
                    </td>
                  </tr>

                  <?php } ?>
								</table>
							</div>
              <div class="kolom-kalulasi-sementara">
                <div class="box-header-radius-20 background-hijau teks-putih float-right margin-20-0">
                  <?php
                    //! Sum Sub Total 
                    $sqlTotal   = "SELECT SUM(sub_total_kasir) AS total FROM kasir  WHERE nomor_tr = '$Tr' ";
                    $queryTotal = mysqli_query($host, $sqlTotal);
                    $total      = mysqli_fetch_assoc($queryTotal);
                  ?>

                  Total
                  <b> : <?= "Rp " . number_format($total['total'],0,',','.') ?></b>
                </div>
              </div>
              <form action="../../backend/barang_keluar/tambah.php?Tr=<?= $Tr ?>" method="post">

                <input type="hidden" name="Tr" value="<?= $Tr ?>">
                <input type="hidden" name="total_transaksi" value="<?= $total['total'] ?>">
                <input type="hidden" name="nama_kasir" value="<?= $detailDataTr['nama_kasir'] ?>">
                <input type="hidden" name="keterangan" value="<?= $detailDataTr['keterangan'] ?>">

                <button type="submit" name="transaksiSelesai" class="tmbl tmbl-biru margin-20-0">
                  Selesai
                </button>

                <br>

                <small>
                  * Pastikan anda sudah menekan tombol <b>selesai</b>, jika tidak data transaksi akan di hapus otomatis oleh sistem ketika melakukan transaksi baru
                </small>

              </form>
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