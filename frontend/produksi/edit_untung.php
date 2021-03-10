<?php include '../../database/koneksi.php'; ?>
<!DOCTYPE html>
<html lang="pt-BR">
	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<title>Monitoring Biaya Produksi | Data Jasa</title>

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

		<main class="main">
			<section>

				<!-- <h2>Produksi</h2> -->

				<!-- <div class="breadcrumb">
						<h3>
							<a href="../../beranda.php">Beranda</a> <i class="fa fa-angle-right"></i>
							<span class="akhir-link-breadcrumb">Produksi</span>
						</h3>
				</div> -->

				<div class="container">

					<div class="baris baris-tengah">

          <div class="kolom-50">

            <div class="box-konten margin-top-150">
              <form action="../../backend/produksi/produksi.php" method="POST">

                <?php

                  $produksi_id   = $_GET['produksi_id'];

                  $sql      = "SELECT * FROM produksi WHERE  id_produksi = '$produksi_id' ";
                  $query    = mysqli_query($host, $sql);
                  $untung   = mysqli_fetch_assoc($query);

                ?>

                <input type="hidden" name="id_produksi" value="<?php echo $produksi_id ?>">

                <label>Keinginan Untung Per Item</label>
                <input id="untung" type="text" name="untung_produk" class="form" value="<?php echo $untung['untung_produk'] ?>">

                <input type="submit" value="Simpan" name="editUntung" class="tmbl tmbl-hijau">
                <a href="detail_produksi.php?id_produksi=<?= $produksi_id?>" class="tmbl tmbl-abu-abu">
                  Kembali
                </a>
              </form>
            </div>

          </div>

					</div>

				</div>

			</section>

		</main>

		<script src="../../assets/js/jquery-3.3.1.min.js"></script>
    <script src="../../assets/js/jquery.maskMoney.min.js"></script>
    <script>
        $('#untung').maskMoney({prefix:'Rp. ',allowNegative:true,thousand:'.',decimal:'.',precision:0,affixesStay:false});
    </script>

	</body>
</html>
