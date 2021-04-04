<?php
	session_start();

	if ($_SESSION['level'] != 'admin') {
		header("location:../../login.php?pesan=bukanadmin");
	}

	include '../../database/koneksi.php';

  header("Content-type: application/vnd-ms-excel");
  header("Content-Disposition: attachment; filename=Laporan Penjualan.xls");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Laporan Penjualan</title>
</head>
<body>
  <main class="main">
    <section>

      <?php
        //! Select Data Laporan 
        $sqlLaporan   = "SELECT * FROM laporan_brg_keluar ";
        $queryLaporan = mysqli_query($host, $sqlLaporan);
        $dataLaporan  = mysqli_fetch_assoc($queryLaporan);

      ?>
        <h2>Laporan Penjualan</h2>

        <table>
          <tr>
              <th>No</th>
              <th>Tanggal Transaksi</th>
              <th>Barang</th>
              <th>Qty</th>
              <th>@Harga Satuan</th>
              <th>Subtotal</th>
          </tr>

          <?php
            $no        = 1;
            $sqlNota   = "SELECT * FROM detail_transaksi INNER JOIN barang ON detail_transaksi.barang_id = barang.id_barang ORDER BY tgl_transaksi ASC ";
            $queryNota = mysqli_query($host, $sqlNota);
            while ($detail = mysqli_fetch_assoc($queryNota) ) {
          ?>
          <tr>
            <td><?php echo $no++?></td>
            <td><?php echo date('d M Y', strtotime($detail['tgl_transaksi'])) ?></td>
            <td><?php echo $detail['nama_barang'] ?></td>
            <td><?php echo $detail['qty'] . " " . $detail['satuan_stok_barang'] ?></td>
            <td><?php echo "Rp. " . number_format($detail['harga_jual_item'],0,',','.') ?></td>
            <td><?php echo "Rp. " . number_format($detail['sub_total'],0,',','.') ?></td>
          </tr>
          <?php } ?>

          <tr>
            <td colspan="5">Omzet</td>
            <td colspan="4">
            <?php
                //! Sum Omzet 
                $sqlTotal   = "SELECT SUM(sub_total) AS total FROM detail_transaksi ";
                $queryTotal = mysqli_query($host, $sqlTotal);
                $total      = mysqli_fetch_assoc($queryTotal);
              ?>
              <b><?= "Rp. " . number_format($total['total'],0,',','.') ?></b>
            </td>
          </tr>
          <tr>
            <td colspan="5">Keuntungan Yang Didapat</td>
            <td colspan="4">
            <?php
                //! Sum Keuntungan 
                $sqlTotalUntung    = "SELECT SUM(untung_item_detail) AS total_untung FROM detail_transaksi ";
                $queryTotalUntung  = mysqli_query($host, $sqlTotalUntung);
                $total_untung      = mysqli_fetch_assoc($queryTotalUntung);
              ?>
              <b><?= "Rp. " . number_format($total_untung['total_untung'],0,',','.') ?></b>
            </td>
          </tr>
        </table>
    </section>
  </main>
  <script>
    window.location.href='index.php';
  </script>
</body>
</html>