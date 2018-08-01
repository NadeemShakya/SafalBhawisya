
<?php 
	include '../dbh.php';
	session_start();
	$faculty = $_SESSION['faculty'];
	// getting the email of user.
	$email = $_SESSION['email'];
	// getting the QuestionIDs.
	$questions = $_SESSION['questions'];
	// total number of Questions.
	$totalQuestion = sizeof($questions);

	// getting info of which button the user Clicked.
	$buttonClicked = $_GET['button'];
	$tester = false;

 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Aptitude Test</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="../css/view.css">
    <link rel="stylesheet" type="text/css" href="../css/main.css">
    <link rel="icon" href="../image/logo.png">
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,500,700" rel="stylesheet">
</head>
<body>
	<!-- Starting The Navigation Bar -->
            <div class="nav-bar">
                <div class = 'nav-bar-element'>
                    <a href="index.php"><img src="../image/logo.png" alt="please_reload" class = 'logo'></a>
                    <h3 class = 'logoTitle'><a href="index.php">SafalBhawishya</a></h3>
                    <ul>

                        <?php 
                            if(!isset($_SESSION['log'])) {
                                echo '
                                    <li onclick = \'openForm("login")\'><a href="#">
                                    Login
                                    </a></li>
                                    <li onclick = \'openForm("signup")\'><a href="#">Signup</a></li>
                                ';
                            }
                         ?>
                    </ul>

                        <?php 
                            if(isset($_SESSION['log'])) {
                                $email = $_SESSION['email'];
                                echo '<div class = "profile">
                                   
                                    <div class = "profileImg-Div id = "profileImg-DivID">';
                                        $sql = "SELECT * FROM userregistration WHERE email = '$email'";
                                        $result = mysqli_query($conn, $sql);
                                        $row = mysqli_fetch_assoc($result);

                                            if($row['method'] == 'Google') {
                                                 echo '
                                                    <img src=" '. $_SESSION['picture']. '" alt="please_reload" class = "profileImg">
                                                    

                                                    ';
                                            }else if($row['method'] == 'SafalBhawishya') {
                                                if($row['pictures'] == NULL) {

                                                    echo '<img src="../image/user.png" alt="please_reload" class = "profileImgIcon">';

                                                }else {
                                                 echo '
                                                    <img src="../profilePics/'.$row['pictures'].'" alt="please_reload" class = "profileImg">
                                                    
                                                    ';  
                                                }                         
                                            }
                                    echo '</div>
                                </div>';

                            }
                        ?>

                </div>
            </div>
    <!-- Finishing the Navigation Bar -->

	<div class = "layer1">
		<h2>Aptitude Test</h2>
		<i>A new way to test your inherent skills.</i>
		<form action = "quitTest.php" method = "POST">
			<button class = 'quitButton'>Quit Test</button>
		</form>

		<?php 
			if($faculty == 'Science') {
				$sql = "SELECT * FROM testscience WHERE email = '$email'";
			}else if($faculty == "Management") {
				$sql = "SELECT * FROM testmanagement WHERE email = '$email'";

			}
			$result = mysqli_query($conn, $sql);
			$counter = mysqli_num_rows($result);
			if($counter == $totalQuestion) {
				echo '
				<form action = "addPoints.php" method = "POST">
					<button class = \'submitButton\'>Submit</button>
				</form>



				';
			}


		 ?>
	</div>
	<div class = 'rightDiv'>
		<?php 

				// buttonClicked == "None" means the page is redirected from
				// aptitudeTest.php section.
				if($buttonClicked == "None") {
					// pageCounter sent as 0 from aptitudeTest.php page initially.
					$_SESSION['startTime'] = date("h:i:sa");
					$pageCounter = $_GET['pageCounter'];
					// setting the previousPage also as 0.
					$previousPage = $pageCounter;

				// if Next Button was clicked.
				}else if($buttonClicked == "Next") {
					// getting the initial pageNumber as incremented page Number from previous page. 
					$pageCounter = $_GET['pageCounterInc'];
					// setting previousPage as 1 less than the initialPage number.
					$previousPage = $pageCounter - 1;
				}
				// getting the initial pageNumber as decremented page Number from previous page.
				else if($buttonClicked == "Previous") {
					$pageCounter = $_GET['pageCounterDec'];
					// setting the previousPage as 1 more than the initialPage number.
					$previousPage = $pageCounter + 1;
				}else  if($buttonClicked == "Submit") {
				$pageCounter = $_GET['pageCounterInc'];
				$pageCounter = $pageCounter - 1;
				$previousPage = $pageCounter;

			}
				if($buttonClicked != "None") {
					// if either NEXT of PREVIOUS buttons were clicked.
					if($faculty == 'Science') {
						$sql = "SELECT * FROM questionsscience WHERE questionID = '$questions[$previousPage]'";
					}else if($faculty == 'Management') {
						$sql = "SELECT * FROM questionmanagement WHERE questionID = '$questions[$previousPage]'";

					}
					$result = mysqli_query($conn, $sql);
					$row_previous = mysqli_fetch_assoc($result);
					// previous Question.
					$question = $row_previous['question'];
					// previous Question's ID.
					$questionID = $row_previous['questionID'];
					// previous Question's correct Answer.
					$correctAnswer = $row_previous['answer'];
					// previous Question's user ticked answer.
					$userAnswer = $_GET[$row_previous['questionID']];
					// insert this previous question info into TESTSSCIENCE table in database.
					if($faculty == 'Science') {
						$sql = "SELECT * FROM testscience WHERE email = '$email' AND questionID = '$questionID'";
					} else if($faculty == 'Management') {
						$sql = "SELECT * FROM testmanagement WHERE email = '$email' AND questionID = '$questionID'";
					}
					$result = mysqli_query($conn, $sql);
					$rowCount = mysqli_num_rows($result);
					// if the question has not been answered
					// then INSERT OPERATION.
					if($rowCount == 0) {
						if($faculty == 'Science') {
							$sql = "INSERT INTO testscience VALUES('$email', '$questionID', '$userAnswer')";
							// refresh the page for chekcing the questions box.
							//bug solving feature.
							header("Refresh:0");
						}else if($faculty == 'Management') {
							$sql = "INSERT INTO testmanagement VALUES('$email', '$questionID', '$userAnswer')";
							header("Refresh:0");
						}
						$result = mysqli_query($conn, $sql);
					}
					// if the question has been answered then UPDATE OPERATION.
					else {
						if($faculty == 'Science') {
							$sql = "UPDATE testscience SET userAnswer = '$userAnswer' WHERE questionID = '$questionID' AND email = '$email'";
							// header("Refresh:0");

						}else if($faculty == 'Management') {
							$sql = "UPDATE testmanagement SET userAnswer = '$userAnswer' WHERE questionID = '$questionID' AND email = '$email'";
							// header("Refresh:0");

						}
						$result = mysqli_query($conn, $sql);
					}
				}

				if($faculty == 'Science'){
					$sql = "SELECT * FROM questionsscience WHERE questionID = '$questions[$pageCounter]'";
				}else if($faculty == 'Management') {
					$sql = "SELECT * FROM questionmanagement WHERE questionID = '$questions[$pageCounter]'";
				}
				$result = mysqli_query($conn, $sql);
				$row = mysqli_fetch_assoc($result);
				$questionID= $row['questionID'];
				$answer = $row['answer'];
				$question = $row['question'];
				// Display the question number.
				$page = $pageCounter + 1;
				// Display the options accordingly the questionID.
				echo '<p class = "question">Q'.$page. ') '.$question.'</p>';
				echo '<br>';
				// store incremented page Counter for Next button.
				$pageCounterInc = $pageCounter+1;
				// store decremented page Counter for Previous Button.
				$pageCounterDec = $pageCounter - 1;

				if($faculty == 'Science'){
					$sql = "SELECT * FROM optionsscience WHERE questionID = '$questions[$pageCounter]'";

				}else if($faculty == 'Management') {
					$sql = "SELECT * FROM optionsmanagement WHERE questionID = '$questions[$pageCounter]'";
					
				}
				$result = mysqli_query($conn, $sql);

				if($faculty == 'Science'){
					$sql_check = "SELECT * FROM testscience WHERE questionID = '$questions[$pageCounter]'";

				}else if($faculty == 'Management') {
					$sql_check = "SELECT * FROM testmanagement WHERE questionID = '$questions[$pageCounter]'";
					
				}
				$result_check = mysqli_query($conn, $sql_check);
				$row_check = mysqli_fetch_assoc($result_check);
				echo '<form action = "view.php" method = "GET" >';
				while($row = mysqli_fetch_assoc($result)) {
					if($row_check['userAnswer'] == $row['choice']) {
						// check list the options which user has already marked..
						echo "
						<label class = 'container'> ".$row['choice']."
						<input type = 'radio' value = '".$row['choice']."' name = '".$row['questionID']."' required checked>
						<span class = 'checkmark'></span>

						</label>

						";
					}else {
						// don't check list the options which the user hasn't ticked.

						echo "
						<label class = 'container'>".$row['choice']."
						<input type = 'radio' value = '".$row['choice']."' name = '".$row['questionID']."' required >
						<span class = 'checkmark'></span>


						</label>";
					}
					echo '<br>';
				}	
				echo'
					<input type="hidden" name= "pageCounterInc" value = "'.$pageCounterInc.'">
					<input type="hidden" name= "pageCounterDec" value = "'.$pageCounterDec.'">';
					// if not last question, display next button.
					if($pageCounter != $totalQuestion - 1) {		
						echo '
							<button name = "button" type = "submit" value = "Next" class = "nextButton" title = "Next Question"></button>
						';
					}	
					// if not first question, display previous button.
					if($pageCounter != 0) {
						echo '
						<button name = "button" type = "submit" value = "Previous" class = "previousButton" title = "Previous Question"></button>
						';
					}
					// submit button for Finishing the test and submitting test.
					if($pageCounter == $totalQuestion - 1) {
						echo '
							<form action="view.php">
								<button name = "button" type = "submit" value = "Submit" class = "nextButton" title = "Next Question"></button>
								
							</form>
						';
					}
				echo '</form>';	
				
			 ?>

		</div>
	<div class = "layer2">
		<div class = 'leftDiv'>
			<div class = 'leftDiv1'>
				<p>Questions Attempted</p> 
			<?php 

				for($i = 0; $i < $totalQuestion; $i++) {
					$questionID = $questions[$i];
					$incI = $i + 1;
					if($faculty == "Science") {
						$sql = "SELECT * FROM testscience WHERE email = '$email' AND questionID = '$questionID'";
					}else if($faculty == "Management") {
						$sql = "SELECT * FROM testmanagement WHERE email = '$email' AND questionID = '$questionID'";

					}
					$result = mysqli_query($conn, $sql);
					$row = mysqli_fetch_assoc($result);
					$count_rows = mysqli_num_rows($result);
					if($count_rows == 0) {
					echo "
						<label class = 'box'>
					
						<input type = 'checkbox'>
						<span class = 'checkedbox'>".$incI."</span>
						</label>
					";
					}else if($count_rows != 0) {
					echo "
						<label class = 'box'>
					
						<input type = 'checkbox' checked>
						<span class = 'checkedbox'>".$incI."</span>

						</label>
					";
					}
					

				}

			 ?>

			</div>

			<div class = 'leftDiv2'>
				<p>TIME ELAPSED</p>
			</div>
		</div>


	
	</div>

            <div class="footer">
                &copy SafalBhawishya.com.np 2018 Nepal <br> 
                Developed and Maintained by SafalBhawishya Team.

            </div>
</body>
</html>
<!--
BUG
 LAST ELEMENT DOESN'T GETS ENTERED INSIDE THE TABLE -->

