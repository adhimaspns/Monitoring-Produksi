<?php

  include '../../database/koneksi.php';

  //! Simpan pra produksi
  if (isset($_POST['btnbuat'])) {
    
    $nama_produk            = ucwords(strtolower($_POST['nama_produk']));
    $stok_pra_produksi      = $_POST['stok_pra_produksi'];
    $satuan_pra_produksi    = ucwords(strtolower($_POST['satuan_pra_produksi']));
    $untung_pra_produksi    = preg_replace("/[^0-9]/","",$_POST['untung_pra_produksi']);
    $tgl_produksi           = date('Y-m-d');


    //! INSERT PRODUKSI 
    $sqlProduksi    = "INSERT INTO produksi VALUES('', '$nama_produk', '$stok_pra_produksi', '$satuan_pra_produksi', '$untung_pra_produksi',  '$tgl_produksi') "; 
    $queryProduksi  = mysqli_query($host, $sqlProduksi); 


    //! SELECT ID PRODUKSI
    $selectIdProduksi     = "SELECT * FROM produksi ORDER BY id_produksi DESC LIMIT 1";
    $queryIdProduksi      = mysqli_query($host, $selectIdProduksi);
    $dataProduksi         = mysqli_fetch_assoc($queryIdProduksi);
    $id_produksi          = $dataProduksi['id_produksi'];


    if($queryIdProduksi ){
      echo "<script>window.location.href='../../frontend/produksi/produksi.php?id_produksi=$id_produksi&page=produksi'</script>";
    }else{
      echo "<script>alert('Operasi Gagal');window.location.href='../../frontend/produksi/tambah_produksi.php?id_produksi=$id_produksi&page=produksi'</script>";
    }
  }


  //! Bahan Baku
  if (!empty($_GET['ket']) && $_GET['ket'] == 'bhn_baku' ) {

    $bhn_id               = $_POST['bhn_id'];
    $jumlah_qty           = $_POST['qty'];
    $id_produksi          = $_GET['id_produksi'];
    $qty                  = 1; 


    //! CEK QTY
    $sqlCek   = mysqli_query($host, "SELECT * FROM temp WHERE bhn_id = '$bhn_id' AND produksi_id = '$id_produksi' ");
    $cekId    = mysqli_num_rows($sqlCek);


    if ($cekId != 0) {

      //! Akan dijalankan jika ada data dengan id sesuai yang di dapat dari $cekId


      $qtyAwal   = mysqli_fetch_assoc($sqlCek); // menampilkan qty awal dari tabel temp
      $qtyAkhir  = $qtyAwal['qty'] + $qty;  // menambahkan qty jika data barang ada pada tabel temp


      //! SELECT NAMA_PRODUK DARI PRODUKSI
      $sql_pra     = "SELECT * FROM produksi WHERE id_produksi = '$id_produksi'";
      $query_pra   = mysqli_query($host, $sql_pra);
      $data_pra    = mysqli_fetch_assoc($query_pra);
      echo $nama_produk = $data_pra['nama_produk'];

      //! UPDATE QTY TEMP
      $sqlUpdate = "UPDATE temp SET qty = '$qtyAkhir' WHERE bhn_id = '$bhn_id' AND produksi_id = '$id_produksi' ";
      $query     = mysqli_query($host, $sqlUpdate);


      //! UPDATE QTY DETAIL PRODUKSI
      $sqlUpdate = "UPDATE detail_produksi SET qty = '$qtyAkhir' WHERE bhn_id = '$bhn_id' AND produksi_id = '$id_produksi' ";
      $query     = mysqli_query($host, $sqlUpdate);


      //! Update untuk subtotal
      $sqlSelectSubTotal   = "SELECT * FROM temp INNER JOIN bahan ON temp.bhn_id = bahan.id_bahan WHERE bhn_id = '$bhn_id' AND produksi_id = '$id_produksi' ";
      $querySelectSubTotal = mysqli_query($host, $sqlSelectSubTotal);

      $data_sub_total      = mysqli_fetch_assoc($querySelectSubTotal);
      $harga               = $data_sub_total['harga'];
      $subtotal            = $qtyAkhir * $harga;


      //! UPDATE SUBTOTAL 

      //! UPDATE TEMP 
      $sqlSub          = mysqli_query($host, "UPDATE temp SET sub_total = '$subtotal' WHERE  bhn_id = '$bhn_id' ");
      //! UPDATE DETAIL PRODUKSI
      $sqlSubProduksi  = mysqli_query($host, "UPDATE detail_produksi SET sub_total = '$subtotal' WHERE bhn_id = '$bhn_id' ");


    } else {
      //! Jika data tidak ditemukan, maka akan menambahkan data baru dalam table temp


      //! SELECT ID PRODUKSI
      $selectIdProduksi     = "SELECT * FROM produksi ORDER BY id_produksi DESC LIMIT 1";
      $queryIdProduksi      = mysqli_query($host, $selectIdProduksi);
      $dataProduksi         = mysqli_fetch_assoc($queryIdProduksi);
      $id_produksi          = $dataProduksi['id_produksi'];


      //! INSERT TEMP 
      $sqlInsert  = "INSERT INTO temp VALUES('', '$id_produksi', '$bhn_id', '$jumlah_qty', 0)"; 
      $query      = mysqli_query($host, $sqlInsert);


      //! INSERT DETAIL PRODUKSI
      $sqlDetailProdusi = "INSERT INTO detail_produksi VALUES(0, '$id_produksi', '$bhn_id', '$jumlah_qty', 0)";
      $queryDetail      = mysqli_query($host, $sqlDetailProdusi);


      //! Query Select Untuk Update subtotal
      $sqlSelectSubTotal   = "SELECT * FROM temp INNER JOIN bahan ON temp.bhn_id = bahan.id_bahan WHERE bhn_id = '$bhn_id' AND produksi_id = '$id_produksi' ";
      $querySelectSubTotal = mysqli_query($host, $sqlSelectSubTotal);

      $data_sub_total      = mysqli_fetch_assoc($querySelectSubTotal);
      echo $harga          = $data_sub_total['harga'];
      $subtotal            = $jumlah_qty*$harga;


      //! UPDATE TEMP 
      $sqlSub          = mysqli_query($host, "UPDATE temp SET sub_total = '$subtotal' WHERE  bhn_id = '$bhn_id' ");
      //! UPDATE PRODUKSI
      $sqlSubProduksi  = mysqli_query($host, "UPDATE detail_produksi SET sub_total = '$subtotal' WHERE  bhn_id = '$bhn_id' ");

    }

    if($query){
      echo "<script>window.location.href='../../frontend/produksi/produksi.php?id_produksi=$id_produksi&page=produksi'</script>";
    }else{
      echo "<script>alert('Operasi Gagal');window.location.href='../../frontend/produksi/produksi.php?id_produksi=$id_produksi&page=produksi'</script>";
    }
    
  }


  //! Bahan Jadi
  if (!empty($_GET['ket']) && $_GET['ket'] == 'bhn_jadi' ) {

    $bhn_id               = $_POST['bhn_id'];
    $id_produksi          = $_GET['id_produksi'];
    $qty                  = 1;
    $jumlah_qty           = $_POST['qty'];

    //! CEK QTY
    $sqlCek   = mysqli_query($host, "SELECT * FROM temp WHERE bhn_id = '$bhn_id' AND produksi_id= '$id_produksi'");
    $cekId    = mysqli_num_rows($sqlCek);

    if ($cekId != 0) {

      //! Akan dijalankan jika ada data dengan id sesuai yang di dapat dari $cekId
      $qtyAwal   = mysqli_fetch_assoc($sqlCek); // menampilkan qty awal dari tabel temp
      $qtyAkhir  = $qtyAwal['qty'] + $qty;  // menambahkan qty jika data barang ada pada tabel temp


      //! QUERY Update Qty Temp
      $sqlUpdate = "UPDATE temp SET qty = '$qtyAkhir' WHERE bhn_id = '$bhn_id' AND produksi_id = '$id_produksi' ";
      $query     = mysqli_query($host, $sqlUpdate);


      //! QUERY Update Qty Produksi
      $sqlUpdate = "UPDATE detail_produksi SET qty = '$qtyAkhir' WHERE bhn_id = '$bhn_id' AND produksi_id = '$id_produksi' ";
      $query     = mysqli_query($host, $sqlUpdate);


      //! QUERY Select subtotal
      $sqlSelectSubTotal   = "SELECT * FROM temp INNER JOIN bahan ON temp.bhn_id = bahan.id_bahan WHERE bhn_id = '$bhn_id' AND produksi_id = '$id_produksi' ";
      $querySelectSubTotal = mysqli_query($host, $sqlSelectSubTotal);
      $data_sub_total      = mysqli_fetch_assoc($querySelectSubTotal);
      $harga               = $data_sub_total['harga'];
      $subtotal            = $qtyAkhir*$harga;


      //! UPDATE TEMP 
      $sqlSub  = mysqli_query($host, "UPDATE temp SET sub_total = '$subtotal' WHERE  bhn_id = '$bhn_id' ");
      //! UPDATE PRODUKSI 
      $sqlSub  = mysqli_query($host, "UPDATE detail_produksi SET sub_total = '$subtotal' WHERE  bhn_id = '$bhn_id' ");

    } else {
      //! Jika data tidak ditemukan, maka akan menambahkan data baru 


      //! QUERY INSERT TEMP 
      $sqlInsert  = "INSERT INTO temp VALUES('', '$id_produksi', '$bhn_id', '$jumlah_qty', 0)"; 
      $query      = mysqli_query($host, $sqlInsert);


      //! SELECT ID PRODUKSI
      $selectIdProduksi     = "SELECT * FROM produksi ORDER BY id_produksi DESC LIMIT 1";
      $queryIdProduksi      = mysqli_query($host, $selectIdProduksi);
      $dataProduksi         = mysqli_fetch_assoc($queryIdProduksi);
      $id_produksi          = $dataProduksi['id_produksi'];


      //! INSERT DETAIL PRODUKSI
      $sqlDetailProdusi = "INSERT INTO detail_produksi VALUES(0, '$id_produksi', '$bhn_id', '$qty', 0)";
      $queryDetail      = mysqli_query($host, $sqlDetailProdusi);



      //! QUERY Select subtotal
      $sqlSelectSubTotal   = "SELECT * FROM temp INNER JOIN bahan ON temp.bhn_id = bahan.id_bahan WHERE bhn_id = '$bhn_id' AND produksi_id = '$id_produksi' ";
      $querySelectSubTotal = mysqli_query($host, $sqlSelectSubTotal);
      $data_sub_total      = mysqli_fetch_assoc($querySelectSubTotal);
      $harga               = $data_sub_total['harga'];
      $subtotal            = $qty*$harga;


      //! QUERY Update Subtotal Temp 
      $sqlSub          = mysqli_query($host, "UPDATE temp SET sub_total = '$subtotal' WHERE  bhn_id = '$bhn_id' ");
      //! QUERY Update Subtotal Produksi
      $sqlSubProduksi  = mysqli_query($host, "UPDATE detail_produksi SET sub_total = '$subtotal' WHERE  bhn_id = '$bhn_id' ");

    }

    // if($query){
    //   echo "<script>window.location.href='../../frontend/produksi/produksi.php?produksi_id=$id_produksi&page=produksi'</script>";
    // }else{
    //   echo "<script>alert('Operasi Gagal');window.location.href='../../frontend/produksi/produksi.php?produksi_id=$id_produksi&page=produksi'</script>";
    // }
    
  }

?>