<!DOCTYPE html>
<html lang="pt-BR">
	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<title>Monitoring Biaya Produksi | Beranda</title>

		<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>

		<link
			rel="stylesheet"
			href="https://cdn.materialdesignicons.com/4.9.95/css/materialdesignicons.min.css"
		/>
		<link
			rel="stylesheet"
			href="https://fonts.googleapis.com/css?family=Roboto&display=swap"
		/>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
		<link rel="stylesheet" href="assets/css/main.css" />
		<link rel="stylesheet" href="assets/css/style.css" />
		<link rel="stylesheet" href="assets/css/sidebar.css" />
	</head>
	<body>
	<?php
		include 'database/koneksi.php';
	?>
		<main class="main">
			<section>
				<h2 class="teks-center">
					Monitoring Biaya Produksi
				</h2>
				<h3 class="text-right">
					<span class="lencana-radius lencana-biru" id="span"></span>
				</h3>

				<div class="container margin-bottom-100">
					<div class="baris baris-tengah">
            <div class="kolom-50">
              <?php
                if (isset($_GET['pesan'])) {
                  if ($_GET['pesan'] == "gagal") {
                    echo "
                      <div class='alert margin-20-0'>
                        Username & Password Tidak Cocok!
                        <a href='login.php' class='float-right teks-putih'>
                          <i class='fas fa-times'></i>
                        </a>
                      </div>
                    ";
                  } 
                }
              
              ?>
              
              <div class="box-konten-radius backgorund-e7 padding-20">
                <center>
                  <div class="box-header-radius-80 background-biru margin-bottom-50">
                    <h2 class="teks-putih">Form Login</h2>
                  </div>
                </center>

                <form action="backend/login/proses_login.php" method="POST">
                  <label>Username</label>
                  <input type="text" name="username" class="form-radius" required>

                  <label>Password</label>
                  <input type="password" name="password" class="form-radius" required>

                  <center>
                    <input type="submit" name="tombol-login" class="tmbl-radius tmbl-biru margin-20-0" value="Login">
                  </center>
                </form>
              </div>
            </div>
          </div>
				</div>
				
      </section>

		</main>

		<script>
			var span = document.getElementById('span');

			function time() {
				var d = new Date();
				var s = d.getSeconds();
				var m = d.getMinutes();
				var h = d.getHours();
				span.textContent = 
					("0" + h).substr(-2) + ":" + ("0" + m).substr(-2) + ":" + ("0" + s).substr(-2);
			}

			setInterval(time, 1000);

		</script>

	</body>
</html>
