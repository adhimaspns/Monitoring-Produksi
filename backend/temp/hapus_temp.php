<?php

  include '../../database/koneksi.php';

  //! HAPUS TEMP $ PRA PRODUKSI
  if (isset($_POST['hapus_temp'])) {


    $id_produksi  = $_GET['id_produksi'];

    //! HAPUS TEMP 
    $hapusTemp   = "DELETE FROM temp WHERE produksi_id = '$id_produksi' "; 
    $queryTemp   = mysqli_query($host, $hapusTemp); 

    if($queryTemp){
      echo "<script>window.location.href='../../frontend/produksi/index.php?page=produksi'</script>";
    }else{
      echo "<script>alert('Operasi Gagal');window.location.href='../../frontend/produksi/index.php?page=produksi'</script>";
    }
  }


?>