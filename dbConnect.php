<?php 
	define('HOST','localhost');
	define('USER','USER');
	define('PASS','PASS');
	define('DB','DB');
	
	$con = mysqli_connect(HOST,USER,PASS,DB) or die('Unable to Connect');
	?>