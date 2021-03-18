<?php

  include '../../database/koneksi.php';


  $i          = $_GET['i'];
  $Tr         = $_GET['Tr'];
  $b          = $_GET['b'];


  //! Select Data Kasir
  $sqlDataKasir   = "SELECT * FROM kasir WHERE nomor_tr = '$Tr' AND barang_id = '$b' ";
  $queryDataKasir = mysqli_query($host, $sqlDataKasir);
  $dataKasir      = mysqli_fetch_assoc($queryDataKasir);
  $qtyKasir       = $dataKasir['qty'];

  //! Select Data Stok Barang
  $sqlDataBarang   = "SELECT * FROM barang WHERE id_barang = '$b' ";
  $queryDataBarang = mysqli_query($host, $sqlDataBarang);
  $dataBarang      = mysqli_fetch_assoc($queryDataBarang);
  $stokBarang      = $dataBarang['stok_barang']; 

  //! Aritmatika
  $stokKembali = $stokBarang + $qtyKasir; 

  //! Update Stok Barang
  $sqlStokBarang   = "UPDATE barang SET stok_barang = '$stokKembali' WHERE id_barang = '$b' ";
  $queryStokBarang = mysqli_query($host, $sqlStokBarang);

  //! Delete Data Kasir
  $sqlHapusKasir   = "DELETE FROM kasir WHERE nomor_tr = '$Tr' AND barang_id = '$b' ";
  $queryKasir      = mysqli_query($host, $sqlHapusKasir);
  
  //! Delete Data Detail Transaksi
  $sqlDetail       = "DELETE FROM detail_transaksi WHERE nomor_tr = '$Tr' AND barang_id = '$b'  "; 
  $query           = mysqli_query($host, $sqlDetail);
  
  if ($query) {
    echo "
      <script>
        window.location.href='../../frontend/barang_keluar/kasir.php?Tr=$Tr&page=barangkeluar';
      </script>
    ";
  } else {
    echo "
      <script>
        alert('Operasi Gagal');
        window.location.href='../../frontend/barang_keluar/kasir.php?Tr=$Tr&page=barangkeluar';
      </script>
    ";
  }


?>