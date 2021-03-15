<?php

  include '../../database/koneksi.php';

  if (isset($_POST['editQtyTemp'])) {
      
    $id_detail_produksi   = $_POST['id_detail_produksi'];
    $produksi_id          = $_POST['produksi_id'];
    $bhn_id               = $_POST['bhn_id'];
    $qty                  = $_POST['qty'];



    //! UPDATE QTY PRODUKSI
    $sql    = "UPDATE detail_produksi SET qty = '$qty' WHERE bhn_id = '$bhn_id' "; 
    $query   = mysqli_query($host, $sql);


    //! Update untuk subtotal
    // $sqlSelectSubTotal   = "SELECT * FROM detail_produksi INNER JOIN bahan ON detail_produksi.bhn_id = bahan.id_bahan WHERE bhn_id = '$bhn_id' AND produksi_id = '$produksi_id' ";
    $sqlSelectSubTotal   = "SELECT * FROM detail_produksi INNER JOIN bahan ON detail_produksi.bhn_id = bahan.id_bahan WHERE bhn_id = '$bhn_id' AND id_detail_produksi = '$id_detail_produksi' ";
    $querySelectSubTotal = mysqli_query($host, $sqlSelectSubTotal);
    $data_sub_total      = mysqli_fetch_assoc($querySelectSubTotal);
    $harga               = $data_sub_total['harga'];
    $subtotal            = $qty * $harga;


    //! UPDATE SUBTOTAL PRODUKSI
    $sqlSubProduksi  = mysqli_query($host, "UPDATE detail_produksi SET sub_total = '$subtotal' WHERE  id_detail_produksi = '$id_detail_produksi' ");


    if($sqlSubProduksi){
      echo "<script>window.location.href='../../frontend/produksi/edit_detail_produksi.php?ip=$produksi_id&page=produksi'</script>";
    }else{
      echo "<script>alert('Operasi Gagal');window.location.href='../../frontend/produksi/edit_detail_produksi.php?ip=$produksi_id&page=produksi'</script>";
    }
  }

?>