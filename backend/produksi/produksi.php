<?php

  include '../../database/koneksi.php';


  //! EDIT UNTUNG PRODUK
  if (isset($_POST['editUntung'])) {
    
    $id_produksi   = $_POST['id_produksi'];
    $untung_produk = preg_replace("/[^0-9]/","",$_POST['untung_produk']) ;

    $sql   = "UPDATE produksi SET untung_produk = '$untung_produk' WHERE id_produksi = '$id_produksi' ";
    $query = mysqli_query($host, $sql);

    if($query){
      echo "<script>window.location.href='../../frontend/produksi/detail_produksi.php?id_produksi=$id_produksi&page=produksi'</script>";
    }else{
      echo "<script>alert('Operasi Gagal');window.location.href='../../frontend/produksi/edit_untung.php?id_produksi=$id_produksi&page=produksi'</script>";
    }
  }


?>

