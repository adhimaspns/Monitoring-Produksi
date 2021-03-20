<?php

  include '../../database/koneksi.php';


  //! Simpan Data Ke Table Transaksi 
  if (isset($_POST['simpan_tr'])) {

    //! Variabel Data Barang Keluar
    $nama_pembeli            = ucwords(strtolower($_POST['nama_pembeli']));
    $keterangan_transaksi    = ucwords(strtolower($_POST['keterangan_transaksi']));
    $nama_kasir              = ucwords(strtolower($_POST['nama_kasir']));
    $hariIni                 = date('Ymd');


    //! Buat Nomor Transaksi

      //! Cari Data 
      $sqlTransaksi  = "SELECT MAX(no_transaksi) AS last FROM transaksi WHERE no_transaksi LIKE '$hariIni%' "; 
      $query         = mysqli_query($host, $sqlTransaksi);
      $data          = mysqli_fetch_array($query);
      $trkhrNoTr     = $data['last'];

      //! Baca Nomor Urut Transaksi Terkahir
      $trkhrNoUrut  = substr($trkhrNoTr, 8, 4);

      //! No Urut++
      $nextNoUrut  = $trkhrNoUrut + 1;

      //! Buat Nomot Transaksi Berikutnya
      $nextNoTransaksi =  $hariIni.sprintf('%04s', $nextNoUrut);

    //! Akhir Buat Nomor Transaksi


    //! Insert Data Ke Tabel Transaksi 
    $sql   = "INSERT INTO transaksi VALUES(0, '$nextNoTransaksi', '$nama_pembeli',  '$keterangan_transaksi', '$nama_kasir')";
    $query = mysqli_query($host, $sql);


    //! Select No Transaksi Terakhir
    $sql              = "SELECT * FROM transaksi ORDER BY no_transaksi DESC LIMIT 1";
    $query            = mysqli_query($host, $sql); 
    $dataNoTransaksi  = mysqli_fetch_assoc($query);
    $noTransaksi      = $dataNoTransaksi['no_transaksi'];   


    if ($query) {
      echo "
        <script>
          window.location.href='../../frontend/barang_keluar/kasir.php?Tr=$nextNoTransaksi&page=barangkeluar';
        </script>
      ";
    } else {
      echo "
        <script>
          alert('Operasi Gagal');
          window.location.href='../../frontend/barang_keluar/index.php?page=barangkeluar';
        </script>
      ";
    }

  }


  //! Simpan Barang Ke Table Kasit & Detail Transaksi
  if (isset($_POST['simpan_barang'])) {
    
    $Tr         = $_GET['Tr'];
    $barang_id  = $_POST['barang_id'];
    $jumlah_qty = $_POST['jumlah_qty'];
    $qty        = 1;
    $tglHrini   = date('Ymd');


    //! Query Harga (didapat dari tabel barang)
    $sqlHarga           = "SELECT harga_jual_item FROM barang WHERE id_barang = '$barang_id' ";
    $query              = mysqli_query($host, $sqlHarga);
    $dataHarga          = mysqli_fetch_assoc($query);
    $harga              = $dataHarga['harga_jual_item'];


    //! Cek Qty Produk Pada Table Kasir
    $sqlQty     = "SELECT * FROM kasir WHERE barang_id = '$barang_id'  AND nomor_tr = '$Tr' ";
    $queryCek   = mysqli_query($host, $sqlQty);
    $cekProduk  = mysqli_num_rows($queryCek);


    //! Cek Id_produk Pada Table Kasir 
    if ($cekProduk == 0) {

      $subTotal   = $jumlah_qty * $harga;

      //! Select Keuntungan Barang
      $sqlSelectKeuntunganBarang   = "SELECT * FROM barang WHERE id_barang = '$barang_id' ";
      $querySelectKeuntunganBarang = mysqli_query($host, $sqlSelectKeuntunganBarang);
      $dataBarang                  = mysqli_fetch_assoc($querySelectKeuntunganBarang);
      $keuntunganItemBarang        = $dataBarang['untung_barang'];

      //! Aritmatika
      $keuntunganBarang = $jumlah_qty * $keuntunganItemBarang;

      //! Insert Data Table Kasir 
      $sqlKasir   = "INSERT INTO kasir VALUES(0, '$Tr', '$barang_id', '$jumlah_qty', '$harga', '$keuntunganBarang', '$subTotal')";
      $query      = mysqli_query($host, $sqlKasir);

      //! Insert Data Table Detail Transaksi
      $sqlDetail  = "INSERT INTO detail_transaksi VALUES(0, '$tglHrini', '$Tr', '$barang_id', '$jumlah_qty', '$harga', '$keuntunganBarang', '$subTotal')";
      $query      = mysqli_query($host, $sqlDetail); 


      //! Select Qty Table Kasir
      $sqlSelectKasir  = "SELECT * FROM kasir WHERE nomor_tr = '$Tr' AND barang_id = '$barang_id' ";
      $queryKasir      = mysqli_query($host, $sqlSelectKasir);
      $dataQtyKasir    = mysqli_fetch_assoc($queryKasir);
      $qtyKasir        = $dataQtyKasir['qty'];

      //! Select Stok Barang
      $sqlStokBarang   = "SELECT stok_barang FROM barang WHERE id_barang = '$barang_id' ";
      $queryStokBarang = mysqli_query($host, $sqlStokBarang);
      $dataStokBarang  = mysqli_fetch_assoc($queryStokBarang);
      $qtyStokBarang   = $dataStokBarang['stok_barang'];


      //! Aritmatika Qty Akhir Barang
      $QtyAkhirBarang  = $qtyStokBarang - $qtyKasir;

      //! Update Qty Barang 
      $sqlUpdatebarang   = "UPDATE barang SET stok_barang = '$QtyAkhirBarang' WHERE id_barang = '$barang_id' ";
      $queryUpdateBarang = mysqli_query($host, $sqlUpdatebarang);


      if ($query) {
        echo "
          <script>
            window.location.href='../../frontend/barang_keluar/kasir.php?Tr=$Tr&page=barangkeluar';
          </script>
        ";
      } else {
        echo "
          <script>
            alert('Operasi Gagal');
            window.location.href='../../frontend/barang_keluar/kasir.php?Tr=$Tr&page=barangkeluar';
          </script>
        ";
      }

    } else {

      //! Select Qty Table Kasir
      $sqlSelectKasir  = "SELECT * FROM kasir WHERE nomor_tr = '$Tr' AND barang_id = '$barang_id' ";
      $queryKasir      = mysqli_query($host, $sqlSelectKasir);
      $dataQtyKasir    = mysqli_fetch_assoc($queryKasir);
      $qtyKasir        = $dataQtyKasir['qty'];

      //! Select Qty Table Detail Transaksi
      $sqlSelectDetail = "SELECT * FROM detail_transaksi WHERE nomor_tr = '$Tr' AND barang_id = '$barang_id' ";
      $queryDetail     = mysqli_query($host, $sqlSelectDetail);
      $dataQtyDetail   = mysqli_fetch_assoc($queryDetail);
      $qtyDetail       = $dataQtyDetail['qty'];

      //! Select Keuntungan Barang
      $sqlSelectKeuntunganBarang   = "SELECT * FROM barang WHERE id_barang = '$barang_id' ";
      $querySelectKeuntunganBarang = mysqli_query($host, $sqlSelectKeuntunganBarang);
      $dataBarang                  = mysqli_fetch_assoc($querySelectKeuntunganBarang);
      $keuntunganItemBarang        = $dataBarang['untung_barang'];


      //! Aritmatika 
        //! Qty 
        $qtyAkhirKasir   = $qtyKasir + $jumlah_qty;
        $qtyAkhirDetail  = $qtyDetail + $jumlah_qty;

        //! Subtotal
        $subTotalKasir   = $qtyAkhirKasir * $harga; 
        $subTotalDetail  = $qtyAkhirDetail * $harga;
        
        //! Keuntungan Bersih Item
        $keuntunganAkhirBarangKasir  = $qtyAkhirKasir * $keuntunganItemBarang; 
        $keuntunganAkhirBarangDetail = $qtyAkhirDetail * $keuntunganItemBarang; 

      //! Update Qty & Subtotal Kasir 
      $sqlUpdateKasir   = "UPDATE kasir SET qty = '$qtyAkhirKasir', sub_total_kasir = '$subTotalKasir', untung_item_kasir = '$keuntunganAkhirBarangKasir' WHERE nomor_tr = '$Tr' AND barang_id = '$barang_id' ";
      $query            = mysqli_query($host, $sqlUpdateKasir);

      //! Update Qty & Subtotal Detail Transaksi  
      $sqlUpdateDetail  = "UPDATE detail_transaksi SET qty = '$qtyAkhirDetail', sub_total = '$subTotalDetail', untung_item_detail = '$keuntunganAkhirBarangDetail' WHERE nomor_tr = '$Tr' AND barang_id = '$barang_id' ";
      $query            = mysqli_query($host, $sqlUpdateDetail);



      //! Select Stok Barang
      $sqlStokBarang   = "SELECT stok_barang FROM barang WHERE id_barang = '$barang_id' ";
      $queryStokBarang = mysqli_query($host, $sqlStokBarang);
      $dataStokBarang  = mysqli_fetch_assoc($queryStokBarang);
      $qtyStokBarang   = $dataStokBarang['stok_barang'];


      //! Aritmatika Qty Akhir Barang
      $akhirQtyBarang  = $qtyStokBarang - $jumlah_qty;

      //! Update Qty Barang 
      $sqlUpdatebarang   = "UPDATE barang SET stok_barang = '$akhirQtyBarang' WHERE id_barang = '$barang_id' ";
      $queryUpdateBarang = mysqli_query($host, $sqlUpdatebarang);


      if ($queryUpdateBarang) {
        echo "
          <script>
            window.location.href='../../frontend/barang_keluar/kasir.php?Tr=$Tr&page=barangkeluar';
          </script>
        ";
      } else {
        echo "
          <script>
            alert('Operasi Gagal');
            window.location.href='../../frontend/barang_keluar/kasir.php?Tr=$Tr&page=barangkeluar';
          </script>
        ";
      }

    }


  }


  if (isset($_POST['qtyTambah'])) {
    
    $i          = $_POST['i'];
    $Tr         = $_POST['Tr'];
    $b          = $_POST['b'];
    $qtyawal    = $_POST['qtyawal'];
    $qtytambah  = $_POST['qtytambah'];


    //! Select Harga Barang
    $sqlHargaBrg   = "SELECT * FROM barang WHERE id_barang = '$b' ";
    $queryHargabrg = mysqli_query($host, $sqlHargaBrg);
    $dataHarga     = mysqli_fetch_assoc($queryHargabrg);
    $harga         = $dataHarga['harga_jual_item']; 
    $qtybrg        = $dataHarga['stok_barang'];
    
    //! Select Keuntungan Barang
    $sqlSelectKeuntunganBarang   = "SELECT * FROM barang WHERE id_barang = '$b' ";
    $querySelectKeuntunganBarang = mysqli_query($host, $sqlSelectKeuntunganBarang);
    $dataBarang                  = mysqli_fetch_assoc($querySelectKeuntunganBarang);
    $keuntunganItemBarang        = $dataBarang['untung_barang'];

    //! Aritmatika
    $qtyAkhrKasir           = $qtyawal + $qtytambah;
    $stokAkhrBarang         = $qtybrg - $qtytambah;
    $subtotal               = $harga * $qtyAkhrKasir;
    $keuntunganBarangTambah = $qtyAkhrKasir * $keuntunganItemBarang;

    //! Update Qty dan Subtotal Kasir
    $sqlkasir    = "UPDATE kasir SET qty = '$qtyAkhrKasir', sub_total_kasir = '$subtotal', untung_item_kasir = '$keuntunganBarangTambah' WHERE barang_id = '$b' AND nomor_tr = '$Tr' "; 
    $query       = mysqli_query($host, $sqlkasir);

    //! Update Qty dan Subtotal Detail Transaksi
    $sqldetail   = "UPDATE detail_transaksi SET qty = '$qtyAkhrKasir', sub_total = '$subtotal', untung_item_detail = '$keuntunganBarangTambah' WHERE barang_id = '$b' AND nomor_tr = '$Tr' ";
    $query       = mysqli_query($host, $sqldetail);
    
    //! Update Stok Barang
    $sqlStkBrg   = "UPDATE barang SET stok_barang = '$stokAkhrBarang' WHERE id_barang = '$b' "; 
    $query       = mysqli_query($host, $sqlStkBrg);

    if ($query) {
      echo "
        <script>
          window.location.href='../../frontend/barang_keluar/kasir.php?Tr=$Tr&page=barangkeluar';
        </script>
      ";
    } else {
      echo "
        <script>
          alert('Operasi Gagal');
          window.location.href='../../frontend/barang_keluar/kasir.php?Tr=$Tr&page=barangkeluar';
        </script>
      ";
    }
    
  }


  if (isset($_POST['qtyKurang'])) {

    $i          = $_POST['i'];
    $Tr         = $_POST['Tr'];
    $b          = $_POST['b'];
    $qtyawal    = $_POST['qtyawal'];
    $qtykurang  = $_POST['qtykurang'];


    //! Select Harga Barang
    $sqlHargaBrg   = "SELECT * FROM barang WHERE id_barang = '$b' ";
    $queryHargabrg = mysqli_query($host, $sqlHargaBrg);
    $dataHarga     = mysqli_fetch_assoc($queryHargabrg);
    $harga         = $dataHarga['harga_jual_item']; 
    $qtybrg        = $dataHarga['stok_barang']; 

    //! Select Keuntungan Barang
    $sqlSelectKeuntunganBarang   = "SELECT * FROM barang WHERE id_barang = '$b' ";
    $querySelectKeuntunganBarang = mysqli_query($host, $sqlSelectKeuntunganBarang);
    $dataBarang                  = mysqli_fetch_assoc($querySelectKeuntunganBarang);
    $keuntunganItemBarang        = $dataBarang['untung_barang'];

    //! Aritmatika
    $qtyAkhrKasir           = $qtyawal - $qtykurang;
    $stokAkhrBarang         = $qtybrg + $qtykurang;
    $subtotal               = $harga * $qtyAkhrKasir;
    $keuntunganBarangKurang = $qtyAkhrKasir * $keuntunganItemBarang;

    //! Update Qty dan Subtotal Kasir
    $sqlkasir    = "UPDATE kasir SET qty = '$qtyAkhrKasir', sub_total_kasir = '$subtotal', untung_item_kasir = '$keuntunganBarangKurang' WHERE barang_id = '$b' AND nomor_tr = '$Tr' "; 
    $query       = mysqli_query($host, $sqlkasir);

    //! Update Qty dan Subtotal Detail Transaksi
    $sqldetail   = "UPDATE detail_transaksi SET qty = '$qtyAkhrKasir', sub_total = '$subtotal', untung_item_detail = '$keuntunganBarangKurang' WHERE barang_id = '$b' AND nomor_tr = '$Tr' ";
    $query       = mysqli_query($host, $sqldetail);
    
    //! Update Stok Barang
    $sqlStkBrg   = "UPDATE barang SET stok_barang = '$stokAkhrBarang' WHERE id_barang = '$b' "; 
    $query       = mysqli_query($host, $sqlStkBrg);

    //! Select Data Kasir
    $selectDataKasir      = "SELECT * FROM kasir WHERE nomor_tr = '$Tr' AND barang_id = '$b' "; 
    $querySelectDataKasir = mysqli_query($host, $selectDataKasir);
    $data                 = mysqli_fetch_assoc($querySelectDataKasir);
    $qtyBarang            = $data['qty'];

    //! hapus Data Jika qty = 0
    if ($qtyBarang == 0) {

      $hapusDataKasir  = "DELETE FROM kasir WHERE nomor_tr = '$Tr' AND barang_id = '$b' ";
      $queryHapusKasir = mysqli_query($host, $hapusDataKasir);

      $hapusDataDetail  = "DELETE FROM detail_transaksi WHERE nomor_tr = '$Tr' AND barang_id = '$b' ";
      $queryHapusDetail = mysqli_query($host, $hapusDataDetail);
    }

    if ($query) {
      echo "
        <script>
          window.location.href='../../frontend/barang_keluar/kasir.php?Tr=$Tr&page=barangkeluar';
        </script>
      ";
    } else {
      echo "
        <script>
          alert('Operasi Gagal');
          window.location.href='../../frontend/barang_keluar/kasir.php?Tr=$Tr&page=barangkeluar';
        </script>
      ";
    }

  }

  if (isset($_POST['transaksiSelesai'])) {

    $Tr              = $_POST['Tr']; 
    $tgl_hari_ini    = date('Ymd'); 
    $total_transaksi = $_POST['total_transaksi']; 
    $nama_kasir      = $_POST['nama_kasir'];
    $keterangan      = $_POST['keterangan'];


    //! Simpan Laporan Transaksi
    $sqlSimpanTr     = "INSERT INTO laporan_brg_keluar VALUES(0, '$tgl_hari_ini', '$Tr', '$total_transaksi', '$nama_kasir', '$keterangan' )";
    $querySimpanTr   = mysqli_query($host, $sqlSimpanTr); 

    //! Hapus Data Transaksi Pada Tabel Kasir 
    $sqlHapusTr      = "DELETE FROM kasir WHERE nomor_tr = '$Tr' ";
    $queryHapusTr    = mysqli_query($host, $sqlHapusTr);

    if ($queryHapusTr) {
      echo "
        <script>
          window.location.href='../../frontend/barang_keluar/nota.php?Tr=$Tr&page=barangkeluar';
        </script>
      ";
    } else {
      echo "
        <script>
          alert('Operasi Gagal');
          window.location.href='../../frontend/barang_keluar/kasir.php?Tr=$Tr&page=barangkeluar';
        </script>
      ";
    }

  }

?>