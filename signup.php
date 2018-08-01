<?php

	include 'dbh.php';
	session_start();
	$first_name = $_POST['first_name'];
	$last_name = $_POST['last_name'];
	$password = $_POST['password'];
	$hashed_password = password_hash($password,PASSWORD_DEFAULT);
	$address = $_POST['address'];
	$email = $_POST['email'];
	$fileName = $_FILES['file']['name'];
	$fileType = $_FILES['file']['type'];
	$fileTempName= $_FILES['file']['tmp_name'];
	$fileExt = explode('.', $fileName);
	$fileActualExtension = strtolower(end($fileExt));


	$sql_check = "SELECT * FROM userregistration WHERE email = '$email'";
	$result_check = mysqli_query($conn, $sql_check);
	$row_count = mysqli_num_rows($result_check);
	if($row_count != 0) {
		echo 'duplicate entry';
	}else if($row_count == 0) {
		$fileNameNew = uniqid('', true).".".$fileActualExtension;
		$fileDestination = 'profilePics/'.$fileNameNew;
		move_uploaded_file($fileTempName, $fileDestination);
		$sql = "INSERT INTO userregistration(first_name, last_name, password, address, email, method) VALUES('$first_name','$last_name','$hashed_password', '$address', '$email', 'SafalBhawishya')";
		$result = mysqli_query($conn, $sql);
		$_SESSION['login_email'] = $email;
		$_SESSION['login_password'] = $password;
		header('Location:login.php');
	}


?>