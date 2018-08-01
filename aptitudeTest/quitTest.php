<?php 
	include '../dbh.php';
	session_start();
	$email = $_SESSION['email'];
	$faculty = $_SESSION['faculty'];
	if($faculty	== "Science") {
		$sql = "DELETE FROM pointstablescience WHERE email = '$email'";
		$sql1 = "DELETE FROM testscience WHERE email = '$email'";
		
	}else if($faculty == "Management") {
		$sql = "DELETE FROM pointstablemanagement WHERE email = '$email'";
		$sql1 = "DELETE FROM testmanagement WHERE email = '$email'";

	}
	$result = mysqli_query($conn, $sql);
	$result1 = mysqli_query($conn, $sql1);
	if(!$result || !$result1	) {
		echo 'error in completing the action';
	}

	header('Location:../index.php');


 ?>