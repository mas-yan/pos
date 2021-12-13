<?php 
include '../../include/koneksi.php';
session_start();
if (isset($_SESSION['username'])) {
	if ($_SESSION['level'] == 'Admin') {
		?>
		<!doctype html>
		<html lang="en">

		<head>
			<title>Dashboard | Klorofil - Free Bootstrap Dashboard Template</title>
			<meta charset="utf-8">
			<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
			<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
			<!-- VENDOR CSS -->
			<link rel="stylesheet" href="../../assets/vendor/bootstrap/css/bootstrap.min.css">
			<link rel="stylesheet" href="../../assets/vendor/font-awesome/css/font-awesome.min.css">
			<link rel="stylesheet" href="../../assets/vendor/linearicons/style.css">
			<!-- MAIN CSS -->
			<link rel="stylesheet" href="../../assets/css/main.css">
			<!-- GOOGLE FONTS -->
			<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700" rel="stylesheet">
			<!-- ICONS -->
			<link rel="apple-touch-icon" sizes="76x76" href="../../assets/img/apple-icon.png">
			<link rel="icon" type="image/png" sizes="96x96" href="../../assets/img/favicon.png">
			<!-- DataTables -->
			<link rel="stylesheet" href="../../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
			<link rel="stylesheet" href="../../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
		</head>

		<body>
			<!-- WRAPPER -->
			<div id="wrapper">
				<!-- NAVBAR -->
				<nav class="navbar navbar-default navbar-fixed-top">
					<div class="brand">
						<a href="<?= baseUrl('view/admin') ?>"><img src="../../assets/img/logo-dark.png" alt="Klorofil Logo" class="img-responsive logo"></a>
					</div>
					<div class="container-fluid">
						<div class="navbar-btn">
							<button type="button" class="btn-toggle-fullwidth"><i class="lnr lnr-arrow-left-circle"></i></button>
						</div>
						<div id="navbar-menu">
							<ul class="nav navbar-nav navbar-right">
								<li class="dropdown">
									<a href="#" class="dropdown-toggle icon-menu" data-toggle="dropdown">
										<i class="lnr lnr-alarm"></i>
										<span class="badge bg-danger">5</span>
									</a>
									<ul class="dropdown-menu notifications">
										<li><a href="#" class="notification-item"><span class="dot bg-warning"></span>System space is almost full</a></li>
										<li><a href="#" class="notification-item"><span class="dot bg-danger"></span>You have 9 unfinished tasks</a></li>
										<li><a href="#" class="notification-item"><span class="dot bg-success"></span>Monthly report is available</a></li>
										<li><a href="#" class="notification-item"><span class="dot bg-warning"></span>Weekly meeting in 1 hour</a></li>
										<li><a href="#" class="notification-item"><span class="dot bg-success"></span>Your request has been approved</a></li>
										<li><a href="#" class="more">See all notifications</a></li>
									</ul>
								</li>
								<li class="dropdown">
									<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="lnr lnr-question-circle"></i> <span>Help</span> <i class="icon-submenu lnr lnr-chevron-down"></i></a>
									<ul class="dropdown-menu">
										<li><a href="#">Basic Use</a></li>
										<li><a href="#">Working With Data</a></li>
										<li><a href="#">Security</a></li>
										<li><a href="#">Troubleshooting</a></li>
									</ul>
								</li>
								<li class="dropdown">
									<a href="#" class="dropdown-toggle" data-toggle="dropdown"><img src="img/<?= $_SESSION['foto'] ?>" class="img-circle" alt="Avatar"> <span><?= $_SESSION['nama'] ?></span> <i class="icon-submenu lnr lnr-chevron-down"></i></a>
									<ul class="dropdown-menu">
										<li><a href="#"><i class="lnr lnr-user"></i> <span>My Profile</span></a></li>
										<li><a href="#"><i class="lnr lnr-envelope"></i> <span>Message</span></a></li>
										<li><a href="#"><i class="lnr lnr-cog"></i> <span>Settings</span></a></li>
										<li><a href="../../logout.php" onclick="return confirm('yakin ingin logout')"><i class="lnr lnr-exit"></i> <span>Logout</span></a></li>
									</ul>
								</li>
							</ul>
						</div>
					</div>
				</nav>
				<!-- END NAVBAR -->
				<?php include 'layout/menu.php'; ?>		
				<!-- MAIN -->
				<div class="main">
					<!-- MAIN CONTENT -->
					<div class="main-content">
						<div class="container-fluid">
							<?php include 'layout/main.php' ?>
						</div>
					</div>
					<!-- END MAIN CONTENT -->
				</div>
				<!-- END MAIN -->
				<div class="clearfix"></div>
				<footer>
					<div class="container-fluid">
						<p class="copyright">&copy; 2017 <a href="https://www.themeineed.com" target="_blank">Theme I Need</a>. All Rights Reserved.</p>
					</div>
				</footer>
			</div>
			<!-- END WRAPPER -->
			<!-- Javascript -->
			<script src="../../assets/vendor/jquery/jquery.min.js"></script>
			<script src="../../assets/vendor/bootstrap/js/bootstrap.min.js"></script>
			<script src="../../assets/vendor/jquery-slimscroll/jquery.slimscroll.min.js"></script>
			<script src="../../assets/scripts/klorofil-common.js"></script>
			<!-- DataTables -->
			<script src="../../plugins/datatables/jquery.dataTables.min.js"></script>
			<script src="../../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
			<script src="../../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
			<script src="../../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>

			<script type="text/javascript">
				$(function () {
					$("#example1").DataTable({
						"responsive": true,
						"autoWidth": false,
					});
					$('#example2').DataTable({
						"paging": true,
						"lengthChange": false,
						"searching": false,
						"ordering": true,
						"info": true,
						"autoWidth": false,
						"responsive": true,
					});
				});

				$(function () {
					$('[data-toggle="tooltip"]').tooltip()
				})
			</script>

		</body>

		</html>
		<?php 
	}else{
		?>
		<script type="text/javascript">
			alert('level salah');
			document.location="<?= baseUrl() ?>";
		</script>
		<?php
	}
}else{
	?>
	<script type="text/javascript">
		alert('belum login');
		document.location="<?= baseUrl() ?>";
	</script>
	<?php
}
?>