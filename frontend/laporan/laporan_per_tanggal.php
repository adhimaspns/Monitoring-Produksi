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
		<title>Monitoring Biaya Produksi | Laporan Penjualan</title>

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
    //! Variabel
    $tgl_awal    = $_POST['tgl_awal']; 
    $tgl_akhir   = $_POST['tgl_akhir'];
	?>
		<main class="main">
			<section>
				<h2>Monitoring Biaya Produksi</h2>
				<h3>Laporan Penjualan</h3>
				<div class="breadcrumb">
          <h3>
						<a href="../../beranda.php?page=beranda">Beranda</a> <i class="fa fa-angle-right"></i>
						<a href="index.php?page=laporan">Data Laporan Penjualan</a> <i class="fa fa-angle-right"></i>
						<span class="akhir-link-breadcrumb">Laporan Pertanggal</span>
					</h3>
				</div>

				<div class="container margin-bottom-100">
					<div class="baris baris-tengah">
            <div class="kolom-100 margin-top-50">
              <table>
                <tr>
                  <td>
                    <b>Laporan Dari Tanggal</b>
                  </td>
                  <td> : <?php echo date('d M Y', strtotime($tgl_awal))  ?> - <?php echo date('d M Y', strtotime($tgl_akhir)) ?></td>
                </tr>
              </table>
              <a target="blank" href="cetak_laporan_pertgl_excel.php?tglawl=<?php echo $tgl_awal?>&tglakhr=<?php echo $tgl_akhir?>" class="tmbl tmbl-hijau margin-20-0">
                <i class="fa fa-file-excel"></i>
              </a>
              <div class="table-box">
                <table class="table-responsive">
                  <tr class="thead-dark">
                    <th>No</th>
                    <th>Tanggal Pembelian</th>
                    <th>Nomor Nota</th>
                    <th>Omzet Yang Di Dapat</th>
                    <th>Petugas Kasir</th>
                    <th>Aksi</th>
                  </tr>

                  <?php
                    $no                 = 1;
                    //! Cari Data Berdasarkan Tanggal 
                    $cariTanggal  = "SELECT * FROM laporan_brg_keluar WHERE tgl_laporan BETWEEN '$tgl_awal' AND '$tgl_akhir' ORDER BY tgl_laporan DESC";  
                    $queryTanggal = mysqli_query($host, $cariTanggal); 
                    
                    while ($dataLaporan = mysqli_fetch_assoc($queryTanggal)) {

                  ?>
                  <tr>
                    <td><?= $no++ ?></td>
                    <td><?= date('d M Y', strtotime($dataLaporan['tgl_laporan']))  ?></td>
                    <td><?= $dataLaporan['nomor_transaksi'] ?></td>
                    <td><?= "Rp " . number_format($dataLaporan['omzet'],0,',','.') ?></td>
                    <td><?= $dataLaporan['petugas_kasir'] ?></td>
                    <td>
                      <a target="blank" href="cetak_laporan_noTr.php?Tr=<?php echo $dataLaporan['nomor_transaksi']?>&tgl=<?php echo $dataLaporan['tgl_laporan']?>" class="tmbl tmbl-merah">
                        <i class="fa fa-file-pdf"></i>
                      </a>
                    </td>
                  </tr>
                  <?php } ?>
                </table>
              </div>
              <a href="index.php?page=laporan" class="tmbl tmbl-abu-abu margin-20-0">
                Kembali
              </a>
            </div>
          </div>
				</div>
				
      </section>

		</main>
	</body>
</html>
