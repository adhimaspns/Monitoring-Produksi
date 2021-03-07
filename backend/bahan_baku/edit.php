<?php

  include '../../database/koneksi.php';


  if (isset($_POST['simpan'])) {
    
    $id_bahan       = $_POST['id_bahan'];
    $nama_bahan     = ucwords(strtolower($_POST['nama_bahan']));
    $tgl            = $_POST['tgl'];
    $satuan         = ucwords(strtolower($_POST['satuan']));
    $harga          = preg_replace("/[^0-9]/","",$_POST['harga']);


    $sql    = "UPDATE bahan SET nama_bahan = '$nama_bahan', tgl = '$tgl', satuan = '$satuan', harga = '$harga' WHERE id_bahan = '$id_bahan' ";
    $query  = mysqli_query($host, $sql);


    if ($query) {
      echo "<script>window.location.href='../../frontend/bahan/bhn_baku/index.php?page=bahan'</script>";
    }else{
      echo "<script>alert('Data gagal diedit !');window.location.href='../../frontend/bahan/bhn_baku/edit.php?page=bahan'</script>"; 
      
    }
  }


?>