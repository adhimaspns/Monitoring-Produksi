<?php

  include '../../database/koneksi.php';


  //! Simpan Data Ke Table Transaksi 
  if (isset($_POST['simpan_tr'])) {

    //! Variabel Data Barang Keluar
    $nama_pembeli            = ucwords(strtolower($_POST['nama_pembeli']));
    $keterangan_transaksi    = ucwords(strtolower($_POST['keterangan_transaksi']));
    $nama_kasir              = ucwords(strtolower($_POST['nama_kasir']));
    $hariIni                 = date('Ymd');


    //! Buat Nomor Transaksi

      //! Cari Data 
      $sqlTransaksi  = "SELECT MAX(no_transaksi) AS last FROM transaksi WHERE no_transaksi LIKE '$hariIni%' "; 
      $query         = mysqli_query($host, $sqlTransaksi);
      $data          = mysqli_fetch_array($query);
      $trkhrNoTr     = $data['last'];

      //! Baca Nomor Urut Transaksi Terkahir
      $trkhrNoUrut  = substr($trkhrNoTr, 8, 4);

      //! No Urut++
      $nextNoUrut  = $trkhrNoUrut + 1;

      //! Buat Nomot Transaksi Berikutnya
      $nextNoTransaksi =  $hariIni.sprintf('%04s', $nextNoUrut);

    //! Akhir Buat Nomor Transaksi


    //! Insert Data Ke Tabel Transaksi 
    $sql   = "INSERT INTO transaksi VALUES(0, '$nextNoTransaksi', '$nama_pembeli',  '$keterangan_transaksi', '$nama_kasir')";
    $query = mysqli_query($host, $sql);


    //! Select No Transaksi Terakhir
    $sql              = "SELECT * FROM transaksi ORDER BY no_transaksi DESC LIMIT 1";
    $query            = mysqli_query($host, $sql); 
    $dataNoTransaksi  = mysqli_fetch_assoc($query);
    $noTransaksi      = $dataNoTransaksi['no_transaksi'];   


    if ($query) {
      echo "
        <script>
          window.location.href='../../frontend/barang_keluar/kasir.php?Tr=$nextNoTransaksi&page=barangkeluar';
        </script>
      ";
    } else {
      echo "
        <script>
          alert('Operasi Gagal');
          window.location.href='../../frontend/barang_keluar/index.php?page=barangkeluar';
        </script>
      ";
    }

  }


  //! Simpan Barang Ke Table Kasit & Detail Transaksi
  if (isset($_POST['simpan_barang'])) {
    
    $barang_id  = $_POST['barang_id'];
    $jumlah_qty = $_POST['jumlah_qty'];
    $qty        = 1;


    //! Query Harga (didapat dari tabel barang)
    $sql    = "SELECT harga FROM ";



  } 
  



?>