<?php
		include '../../database/koneksi.php';
	?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Nota Pembelian</title>

  <link rel="stylesheet" href="https://cdn.materialdesignicons.com/4.9.95/css/materialdesignicons.min.css"/>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto&display=swap" />
  <link rel="stylesheet" href="../../assets/css/main.css" />
  <link rel="stylesheet" href="../../assets/css/style.css" />
  <link rel="stylesheet" href="../../assets/css/sidebar.css" />
</head>
<body>
  <main class="main">
    <section>

      <?php

        $Tr  = $_GET['Tr'];

        //! Select Data Laporan 
        $sqlLaporan   = "SELECT * FROM laporan_brg_keluar WHERE nomor_transaksi = '$Tr' ";
        $queryLaporan = mysqli_query($host, $sqlLaporan);
        $dataLaporan  = mysqli_fetch_assoc($queryLaporan);

      ?>

      <h2 style="text-align: center !important;" class="text-center huruf-kapital">Toko. Mlaten Makmur </h2>
      <h3 style="text-align: center !important;" class="text-center huruf-kapital">
        Alamat: Jalan Munasir, RT 01 RW 02, Kelurahan Mlaten, Kecamatan Puri, Kota Mojokerto, Jawa Timur, 61363 
      </h3>

      <center>

        <p style="text-align: center !important;">
          <b>Tanggal :</b>
          <?php echo date('d M Y', strtotime($dataLaporan['tgl_laporan'])) ?>
          |
          <b>No Nota :</b>
          <?php echo $Tr ?>
        </p>

        <p style="text-align: center !important;">
          <b>Kasir :</b>
          <?php echo $dataLaporan['petugas_kasir'] ?>
        </p>

        <table border="1">
          <tr>
              <th>No</th>
              <th>Barang</th>
              <th>Qty</th>
              <th>@Harga Satuan</th>
              <th>Subtotal</th>
          </tr>

          <?php

            $no        = 1;
            $sqlNota   = "SELECT * FROM detail_transaksi INNER JOIN barang ON detail_transaksi.barang_id = barang.id_barang WHERE nomor_tr = '$Tr' ORDER BY nama_barang ASC ";
            $queryNota = mysqli_query($host, $sqlNota);

            while ($detail = mysqli_fetch_assoc($queryNota) ) {

          ?>

          <tr>
            <td><?php echo $no++?></td>
            <td><?php echo $detail['nama_barang'] ?></td>
            <td><?php echo $detail['qty'] . " " . $detail['satuan_stok_barang'] ?></td>
            <td><?php echo "Rp. " . number_format($detail['harga_jual_item'],0,',','.') ?></td>
            <td><?php echo "Rp. " . number_format($detail['sub_total'],0,',','.') ?></td>
          </tr>
          
          <?php } ?>

          <tr>
            <td colspan="4">Total</td>
            <td colspan="4">
            <?php
                
                $sqlTotal   = "SELECT SUM(sub_total) AS total FROM detail_transaksi  WHERE nomor_tr = '$Tr' ";
                $queryTotal = mysqli_query($host, $sqlTotal);
                $total      = mysqli_fetch_assoc($queryTotal);

              ?>
              <b><?= "Rp. " . number_format($total['total'],0,',','.') ?></b>
            </td>
          </tr>
          
        </table>

        <p style="text-align: center !important;">
          Terima Kasih Atas Kunjungan Anda. Selamat Datang Kembali.
        </p>
      </center>

    </section>
  </main>

  <script>
		window.print();
	</script>


</body>
</html>