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
		<title>Laporan</title>

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
    //! Variabel
    $tgl    = $_GET['tgl']; 
    $Tr     = $_GET['Tr'];

    $cariTanggal   = "SELECT * FROM laporan_brg_keluar WHERE tgl_laporan = '$tgl'";  
    $queryTanggal  = mysqli_query($host, $cariTanggal); 

	?>
		<main class="main">
			<section>
				<div class="container margin-bottom-100">
          <center>
            <h1>Laporan Barang Keluar</h1>
            <table>
              <tr>
                <td>Tanggal</td>
                <td> : <?php echo date('d M Y', strtotime($tgl)) ?></td>
              </tr>
            </table>

            <table border="1">
              <tr>
                <th>No</th>
                <th>Tanggal Transaksi</th>
                <th>Nomor Transaksi</th>
                <th>Petugas Kasir</th>
                <th>Keterangan</th>
                <th>Omzet</th>
              </tr>

              <?php
                $no = 1;
                while ($detail_transaksi = mysqli_fetch_assoc($queryTanggal) ) {

              ?>
              <tr>
                <td><?php echo $no++ ?></td>
                <td><?php echo date('d M Y', strtotime($detail_transaksi['tgl_laporan'])) ?></td>
                <td><?php echo $detail_transaksi['nomor_transaksi'] ?></td>
                <td><?php echo $detail_transaksi['petugas_kasir'] ?></td>
                <td><?php echo $detail_transaksi['ket_laporan'] ?></td>
                <td><?php echo "Rp " . number_format($detail_transaksi['omzet'],0,',','.') ?></td>
              </tr>
              <?php
                }
              ?>
              <tr>
                <?php

                  $sumOmzet    = "SELECT SUM(omzet) AS total_omzet FROM laporan_brg_keluar WHERE tgl_laporan = '$tgl'";  
                  $queryOmzet  = mysqli_query($host, $sumOmzet);
                  $total_omzet = mysqli_fetch_assoc($queryOmzet); 
                ?>
                <td colspan="5">Total Omzet</td>
                <td colspan="1">
                  <?php echo "Rp. " . number_format($total_omzet['total_omzet'],0,',','.') ?>
                </td>
              </tr>
              <tr>
                <?php

                  $sumUntung    = "SELECT SUM(untung_item_detail) AS total_untung FROM detail_transaksi WHERE tgl_transaksi = '$tgl' ";  
                  $queryUntung  = mysqli_query($host, $sumUntung);
                  $total_untung = mysqli_fetch_assoc($queryUntung); 
                ?>
                <td colspan="5">Total Keuntungan Bersih</td>
                <td colspan="1">
                  <?php echo "Rp. " . number_format($total_untung['total_untung'],0,',','.') ?>
                </td>
              </tr>
            </table>
          </center>
				</div>
      </section>
		</main>

    <script>
      window.print();
    </script>
	</body>
</html>
