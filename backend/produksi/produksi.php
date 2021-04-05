<?php

  include '../../database/koneksi.php';


  //! EDIT UNTUNG PRODUK
  if (isset($_POST['editUntung'])) {
    
    $ip               = $_POST['ip'];
    $biaya_produksi   = $_POST['biaya_produksi'];
    $stok             = $_POST['stok'];
    $untung_produk    = preg_replace("/[^0-9]/","",$_POST['untung_produk']);

    //!Aritmarika biaya produksi
    $cuan   = $biaya_produksi / $stok + $untung_produk;


    //! Update untung produksi
    $sql   = "UPDATE produksi SET untung_produk = '$untung_produk' WHERE id_produksi = '$ip' ";
    $query = mysqli_query($host, $sql);


    //! Update harga jual produksi
    $sql   = "UPDATE produksi SET harga_jual = '$cuan' WHERE id_produksi = '$ip' "; 
    $query = mysqli_query($host, $sql);


    //! Update untung data barang
    $sql   = "UPDATE barang SET untung_barang = '$untung_produk' WHERE produksi_id = '$ip' ";
    $query = mysqli_query($host, $sql);


    //! Update harga jual data barang
    $sql   = "UPDATE barang SET harga_jual_item = '$cuan' WHERE produksi_id = '$ip' "; 
    $query = mysqli_query($host, $sql);

    if($query){
      echo "<script>window.location.href='../../frontend/produksi/detail_produksi.php?ip=$ip&page=produksi'</script>";
    }else{
      echo "<script>alert('Operasi Gagal');window.location.href='../../frontend/produksi/edit_untung.php?ip=$ip&page=produksi'</script>";
    }
  }

  //! EDIT NAMA PRODUK
  if (isset($_POST['editNamaProduk'])) {
    
    //! Variabel
    $ip          = $_POST['ip']; 
    $nama_produk = ucwords(strtolower($_POST['nama_produk'])); 

    //! Update Nama Produk Tabel Produk
    $sqlProduk   = "UPDATE produksi SET nama_produk = '$nama_produk' WHERE id_produksi = '$ip' ";
    $queryProduk = mysqli_query($host, $sqlProduk);
    
    //! Update Nama Produk Tabel Barang
    $sqlBarang   = "UPDATE barang SET nama_barang = '$nama_produk' WHERE produksi_id = '$ip' ";
    $queryBarang = mysqli_query($host, $sqlBarang); 

    if($queryBarang){
      echo "<script>window.location.href='../../frontend/produksi/detail_produksi.php?ip=$ip&page=produksi'</script>";
    }else{
      echo "<script>alert('Operasi Gagal');window.location.href='../../frontend/produksi/edit_nama_bahan.php?ip=$ip&page=produksi'</script>";
    }
  } 


?>

