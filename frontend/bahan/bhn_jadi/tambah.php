<?php
	session_start();

	if ($_SESSION['level'] != 'admin') {
		header("location:../../../login.php?pesan=bukanadmin");
	}

?>
<!DOCTYPE html>
<html lang="pt-BR">
	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<title>Monitoring Biaya Produksi | Tambah Data</title>

		<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>

		<link
			rel="stylesheet"
			href="https://cdn.materialdesignicons.com/4.9.95/css/materialdesignicons.min.css"
		/>
		<link
			rel="stylesheet"
			href="https://fonts.googleapis.com/css?family=Roboto&display=swap"
		/>
		<link rel="stylesheet" href="../../../assets/css/main.css" />
		<link rel="stylesheet" href="../../../assets/css/style.css" />
		<link rel="stylesheet" href="../../../assets/css/sidebar.css" />
	</head>
	<body>

		<?php
			include '../../layout/sidebar.php';
		?>

		<main class="main">
			<section>
				<h2>Monitoring Biaya Produksi</h2>
				<h3>Tambah Data Bahan Pendukung</h3>

				<div class="breadcrumb">
					<h3>
						<a href="../../../beranda.php?page=beranda">Beranda</a> <i class="fa fa-angle-right"></i>
						<a href="../index.php?page=bahan">Data Bahan</a> <i class="fa fa-angle-right"></i>
						<a href="index.php?page=bahan">Bahan Pendukung</a> <i class="fa fa-angle-right"></i>
						<span class="akhir-link-breadcrumb">Tambah Data Pendukung</span>
					</h3>
				</div>

        <div class="container" style="margin-bottom: 150px;">
          <div class="baris baris-tengah">
            <div class="kolom-50">
              <div class="form-box">
                <h2 class="text-center">Tambah Data Bahan Pendukung</h2>
                <form action="../../../backend/bhn_jadi/tambah.php" method="POST">

                  <label>Nama Bahan Pendukung</label>
                  <input type="text" name="nama_bahan" class="form" placeholder="Selep Tanah" required>

									<label>Kuantitas</label>
									<input type="number" name="kuantitas" class="form" placeholder="1" required>

                  <label>Satuan</label>
                  <input type="text" name="satuan" class="form" placeholder="Orang" required>

                  <label>Harga Satuan</label>
                  <input id="harga" type="text" name="harga" class="form" required>

                  <button type="submit" name="simpan" class="tmbl tmbl-hijau">
                    Simpan
                  </button>
                  <a href="index.php?page=bahan" class="tmbl tmbl-abu-abu">
                    Kembali
                  </a>
                </form>
              </div>
            </div>
          </div>
        </div>
			</section>
		</main>

    <script src="../../../assets/js/jquery-3.3.1.min.js"></script>
    <script src="../../../assets/js/jquery.maskMoney.min.js"></script>
    <script>
        $('#harga').maskMoney({prefix:'Rp. ',allowNegative:true,thousand:'.',decimal:'.',precision:0,affixesStay:false});
    </script>

	</body>
</html>
