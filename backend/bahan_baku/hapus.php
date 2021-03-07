<?php

  include '../../database/koneksi.php';
  
  $id_bahan = $_GET['id_bahan'];

  $sql   = "DELETE FROM bahan WHERE id_bahan = '$id_bahan' ";
  $query = mysqli_query($host, $sql);


  if ($query) {
    echo "<script>window.location.href='../../frontend/bahan/bhn_baku/index.php?page=bahan'</script>";
  }else{
    echo "<script>alert('Data gagal dihapus !');window.location.href='../../frontend/bahan/bhn_baku/index.php?page=bahan'</script>"; 
    
  }

?>