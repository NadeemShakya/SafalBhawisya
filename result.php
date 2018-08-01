<?php 	
		include 'dbh.php';
		session_start();
		$email = $_SESSION['email'];
		$faculty = 'Science';
		if($faculty == 'Science') {

			$sql1 = "SELECT * FROM testscience WHERE email = '$email'";
			$result1 = mysqli_query($conn, $sql1);
			while($row = mysqli_fetch_assoc($result1)) {
				$userAnswer	 = $row['userAnswer'];
				$questionID = $row['questionID'];
				$sql2 = "SELECT * FROM questionsscience WHERE questionID = '$questionID'";
				$result2 = mysqli_query($conn, $sql2);
				$row2 = mysqli_fetch_assoc($result2);
				$question = $row2['question'];
				echo $question. '<br>';
				$answer = $row2['answer'];
				echo 'Correct Answer:'.$answer. '<br>';
				echo 'Your Answer:'. $userAnswer. '<br>';
			}

			$sql = "SELECT * FROM pointstablescience WHERE email = '$email'";
			$result = mysqli_query($conn, $sql);
			while($row = mysqli_fetch_assoc($result)) {
				$category = $row['Category'];
				echo '<br>';
				$points = $row['points'];
				echo '<br>';
				echo $category;
				echo '<br>';
				echo $points;
				// minimum threshold is 2 now.
				// must be 8 if there are 15 questions.
				if($points < 2) {
					echo 'You need to brush up !';
				}else if($points >=2 ) {
					echo 'You have good understanding in these subjects!';
				}  
			}
		}else if($faculty == 'Management') {
			// Taking the array which contains the QuestionID, User's Answer and Correct Answer.
			for($i = 0; $i <= $length - 1; $i++) {
				// fetching the questionID
				$questionID = $questionAnswerArray[$i][0];
				// fetching the user's answer.
				$userAnswer = $questionAnswerArray[$i][1];
				// fetching the correct answer of the question from the database.
				$correctAnswer = $questionAnswerArray[$i][2];	

				$sql = "SELECT * FROM questionmanagement WHERE questionID = '$questionID'";
				$result = mysqli_query($conn, $sql);
				$row = mysqli_fetch_assoc($result);	
				// Display the Question, It's Correct Answer and User's Answer.	
				echo $row['question']; 
				echo '<br>';
				echo '<br>';
				echo 'Correct Answer: '. $correctAnswer.'';
				echo '<br>';
				echo '<br>';
				echo 'Your Answer: '.$userAnswer.'';
				echo '<br>';
				echo '<br>';
			}
			// Section to display the PROGRESS RESULT.
			// Good in GK, Weak in English etc.
			$sql = "SELECT * FROM pointstablemanagement WHERE email = '$email'";
			$result = mysqli_query($conn, $sql);
			while($row = mysqli_fetch_assoc($result)) {
				$category = $row['Category'];
				echo '<br>';
				$points = $row['points'];
				echo '<br>';
				echo $category;
				echo '<br>';
				echo $points;
				// minimum threshold is 2 now.
				// must be 8 if there are 15 questions.
				if($points < 2) {
					echo 'You need to brush up !';
				}else if($points >=2 ) {
					echo 'You have good understanding in these subjects!';
				}  
			}
		}
		// section to handle the user's data.
		echo '
			<form action="handleProgressData.php" method = "POST">
				<input type="submit" value = "GO BACK">
			</form>
		';
		// echo '<pre>'; print_r($questionAnswerArray); echo '</pre>';

 ?>