<?php

  include '../../database/koneksi.php';

  if (isset($_POST['editQtyTemp'])) {
      
    $id_temp              = $_POST['id_temp'];
    $produksi_id  = $_POST['produksi_id'];
    $bhn_id               = $_POST['bhn_id'];
    $qty                  = $_POST['qty'];


    //! UPDATE QTY TEMP
    $sql    = "UPDATE temp SET qty = '$qty' WHERE id_temp = '$id_temp' ";
    $query  = mysqli_query($host, $sql);


    //! UPDATE QTY PRODUKSI
    $sql    = "UPDATE detail_produksi SET qty = '$qty' WHERE bhn_id = '$bhn_id' "; 
    $query   = mysqli_query($host, $sql);
    
    
    //! CEK QTY TEMP
    $sqlCekQty   = "SELECT * FROM temp WHERE bhn_id = '$bhn_id' AND produksi_id = '$produksi_id' "; 
    $queryCekQty = mysqli_query($host, $sqlCekQty);
    $qty         = mysqli_fetch_assoc($queryCekQty);


    //! Update untuk subtotal
    $sqlSelectSubTotal   = "SELECT * FROM temp INNER JOIN bahan ON temp.bhn_id = bahan.id_bahan WHERE bhn_id = '$bhn_id' AND produksi_id = '$produksi_id' ";
    $querySelectSubTotal = mysqli_query($host, $sqlSelectSubTotal);
    $data_sub_total      = mysqli_fetch_assoc($querySelectSubTotal);
    $harga               = $data_sub_total['harga'];
    $subtotal            = $qty['qty'] * $harga;


    //! UPDATE TEMP 
    $sqlSub  = mysqli_query($host, "UPDATE temp SET sub_total = '$subtotal' WHERE  bhn_id = '$bhn_id' ");
    //! UPDATE PRODUKSI
    $sqlSubProduksi  = mysqli_query($host, "UPDATE detail_produksi SET sub_total = '$subtotal' WHERE  bhn_id = '$bhn_id' ");


    if($sqlSubProduksi){
      echo "<script>window.location.href='../../frontend/produksi/produksi.php?id_produksi=$produksi_id&page=produksi'</script>";
    }else{
      echo "<script>alert('Operasi Gagal');window.location.href='../../frontend/produksi/produksi.php?id_produksi=$produksi_id&page=produksi'</script>";
    }
  }

?>