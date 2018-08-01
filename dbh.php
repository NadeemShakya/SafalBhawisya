<?php
	$conn = mysqli_connect("localhost","root","","safalbhawisya");
	if (!$conn){
		echo 'Connection failed';
		// die("Connection_error". mysqli_connect_error);
	}
?>