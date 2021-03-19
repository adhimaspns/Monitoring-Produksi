<!DOCTYPE html>
<html lang="pt-BR">
	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<title>Monitoring Biaya Produksi | Data Bahan | Tambah Data Bahan Baku</title>

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
				<h3>Edit Data Bahan Baku</h3>

				<div class="breadcrumb">
					<h3>
						<a href="../../../beranda.php?page=beranda">Beranda</a> <i class="fa fa-angle-right"></i>
						<a href="../index.php?page=bahan">Data Bahan</a> <i class="fa fa-angle-right"></i>
						<a href="index.php?page=bahan">Data Bahan Baku</a> <i class="fa fa-angle-right"></i>
						<span class="akhir-link-breadcrumb">Edit Data</span>
					</h3>
				</div>

        <div class="container" style="margin-bottom: 150px;">
          <div class="baris baris-tengah">
            <div class="kolom-50">
              <div class="form-box">
                <h2 class="text-center">Edit Data Bahan Baku</h2>
                <form action="../../../backend/bahan_baku/edit.php" method="POST">
									<?php
										include '../../../database/koneksi.php';

										$id_bahan = $_GET['id_bahan'];

										$sql   ="SELECT * FROM bahan WHERE id_bahan = '$id_bahan' ";
										$query = mysqli_query($host, $sql);

										$data  = mysqli_fetch_assoc($query);

									?>

									<input type="hidden" name="id_bahan" value="<?php echo $data['id_bahan'];?>">

                  <label>Nama Bahan Baku</label>
                  <input type="text" name="nama_bahan" class="form form-edit" value="<?php echo $data['nama_bahan']; ?>">

									<input type="hidden" name="tgl" value="<?php echo $data['tgl']; ?>">

									<label>Kuantitas</label>
									<input type="number" name="kuantitas" class="form form-edit" value="<?php echo $data['kuantitas']; ?>">

                  <label>Satuan</label>
                  <input type="text" name="satuan" class="form form-edit" value="<?php echo $data['satuan']; ?>">

                  <label>Harga</label>
                  <input id="harga" type="text" name="harga" class="form form-edit" value="<?php echo $data['harga']; ?>">

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
