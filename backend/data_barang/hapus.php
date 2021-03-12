<?php

  include '../../database/koneksi.php';

  $id_barang  = $_GET['id_barang'];


  $sql   = "DELETE FROM barang WHERE id_barang = '$id_barang' ";
  $query = mysqli_query($host, $sql);

  if($query){
    echo "<script>window.location.href='../../frontend/data_barang/index.php?&page=databarang'</script>";
  }else{
    echo "<script>alert('Operasi Gagal');window.location.href='../../frontend/data_barang/index.php?&page=databarang'</script>";
  }


?>