<?php 

$conn = mysqli_connect("localhost","root","","pos") or die(mysqli_connect_error($conn));


function baseUrl($url = null){
	$baseUrl = "http://localhost/pos";

	if ($url != null) {
		return $baseUrl."/".$url;
	}
	else{
		return $baseUrl;
	}
}

 ?>