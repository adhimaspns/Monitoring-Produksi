<?php
	session_start();

	if ($_SESSION['level'] != 'admin') {
		header("location:../../login.php?pesan=bukanadmin");
	}

	include '../../database/koneksi.php';
?>
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

				<div class="container">

					<div class="baris baris-tengah">

          <div class="kolom-50">

            <div class="box-konten margin-top-150">
              <form action="../../backend/produksi/proses_edit_qty_detail_produksi.php" method="POST">

                <?php

                  $idp   = $_GET['idp'];
                  $pid   = $_GET['pid'];
                  $bid   = $_GET['bid'];

                  $sql   = "SELECT * FROM detail_produksi INNER JOIN bahan ON detail_produksi.bhn_id = bahan.id_bahan WHERE  id_detail_produksi = '$idp' ";
                  $query = mysqli_query($host, $sql);
                  $qty   = mysqli_fetch_assoc($query);

                ?>

                <input type="hidden" name="id_detail_produksi" value="<?php echo $idp?>">
                <input type="hidden" name="produksi_id" value="<?php echo $pid?>">
                <input type="hidden" name="bhn_id" value="<?php echo $bid?>">

                <label>Bahan</label>
                <input type="text" class="form" value="<?php echo $qty['nama_bahan']?>" readonly>

                <label>Qty</label>
                <input type="number" name="qty" class="form" value="<?php echo $qty['qty'] ?>">

                <input type="submit" value="Simpan" name="editQtyTemp" class="tmbl tmbl-hijau">
                <a href="edit_detail_produksi.php?ip=<?php echo $pid ?>&page=produksi" class="tmbl tmbl-abu-abu">
                  Kembali
                </a>
              </form>
            </div>

          </div>

					</div>

				</div>

			</section>

		</main>

		

	</body>
</html>
