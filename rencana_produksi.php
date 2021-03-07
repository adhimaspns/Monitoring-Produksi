<?php include'database/koneksi.php'; ?>

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
		<link rel="stylesheet" href="./assets/css/main.css" />
		<link rel="stylesheet" href="./assets/css/style.css" />
		<link rel="stylesheet" href="./assets/css/sidebar.css" />
	</head>
	<body>
		<aside class="sidebar">
			<nav>
				<ul class="sidebar__nav">
					<li>
						<a href="#" class="sidebar__nav__link sidebar-active">
							<i class="fa fa-home"></i>
							<span class="sidebar__nav__text">Beranda</span>
						</a>
					</li>
					<li>
						<a href="#" class="sidebar__nav__link">
							<i class="fas fa-archive"></i>
							<span class="sidebar__nav__text">Data Bahan</span>
						</a>
					</li>
					<li>
						<a href="#" class="sidebar__nav__link">
							<i class="fas fa-calendar-check"></i>
							<span class="sidebar__nav__text">Rencana Produksi</span>
						</a>
					</li>
					<li>
						<a onclick="return confirm('Anda yakin ingin logout ?')" href="#" class="sidebar__nav__link link-lgout">
							<i class="fas fa-user"></i>
							<span class="sidebar__nav__text">Logout</span>
						</a>
					</li>
				</ul>
			</nav>
		</aside>

		<main class="main">
			<section>
				<h2>Title 1</h2>
				<div class="breadcrumb">
						<h3>
							<a href="">Beranda</a> <i class="fa fa-angle-right"></i>
							<a href="">Data Bahan</a> <i class="fa fa-angle-right"></i>
							<span class="akhir-link-breadcrumb">Tambah Data</span>
						</h3>
				</div>

        <div class="container">
          <div class="baris baris-tengah">
            <div class="kolom-100">

                <center>
                  <div class="box-header-radius background-biru m">
                    <h2 class="teks-putih margin-top-10">Rencana Produksi</h2>
                  </div>
                </center>

                <div class="table-box">
                  <table class="table-responsive">
                    <tr>
                      <th>No</th>
                      <th>Nama Produk</th>
                      <th>Aksi</th>
                    </tr>

										<?php
										
											$nomor  = 1;
											$sql    = "SELECT * FROM rencana_produksi";
											$query  = mysqli_query($host, $sql);

											while ($data = mysqli_fetch_assoc($query)) {
											
										?>

										<tr>
											<td><?php echo $nomor++?></td>
											<td><?php echo $data['nama_produk'];?></td>
											<td>
												<a href="detail_rencana.php?id_rencana_produksi=<?php echo $data['id_rencana_produksi']?>" class="tmbl tmbl-biru">
													<i class="fa fa-eye"></i>
												</a>
											</td>
										</tr>

										<?php
											}
										?>
                  </table>
                </div>

            </div>
          </div>
        </div>

			</section>

		</main>

    <script>
      // Get the modal
      var modal = document.getElementById("myModal");
      
      // Get the button that opens the modal
      var btn = document.getElementById("myBtn");
      
      // Get the <span> element that closes the modal
      var span = document.getElementsByClassName("close")[0];
      
      // When the user clicks the button, open the modal 
      btn.onclick = function() {
        modal.style.display = "block";
      }
      
      // When the user clicks on <span> (x), close the modal
      span.onclick = function() {
        modal.style.display = "none";
      }
      
      // When the user clicks anywhere outside of the modal, close it
      window.onclick = function(event) {
        if (event.target == modal) {
          modal.style.display = "none";
        }
      }
    </script>



	</body>
</html>
