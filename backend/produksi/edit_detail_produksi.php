<?php

  include '../../database/koneksi.php';


  //! Bahan Baku
  if (!empty($_GET['ket']) && $_GET['ket'] == 'bhn_baku' ) {


    $bhn_id               = $_POST['bhn_id'];
    $jumlah_qty           = $_POST['qty'];
    $id_produksi          = $_GET['id_produksi'];
    $qty                  = 1; 


    //! CEK QTY
    $sqlCek   = mysqli_query($host, "SELECT * FROM detail_produksi WHERE bhn_id = '$bhn_id' AND produksi_id = '$id_produksi' ");
    $cekId    = mysqli_num_rows($sqlCek);


    if ($cekId != 0) {

      //! Akan dijalankan jika ada data dengan id sesuai yang di dapat dari $cekId


      $qtyAwal   = mysqli_fetch_assoc($sqlCek); // menampilkan qty awal dari tabel temp
      $qtyAkhir  = $qtyAwal['qty'] + $qty;  // menambahkan qty jika data barang ada pada tabel temp


      //! UPDATE QTY DETAIL PRODUKSI
      $sqlUpdate = "UPDATE detail_produksi SET qty = '$qtyAkhir' WHERE bhn_id = '$bhn_id' AND produksi_id = '$id_produksi' ";
      $query     = mysqli_query($host, $sqlUpdate);


      //! Update untuk subtotal
      $sqlSelectSubTotal   = "SELECT * FROM detail_produksi INNER JOIN bahan ON detail_produksi.bhn_id = bahan.id_bahan WHERE bhn_id = '$bhn_id' AND produksi_id = '$id_produksi' ";
      $querySelectSubTotal = mysqli_query($host, $sqlSelectSubTotal);

      $data_sub_total      = mysqli_fetch_assoc($querySelectSubTotal);
      $harga               = $data_sub_total['harga'];
      $subtotal            = $qtyAkhir * $harga;


      //! UPDATE SUBTOTAL DETAIL PRODUKSI
      $sqlSubProduksi  = mysqli_query($host, "UPDATE detail_produksi SET sub_total = '$subtotal' WHERE bhn_id = '$bhn_id' ");


    } else {

      //! Jika data tidak ditemukan, maka akan menambahkan data baru dalam table detail_produksi


      //! INSERT DETAIL PRODUKSI
      $sqlDetailProdusi = "INSERT INTO detail_produksi VALUES(0, '$id_produksi', '$bhn_id', '$jumlah_qty', 0)";
      $queryDetail      = mysqli_query($host, $sqlDetailProdusi);


      //! Query Select Untuk Update subtotal
      $sqlSelectSubTotal   = "SELECT * FROM detail_produksi INNER JOIN bahan ON detail_produksi.bhn_id = bahan.id_bahan WHERE bhn_id = '$bhn_id' AND produksi_id = '$id_produksi' ";
      $querySelectSubTotal = mysqli_query($host, $sqlSelectSubTotal);

      $data_sub_total      = mysqli_fetch_assoc($querySelectSubTotal);
      $harga               = $data_sub_total['harga'];
      $subtotal            = $jumlah_qty*$harga;

      //! UPDATE SUBTOTAL DETAIL PRODUKSI
      $sqlSubProduksi  = mysqli_query($host, "UPDATE detail_produksi SET sub_total = '$subtotal' WHERE  bhn_id = '$bhn_id' AND produksi_id = '$id_produksi' ");

    }

    if($sqlSubProduksi){
      echo "<script>window.location.href='../../frontend/produksi/edit_detail_produksi.php?id_produksi=$id_produksi&page=produksi'</script>";
    }else{
      echo "<script>alert('Operasi Gagal');window.location.href='../../frontend/produksi/edit_detail_produksi.php?id_produksi=$id_produksi&page=produksi'</script>";
    }
    
  }


  //! Bahan Jadi
  if (!empty($_GET['ket']) && $_GET['ket'] == 'bhn_jadi' ) {

    $bhn_id               = $_POST['bhn_id'];
    $id_produksi          = $_GET['id_produksi'];
    $qty                  = 1;
    $jumlah_qty           = $_POST['jumlah_qty'];

    //! CEK QTY
    $sqlCek   = mysqli_query($host, "SELECT * FROM detail_produksi WHERE bhn_id = '$bhn_id' AND produksi_id= '$id_produksi'");
    $cekId    = mysqli_num_rows($sqlCek);

    if ($cekId != 0) {

      //! Akan dijalankan jika ada data dengan id sesuai yang di dapat dari $cekId
      $qtyAwal   = mysqli_fetch_assoc($sqlCek); // menampilkan qty awal dari tabel 
      $qtyAkhir  = $qtyAwal['qty'] + $qty;  // menambahkan qty jika data barang ada pada tabel 


      //! QUERY Update Qty Produksi
      $sqlUpdate = "UPDATE detail_produksi SET qty = '$qtyAkhir' WHERE bhn_id = '$bhn_id' AND produksi_id = '$id_produksi' ";
      $query     = mysqli_query($host, $sqlUpdate);


      //! QUERY Select subtotal
      $sqlSelectSubTotal   = "SELECT * FROM detail_produksi INNER JOIN bahan ON detail_produksi.bhn_id = bahan.id_bahan WHERE bhn_id = '$bhn_id' AND produksi_id = '$id_produksi' ";
      $querySelectSubTotal = mysqli_query($host, $sqlSelectSubTotal);
      $data_sub_total      = mysqli_fetch_assoc($querySelectSubTotal);
      $harga               = $data_sub_total['harga'];
      $subtotal            = $qtyAkhir*$harga; // Aritmatika untuk menjumlahkan qtyAkhir dengan harga bahan


      //! UPDATE PRODUKSI 
      $sqlSub  = mysqli_query($host, "UPDATE detail_produksi SET sub_total = '$subtotal' WHERE  bhn_id = '$bhn_id' AND produksi_id = '$id_produksi'  ");

    } else {
      //! Jika data tidak ditemukan, maka akan menambahkan data baru 


      //! INSERT DETAIL PRODUKSI (dengan value subtotal 0, akan di update pada proses selanjutnya)
      $sqlDetailProdusi = "INSERT INTO detail_produksi VALUES(0, '$id_produksi', '$bhn_id', '$jumlah_qty', 0)";
      $queryDetail      = mysqli_query($host, $sqlDetailProdusi);



      //! QUERY Select subtotal
      $sqlSelectSubTotal   = "SELECT * FROM detail_produksi INNER JOIN bahan ON detail_produksi.bhn_id = bahan.id_bahan WHERE bhn_id = '$bhn_id' AND produksi_id = '$id_produksi' ";
      $querySelectSubTotal = mysqli_query($host, $sqlSelectSubTotal);
      $data_sub_total      = mysqli_fetch_assoc($querySelectSubTotal);
      $harga               = $data_sub_total['harga']; // Mengambil data['harga'] dari proses sql diatas
      $subtotal            = $jumlah_qty*$harga; // Aritmatika untuk menjumlahkan qtyAkhir dengan harga bahan


      //! QUERY Update Subtotal Produksi
      $sqlSubProduksi  = mysqli_query($host, "UPDATE detail_produksi SET sub_total = '$subtotal' WHERE  bhn_id = '$bhn_id' ");

    }

    if($sqlSubProduksi){
      echo "<script>window.location.href='../../frontend/produksi/edit_detail_produksi.php?id_produksi=$id_produksi&page=produksi'</script>";
    }else{
      echo "<script>alert('Operasi Gagal');window.location.href='../../frontend/produksi/edit_detail_produksi.php?id_produksi=$id_produksi&page=produksi'</script>";
    }
    
  }



?>