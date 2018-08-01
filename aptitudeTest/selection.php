<?php 
	include '../dbh.php';
	session_start();
	if(!isset($_SESSION['log'])) {
		header('Location:../register.php');
	}
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Aptitude Test</title>
    <link rel="icon" href="../image/logo.png">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,500,700" rel="stylesheet"></head>
	<link rel="stylesheet" href="../css/selection.css">
</head>
<body>
	<div class = "mainWrapper">
		<div class = "leftDiv" id = "leftDivID">
			<div class = "fakeWrapper">
			</div>
			<div class = "info">
			<img src="../image/management.png" alt="please_reload" class = 'leftDiv_icon'>
			<h2 id = 'managementHeaderID' class = 'management'>MANAGEMENT</h2>
			<?php 
				echo '<form action = "rulesandregulations.php" method = "POST">
					<button value = "Management" name = "faculty" class = "testButton" id = "managementButton">TAKE TEST</button>
				</form>';

			 ?>
			</div>
		</div>
		<div class = "rightDiv" id = "rightDivID">
			<div class = "fakeWrapper">
			</div>
			<div class = "info">
			<img src="../image/science.png" alt="please_reload" class = 'rightDiv_icon'>
			<h2>SCIENCE</h2>
			<?php 
				echo '<form action = "rulesandregulations.php" method = "POST">
					<button value = "Science" name = "faculty" class = "testButton" id = "scienceButton">TAKE TEST</button>
				</form>';

			 ?>
			</div>
		</div>
	</div>
<script src = '../js/selection.js'></script>
</body>
</html>
