<?php 	
		include '../dbh.php';
		session_start();
		// taking the user's email ID.
		$email = $_SESSION['email'];
		$faculty =$_SESSION['faculty'];
		if($faculty == 'Science') {

			$info_sql = "SELECT * FROM testscience WHERE email = '$email'";
			$info_result = mysqli_query($conn, $info_sql);
			while($row = mysqli_fetch_assoc($info_result)) {
				$questionID = $row['questionID'];
				$userAnswer = $row['userAnswer'];
				$sql1 = "SELECT * FROM questionsscience WHERE questionID = '$questionID'";
				$result1 = mysqli_query($conn, $sql1);
				$row1 = mysqli_fetch_assoc($result1);
				$correctAnswer = $row1['answer'];

				echo 'useranswer:'.$userAnswer.'<br>'	;
				echo 'correctAnswer'.$correctAnswer. '<br>	'	;
				$category = $row1['Category'];
				

				// if answer matches then add it iinto the pointstablescience in database.
				if($userAnswer == $correctAnswer) {

						$sql = "SELECT * FROM pointstablescience WHERE email = '$email' AND Category = '$category'";
						$result = mysqli_query($conn, $sql);
						$row = mysqli_fetch_assoc($result);

						if(mysqli_num_rows($result) == 0) {
							echo 'SAME:no value'; echo '<br>';
							$sql = "INSERT INTO pointstablescience VALUES('$email', '$category', 1)";
							$result = mysqli_query($conn, $sql);
						}else {
							echo 'SAME:yes value'; echo '<br>';	
							$initialPoint = $row['points'];
							$updatedPoint = $initialPoint + 1;
							$sql = "UPDATE pointstablescience SET points = '$updatedPoint' WHERE email = '$email' AND Category = '$category'" ;
							$result = mysqli_query($conn, $sql);
						}

				}else {
					$sql = "SELECT * FROM pointstablescience WHERE email = '$email' AND Category = '$category'";
					$result = mysqli_query($conn, $sql);
					$count_rows = mysqli_num_rows($result);

					if($count_rows == 0) {
						echo 'DIFFERENT: No value';
						echo '<br>';
						$sql = "INSERT INTO pointstablescience	 VALUES('$email', '$category', 0)";
						$result = mysqli_query($conn, $sql);
						if(!$result) {
							echo 'error';	
						}
					}else {
						// do nothing.
					}

				}
			}					
		}else if($faculty == 'Management'){
			$info_sql = "SELECT * FROM testmanagement WHERE email = '$email'";
			$info_result = mysqli_query($conn, $info_sql);
			while($row = mysqli_fetch_assoc($info_result)) {
				$questionID = $row['questionID'];
				$userAnswer = $row['userAnswer'];
				$sql1 = "SELECT * FROM questionmanagement WHERE questionID = '$questionID'";
				$result1 = mysqli_query($conn, $sql1);
				$row1 = mysqli_fetch_assoc($result1);
				$correctAnswer = $row1['answer'];

				echo 'useranswer:'.$userAnswer.'<br>'	;
				echo 'correctAnswer'.$correctAnswer. '<br>	'	;
				$category = $row1['Category'];
				

				// if answer matches then add it iinto the pointstablescience in database.
				if($userAnswer == $correctAnswer) {

						$sql = "SELECT * FROM pointstablemanagement WHERE email = '$email' AND Category = '$category'";
						$result = mysqli_query($conn, $sql);
						$row = mysqli_fetch_assoc($result);

						if(mysqli_num_rows($result) == 0) {
							echo 'SAME:no value'; echo '<br>';
							$sql = "INSERT INTO pointstablemanagement VALUES('$email', '$category', 1)";
							$result = mysqli_query($conn, $sql);
						}else {
							echo 'SAME:yes value'; echo '<br>';	
							$initialPoint = $row['points'];
							$updatedPoint = $initialPoint + 1;
							$sql = "UPDATE pointstablemanagement SET points = '$updatedPoint' WHERE email = '$email' AND Category = '$category'" ;
							$result = mysqli_query($conn, $sql);
						}

				}else {
					$sql = "SELECT * FROM pointstablemanagement WHERE email = '$email' AND Category = '$category'";
					$result = mysqli_query($conn, $sql);
					$count_rows = mysqli_num_rows($result);

					if($count_rows == 0) {
						echo 'DIFFERENT: No value';
						echo '<br>';
						$sql = "INSERT INTO pointstablemanagement VALUES('$email', '$category', 0)";
						$result = mysqli_query($conn, $sql);
						if(!$result) {
							echo 'error';	
						}
					}else {
						// do nothing.
					}

				}
			}	
			}

		header('Location:result.php');
 ?>