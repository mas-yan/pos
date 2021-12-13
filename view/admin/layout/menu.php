<?php 

include 'kode_pj.php';

$page = @$_GET['page'];
	
	if ($page == 'user') {
		$user = 'active';
		$active = '';
		$collapse = 'collapse';
	}
	if ($page == 'barang') {
		$active = 'active';
		$bractive = 'active';
	}if ($page == 'penjualan') {
		$active = 'active';
		$pjactive = 'active';
	}
	if ($page == '') {
		$dashboard = 'active';
		$collapse = 'collapse';
		$active  = '';
	}
?>
<!-- LEFT SIDEBAR -->
<div id="sidebar-nav" class="sidebar">
	<div class="sidebar-scroll">
		<nav>
			<ul class="nav">
				<li><a href="<?= baseUrl('view/admin') ?>" class="<?= $dashboard ?>"><i class="lnr lnr-home"></i> <span>Dashboard</span></a></li>
				<li>
					<a href="#subPages" data-toggle="collapse" class="collapsed <?= $active ?>"><i class="lnr lnr-file-empty"></i> <span>Pages</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
					<div id="subPages" class="<?= $collapse; $active ?>">
						<ul class="nav">
							<li><a href="<?= baseUrl('view/admin?page=barang') ?>" class="collapsed <?= $bractive ?>">Barang</a></li>
							<li><a href="?page=penjualan&kode=<?= $kode ?>" class="<?= $pjactive ?>">Penjualan</a></li>
							<li><a href="page-lockscreen.html" class="">Lockscreen</a></li>
						</ul>
					</div>
				</li>
				<li><a href="<?= baseUrl('view/admin?page=user') ?>" class="<?= $user ?>"><i class="lnr lnr-user"></i> <span>User</span></a></li>
				<li>
			</ul>
		</nav>
	</div>
</div>
<!-- END LEFT SIDEBAR -->
