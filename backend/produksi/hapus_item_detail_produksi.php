<?php

  include '../../database/koneksi.php';

  $id_detail_produksi = $_GET['id_detail_produksi'];
  $produksi_id        = $_GET['produksi_id'];

  $sql    = "DELETE FROM detail_produksi WHERE id_detail_produksi = '$id_detail_produksi' ";
  $query  = mysqli_query($host, $sql);

  if($query){
    echo "<script>window.location.href='../../frontend/produksi/edit_detail_produksi.php?ip=$produksi_id&page=produksi'</script>";
  }else{
    echo "<script>alert('Operasi Gagal');window.location.href='../../frontend/produksi/edit_detail_produksi.php?ip=$produksi_id&page=produksi'</script>";
  }


?>