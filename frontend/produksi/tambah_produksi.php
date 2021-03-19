<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Monitoring Biaya Produksi | </title>

  <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>

  <link
    rel="stylesheet"
    href="https://cdn.materialdesignicons.com/4.9.95/css/materialdesignicons.min.css"
  />
  <link
    rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Roboto&display=swap"
  />
  <link rel="stylesheet" href="../../assets/css/main.css" />
  <link rel="stylesheet" href="../../assets/css/style.css" />
  <link rel="stylesheet" href="../../assets/css/sidebar.css" />


</head>
<body>

  <?php
		include '../layout/sidebar.php';
	?>

    <main class="main">
			<section>
        <h2>Monitoring Biaya Produksi</h2>
				<h3>Tambah Produksi Baru</h3>
				<div class="breadcrumb">
          <h3>
            <a href="../../beranda.php?page=beranda">Beranda</a> <i class="fa fa-angle-right"></i>
            <a href="index.php?page=produksi">Produksi</a> <i class="fa fa-angle-right"></i>
            <span class="akhir-link-breadcrumb">Tambah Data Produksi</span>
          </h3>
				</div>

        <div class="container">
          <div class="baris baris-tengah">
            <div class="kolom-50">
              <center>
                <div class="box-header-radius background-biru">
                  <h2 class="teks-putih margin-top-10">Tambah Produksi Baru</h2>
                </div>
              </center>
              <div class="box-konten-radius padding-20 margin-top-10">
                <form action="../../backend/temp/tambah_bahan.php" method="POST">

                  <label>Nama Produk</label>
                  <input type="text" name="nama_produk" class="form" placeholder="Cowek">

                  <label>Estimasi Barang Jadi </label>
                  <input type="number" name="stok_pra_produksi" class="form" placeholder="1000">

                  <label>Satuan Barang Jadi</label>
                  <input type="text" name="satuan_pra_produksi" class="form" placeholder="Pcs / Pak / Biji / dst. ">

                  <label>Keinginan Untung Per Item</label>
                  <input id="untung" type="text" name="untung_pra_produksi" class="form">

                  <button type="submit" name="btnbuat" class="tmbl tmbl-biru">
                    Buat
                  </button>
                  <a href="index.php?page=produksi" class="tmbl tmbl-abu-abu">
                    Kembali
                  </a>
                </form>
              </div>
            </div>
          </div>
        </div>
			</section>
		</main>

    <!-- JavaScript -->

      <!-- Mask Money -->
      <script src="../../assets/js/jquery-3.3.1.min.js"></script>
      <script src="../../assets/js/jquery.maskMoney.min.js"></script>
      <script>
          $('#untung').maskMoney({prefix:'Rp. ',allowNegative:true,thousand:'.',decimal:'.',precision:0,affixesStay:false});
      </script>
</body>
</html>