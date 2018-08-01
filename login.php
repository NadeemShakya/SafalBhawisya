<?php
	include 'dbh.php';
	session_start();
	if($_SERVER['REQUEST_METHOD'] == "GET") {
		$email = $_SESSION['login_email'];
		$password = $_SESSION['login_password'];

	}else {
		$email = $_POST['email'];
		$password = $_POST['password'];
	}
	$sql1 = "SELECT * FROM userregistration WHERE email = '$email'";
	$result1 = mysqli_query($conn, $sql1);
	$row = mysqli_fetch_assoc($result1);
	$hashed_password = $row['password'];

	if(password_verify($password, $hashed_password)==1){

		$_SESSION['log'] = true;
		$_SESSION['firstName'] = $row['first_name'];
		$_SESSION['lastName'] = $row['last_name'];
		$_SESSION['email'] = $row['email'];
		header('Location:index.php');
	}
	else{
		header('Location:register.php');
	} 

?>