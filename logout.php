<?php 
include 'include/koneksi.php';
session_start();
session_destroy()
 ?>
 <script type="text/javascript">
 	alert('anda berhasil logout');
 	document.location="<?= baseUrl() ?>";
 </script>