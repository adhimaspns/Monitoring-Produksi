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
              <form action="../../backend/produksi/proses_edit_qty.php" method="POST">

                <?php

                  $id_temp              = $_GET['id_temp'];
                  $produksi_id          = $_GET['produksi_id'];
                  $bhn_id               = $_GET['bhn_id'];

                  $sql   = "SELECT * FROM temp WHERE  id_temp = '$id_temp' ";
                  $query = mysqli_query($host, $sql);
                  $qty   = mysqli_fetch_assoc($query);

                ?>

                <input type="hidden" name="id_temp" value="<?php echo $id_temp?>">
                <input type="hidden" name="produksi_id" value="<?php echo $produksi_id?>">
                <input type="hidden" name="bhn_id" value="<?php echo $bhn_id?>">

                <label>Qty</label>
                <input type="number" name="qty" class="form" value="<?php echo $qty['qty'] ?>">

                <input type="submit" value="Simpan" name="editQtyTemp" class="tmbl tmbl-hijau">
              </form>
            </div>

          </div>

					</div>

				</div>

			</section>

		</main>

		

	</body>
</html>
