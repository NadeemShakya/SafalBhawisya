<?php 
	include '../dbh.php';
	session_start(); 
	$faculty = $_POST['faculty'];

 ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Rules and Regulations</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="../css/rulesandregulations.css">
    <link rel="icon" href="../image/logo.png">
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,500,700" rel="stylesheet">
</head>
<body>

	<div class = "mainWrapper">
		<div class = "leftDiv">
				<h1>Rules and Regulations</h1>
				<p>Rule1: You must attempt the question for proceeding forward.</p>
				<p>Rule2: You are allowed to change the selected option as many times you like.</p>
				<p>Rule3: You are allowed to use calculator of your own.</p>
				<p>Rule4: There isn't any negative marking so attempt all the questions.</p>
				<p>Rule5: You must login with same registered ID to keep track of progress reports.</p>
				<p>Rule6: Whatever advises the test suggest will be based on your score, so focus on those topics and improve accordingly.</p>
				<p>Rule7: The criterion for best test is all correct so take your time and answer the questions.</p>
				<p>Rule8: You can take as many tests as you like.</p>
				
				<form action = "aptitudeTest.php" method = "POST">
					<input type="hidden" name = 'faculty' value = "<?php echo $faculty ?>" >
					<button>Agree and Submit</button>
				</form>

		</div>
		<div class = "rightDiv">
				<img src="../image/rulesandregulations.png" alt="please_reload">
		</div>

	</div>
	
</body>
</html>