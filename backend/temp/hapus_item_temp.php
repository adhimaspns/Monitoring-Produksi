<?php

  include '../../database/koneksi.php';

  //! HAPUS ITEM TEMP & PPRODUKSI
  if (!empty($_GET['id_temp'] && $_GET['bhn_id'])) {
    
    $id_temp               = $_GET['id_temp'];
    $bhn_id                = $_GET['bhn_id'];
    $produksi_id           = $_GET['produksi_id'];


    //!QUERY HAPUS TEMP
    $sql    = "DELETE FROM temp WHERE id_temp = '$id_temp' ";
    $query  = mysqli_query($host, $sql);


    //! QUERY HAPUS PRODUKSI
    $sql   = "DELETE FROM detail_produksi WHERE bhn_id = '$bhn_id' AND produksi_id = '$produksi_id' ";
    $query = mysqli_query($host, $sql);


    if($query){
      echo "<script>window.location.href='../../frontend/produksi/produksi.php?id_produksi=$produksi_id&page=produksi'</script>";
    }else{
      echo "<script>alert('Operasi Gagal');window.location.href='../../frontend/produksi/produksi.php?id_produksi=$produksi_id&page=produksi'</script>";
    }
  } 

?>