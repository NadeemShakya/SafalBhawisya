<?php 
	// connecting google and database login
	include 'gpConfig.php';
	include 'User.php';
	include 'dbh.php';
 ?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Aptitude Test</title>
	<link rel="stylesheet" href="css/main.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,500,700" rel="stylesheet"></head>

</head>
	  <?php 
	   // array to hold all the questionsscience' QuestionID which have been fetched
	  	$questionIDArray = [];
	  	// check whether the user is logged in or not
	  	if(isset($_SESSION['log'])) {

	 		// checking faculty after choice entered by user.
			if($_SERVER['REQUEST_METHOD'] == 'POST') {
				//question display  section after faculty chosen.
				$faculty = $_POST['faculty'];
				// Creating faculty as Session Variable for data handling purposes.
				$_SESSION['faculty'] = $faculty;

				if($faculty == 'Science') {
					// select the Question Category Randomly to be displayed.
					$category = [];
					$sql = "SELECT * FROM aptitudetestscience ORDER BY RAND()";
					$result = mysqli_query($conn, $sql);
					while($row = mysqli_fetch_assoc($result)) {
						array_push($category, $row['Category']);
					}
					// form action targeted to addPoints.php
	  				echo '<form action="addPoints.php" method = "POST">';
					//fetching 15 questionsscience of randomly.
					$questionFetch_sql = "SELECT * FROM questionsscience WHERE Category = '$category[0]' ORDER BY RAND() LIMIT 15 ";
					$questionFetch_result = mysqli_query($conn, $questionFetch_sql);
					// fetch a question.
					while($questionFetch_row = mysqli_fetch_assoc($questionFetch_result)) {
						array_push($questionIDArray, $questionFetch_row['questionID']);
						echo $questionFetch_row['question'];
						echo '<br>';
						// fetch the questionID.
						$questionID = $questionFetch_row['questionID'];
						// fetch the question's optionsscience..
						$answerFetch_sql = "SELECT * FROM optionsscience WHERE questionID = '$questionID' ORDER BY RAND()";
						$answerFetch_result = mysqli_query($conn, $answerFetch_sql);
						while($answerFetch_row = mysqli_fetch_assoc($answerFetch_result)) {
							// display the choices of question as radio buttons with value as choice and name as questionID.
							echo '<input type = "radio" value = "'.$answerFetch_row['choice'].'" name = "'.$questionFetch_row['questionID'].'">'.$answerFetch_row['choice'].'';
							echo '';
							echo '<br>';
						}
				
						echo '<br>';
					}

					//fetching 15 questionsscience randomly.
					$questionFetch_sql = "SELECT * FROM questionsscience WHERE Category = '$category[1]' ORDER BY RAND() LIMIT 15 ";
					$questionFetch_result = mysqli_query($conn, $questionFetch_sql);
					// fetch a question.
					while($questionFetch_row = mysqli_fetch_assoc($questionFetch_result)) {
						array_push($questionIDArray, $questionFetch_row['questionID']);
						echo $questionFetch_row['question'];
						echo '<br>';
						// fetch the questionID.
						$questionID = $questionFetch_row['questionID'];
						// fetch the question's optionsscience..
						$answerFetch_sql = "SELECT * FROM optionsscience WHERE questionID = '$questionID' ORDER BY RAND()";
						$answerFetch_result = mysqli_query($conn, $answerFetch_sql);
						while($answerFetch_row = mysqli_fetch_assoc($answerFetch_result)) {
							// display the choices of question as radio buttons with value as choice and name as questionID.
							echo '<input type = "radio" value = "'.$answerFetch_row['choice'].'" name = "'.$questionFetch_row['questionID'].'">'.$answerFetch_row['choice'].'';
							echo '';
							echo '<br>';
						}
					}
					//fetching 15 questionsscience randomly.
					$questionFetch_sql = "SELECT * FROM questionsscience WHERE Category = '$category[2]' ORDER BY RAND() LIMIT 15 ";
					$questionFetch_result = mysqli_query($conn, $questionFetch_sql);
					// fetch a question.
					while($questionFetch_row = mysqli_fetch_assoc($questionFetch_result)) {
						array_push($questionIDArray, $questionFetch_row['questionID']);
						echo $questionFetch_row['question'];
						echo '<br>';
						// fetch the questionID.
						$questionID = $questionFetch_row['questionID'];
						// fetch the question's optionsscience..
						$answerFetch_sql = "SELECT * FROM optionsscience WHERE questionID = '$questionID' ORDER BY RAND()";
						$answerFetch_result = mysqli_query($conn, $answerFetch_sql);
						while($answerFetch_row = mysqli_fetch_assoc($answerFetch_result)) {
							// display the choices of question as radio buttons with value as choice and name as questionID.
							echo '<input type = "radio" value = "'.$answerFetch_row['choice'].'" name = "'.$questionFetch_row['questionID'].'">'.$answerFetch_row['choice'].'';
							echo '';
							echo '<br>';
						}
					}
					//fetching 15 questionsscience randomly.
					$questionFetch_sql = "SELECT * FROM questionsscience WHERE Category = '$category[3]' ORDER BY RAND() LIMIT 15 ";
					$questionFetch_result = mysqli_query($conn, $questionFetch_sql);
					// fetch a question.
					while($questionFetch_row = mysqli_fetch_assoc($questionFetch_result)) {
						array_push($questionIDArray, $questionFetch_row['questionID']);
						echo $questionFetch_row['question'];
						echo '<br>';
						// fetch the questionID.
						$questionID = $questionFetch_row['questionID'];
						// fetch the question's optionsscience..
						$answerFetch_sql = "SELECT * FROM optionsscience WHERE questionID = '$questionID' ORDER BY RAND()";
						$answerFetch_result = mysqli_query($conn, $answerFetch_sql);
						while($answerFetch_row = mysqli_fetch_assoc($answerFetch_result)) {
							// display the choices of question as radio buttons with value as choice and name as questionID.
							echo '<input type = "radio" value = "'.$answerFetch_row['choice'].'" name = "'.$questionFetch_row['questionID'].'">'.$answerFetch_row['choice'].'';
							echo '';
							echo '<br>';
						}
					}
					//fetching 15 questionsscience randomly.
					$questionFetch_sql = "SELECT * FROM questionsscience WHERE Category = '$category[4]' ORDER BY RAND() LIMIT 15 ";
					$questionFetch_result = mysqli_query($conn, $questionFetch_sql);
					// fetch a question.
					while($questionFetch_row = mysqli_fetch_assoc($questionFetch_result)) {
						array_push($questionIDArray, $questionFetch_row['questionID']);
						echo $questionFetch_row['question'];
						echo '<br>';
						// fetch the questionID.
						$questionID = $questionFetch_row['questionID'];
						// fetch the question's optionsscience..
						$answerFetch_sql = "SELECT * FROM optionsscience WHERE questionID = '$questionID' ORDER BY RAND()";
						$answerFetch_result = mysqli_query($conn, $answerFetch_sql);
						while($answerFetch_row = mysqli_fetch_assoc($answerFetch_result)) {
							// display the choices of question as radio buttons with value as choice and name as questionID.
							echo '<input type = "radio" value = "'.$answerFetch_row['choice'].'" name = "'.$questionFetch_row['questionID'].'">'.$answerFetch_row['choice'].'';
							echo '';
							echo '<br>';
						}
					}
				$_SESSION['questionIDArray'] = $questionIDArray;
				echo "<br>	
				<input type= 'submit'>
				</form>";


				} else if($faculty == 'Management') {
					// This section is to be handled.
					// select the Question Category Randomly to be displayed.
					$category = [];
					$sql = "SELECT * FROM aptitudetestmanagement ORDER BY RAND()";
					$result = mysqli_query($conn, $sql);
					while($row = mysqli_fetch_assoc($result)) {
						array_push($category, $row['Category']);
					}
					print_r($category);
					echo '<form action="addPoints.php" method = "POST">';
					//fetching 15 questionsscience of randomly.
					$questionFetch_sql = "SELECT * FROM questionmanagement WHERE Category = '$category[0]' ORDER BY RAND() LIMIT 15 ";
					$questionFetch_result = mysqli_query($conn, $questionFetch_sql);
					// fetch a question.
					while($questionFetch_row = mysqli_fetch_assoc($questionFetch_result)) {
						array_push($questionIDArray, $questionFetch_row['questionID']);
						echo $questionFetch_row['question'];
						echo '<br>';
						// fetch the questionID.
						$questionID = $questionFetch_row['questionID'];
						// fetch the question's optionsscience..
						$answerFetch_sql = "SELECT * FROM optionsmanagement WHERE questionID = '$questionID' ORDER BY RAND()";
						$answerFetch_result = mysqli_query($conn, $answerFetch_sql);
						while($answerFetch_row = mysqli_fetch_assoc($answerFetch_result)) {
							// display the choices of question as radio buttons with value as choice and name as questionID.
							echo '<input type = "radio" value = "'.$answerFetch_row['choice'].'" name = "'.$questionFetch_row['questionID'].'">'.$answerFetch_row['choice'].'';
							echo '';
							echo '<br>';
						}
					}
					//fetching 15 questionsscience of randomly.
					$questionFetch_sql = "SELECT * FROM questionmanagement WHERE Category = '$category[1]' ORDER BY RAND() LIMIT 15 ";
					$questionFetch_result = mysqli_query($conn, $questionFetch_sql);
					// fetch a question.
					while($questionFetch_row = mysqli_fetch_assoc($questionFetch_result)) {
						array_push($questionIDArray, $questionFetch_row['questionID']);
						echo $questionFetch_row['question'];
						echo '<br>';
						// fetch the questionID.
						$questionID = $questionFetch_row['questionID'];
						// fetch the question's optionsscience..
						$answerFetch_sql = "SELECT * FROM optionsmanagement WHERE questionID = '$questionID' ORDER BY RAND()";
						$answerFetch_result = mysqli_query($conn, $answerFetch_sql);
						while($answerFetch_row = mysqli_fetch_assoc($answerFetch_result)) {
							// display the choices of question as radio buttons with value as choice and name as questionID.
							echo '<input type = "radio" value = "'.$answerFetch_row['choice'].'" name = "'.$questionFetch_row['questionID'].'">'.$answerFetch_row['choice'].'';
							echo '';
							echo '<br>';
						}
					}
					//fetching 15 questionsscience of randomly.
					$questionFetch_sql = "SELECT * FROM questionmanagement WHERE Category = '$category[2]' ORDER BY RAND() LIMIT 15 ";
					$questionFetch_result = mysqli_query($conn, $questionFetch_sql);
					// fetch a question.
					while($questionFetch_row = mysqli_fetch_assoc($questionFetch_result)) {
						array_push($questionIDArray, $questionFetch_row['questionID']);
						echo $questionFetch_row['question'];
						echo '<br>';
						// fetch the questionID.
						$questionID = $questionFetch_row['questionID'];
						// fetch the question's optionsscience..
						$answerFetch_sql = "SELECT * FROM optionsmanagement WHERE questionID = '$questionID' ORDER BY RAND()";
						$answerFetch_result = mysqli_query($conn, $answerFetch_sql);
						while($answerFetch_row = mysqli_fetch_assoc($answerFetch_result)) {
							// display the choices of question as radio buttons with value as choice and name as questionID.
							echo '<input type = "radio" value = "'.$answerFetch_row['choice'].'" name = "'.$questionFetch_row['questionID'].'">'.$answerFetch_row['choice'].'';
							echo '';
							echo '<br>';
						}
					}
					$_SESSION['questionIDArray'] = $questionIDArray;
					echo "<br>
					<input type= 'submit'>";
					echo '</form>';

				}	



			}else {
				// faculty selection section.
				echo '
					<form action= "' .htmlspecialchars($_SERVER['PHP_SELF']). '" method = "POST">
						 <button value = \'Science\' name = \'faculty\'> Science </button>
						 <button value = \'Management\' name = \'faculty\'> Management </button>
					 </form>			

				';
			}

		}else {
			echo 'you\'re not logged in';

		}
  ?>

</body>
</html>