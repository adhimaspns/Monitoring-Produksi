<?php

  $host  = mysqli_connect('localhost', 'root', '', 'monitoring_produksi');

  // Cek
  if (!$host) {
    
      echo "<script>alert('Database tidak ditemukan !');window.location.href='koneksi.php'</script>"; 
  }

?>