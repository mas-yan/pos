<?php 
$page = @$_GET['page'];	
$aksi = @$_GET['aksi'];

if ($page == 'barang') {
	if ($aksi == 'ubah_barang') {
		include 'barang/ubah_barang.php';
	}else{
		include 'barang/barang.php';
	}
}elseif ($page == 'user') {
	include 'user/user.php';
}elseif ($page == 'penjualan') {
	include 'penjualan/penjualan.php';
}


?>