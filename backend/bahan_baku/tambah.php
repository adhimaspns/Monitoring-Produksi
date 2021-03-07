<?php

  include '../../database/koneksi.php';

  if (isset($_POST['simpan'])) {
    
    $nama_bahan    = ucwords(strtolower($_POST['nama_bahan']));
    $tgl           = date('Y-m-d');
    $kuantitas     = $_POST['kuantitas'];
    $satuan        = ucwords(strtolower($_POST['satuan']));
    $harga         = preg_replace("/[^0-9]/","",$_POST['harga']);
    $kategori      = 'bahan baku';


    $sql   = "INSERT INTO bahan VALUES(0, '$nama_bahan', '$tgl', '$kuantitas', '$satuan', '$harga', '$kategori') ";
    $query = mysqli_query($host, $sql);


    if ($query) {
      echo "<script>window.location.href='../../frontend/bahan_baku/index.php?page=bahanbaku'</script>";
    }else{
      echo "<script>alert('Data gagal ditambah !');window.location.href='../../frontend/bahan_baku/tambah.php?page=bahanbaku'</script>"; 
      
    }
  }


?>