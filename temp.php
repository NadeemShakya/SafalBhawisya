<?php 	
		session_start();
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Temp</title>
</head>
<body>
	<?php 
		//insert all fetched question IDS;
		$questionIDS = ['question1', 'question2'];
		$_SESSION['questionArray'] = $questionIDS;
		echo '
			<form action = "validate.php?">
				Question1 <br>	
				<input type="radio" name = "question1" value = "answer1"> Answer 1 <br>
				<input type="radio" name = "question1" value = "answer2"> Answer 2 <br>	
				<input type="radio" name = "question1" value = "answer3"> Answer 3 <br>
				<input type="radio" name = "question1" value = "answer4"> Answer 4 <br>	

				Question2 <br>	
				<input type="radio" name = "question2" value = "answer1"> Answer 1 <br>
				<input type="radio" name = "question2" value = "answer2"> Answer 2 <br>	
				<input type="radio" name = "question2" value = "answer3"> Answer 3 <br>
				<input type="radio" name = "question2" value = "answer4"> Answer 4 <br>	
				<input type = "submit" value = "Submit"> 
			</form>
		';
	 ?>
</body>
</html>