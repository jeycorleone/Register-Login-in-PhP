<?php 
	$servername = "localhost";
	$password = "123";
	$username = "joe";
	$db_name = "database_1";
	$conn = new mysqli($servername, $username, $password, $db_name);
	if (!$conn) {
		echo 'Connection Error';
	}
	else{
		echo '';
	}

 ?>