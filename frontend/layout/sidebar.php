
		<aside class="sidebar">
			<nav>
				<ul class="sidebar__nav">
					<li>
						<a href="/Monitoring/beranda.php?page=beranda" class="sidebar__nav__link <?php if($_GET['page'] == 'beranda'){  ?>sidebar-active <?php }?>">
							<i class="fa fa-home"></i>
							<span class="sidebar__nav__text">Beranda</span>
						</a>
					</li>
					<li>
						<a href="/Monitoring/frontend/bahan/index.php?page=bahan" class="sidebar__nav__link <?php if($_GET['page'] == 'bahan'){  ?>sidebar-active <?php } ?>">
							<i class="fas fa-archive"></i>
							<span class="sidebar__nav__text">Data Bahan</span>
						</a>
					</li>
					<!-- <li>
						<a href="/Monitoring/frontend/bhn_jadi/index.php?page=bahanjadi" class="sidebar__nav__link <?php if($_GET['page'] == 'bahanjadi'){  ?>sidebar-active <?php } ?>">
							<i class="fas fa-people-carry"></i>
							<span class="sidebar__nav__text">Bahan Jadi</span>
						</a>
					</li> -->
					<li>
						<a href="/Monitoring/frontend/produksi/index.php?page=produksi" class="sidebar__nav__link <?php if($_GET['page'] == 'produksi'){  ?>sidebar-active <?php } ?>">
							<i class="fas fa-hammer"></i>
							<span class="sidebar__nav__text">Produksi</span>
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
