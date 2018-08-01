<?php 
	include '../dbh.php';
	session_start();
		$email = $_SESSION['email'];
		$faculty = $_SESSION['faculty'];
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
    <meta charset="utf-8">
    <title>Result</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="../css/main.css">
    <link rel="stylesheet" href="../css/result.css">
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
	<div class = 'pointsDiv'>
		<h3>TEST RESULTS</h3>

		<div class = "suggestion" id = "suggestionDivID">
		<input type="hidden" value = "<?php echo $_SESSION['faculty'] ?>" id = "faculty">
		<?php 
			if($faculty == "Science") {
				$sql = "SELECT * FROM pointstablescience WHERE email = '$email'";
			}else if($faculty == "Management") {
				$sql = "SELECT * FROM pointstablemanagement WHERE email = '$email'";

			}
			$result = mysqli_query($conn, $sql);
			while($row = mysqli_fetch_assoc($result)) {
				$category = $row['Category'];
				echo '<br>';
				$points = $row['points'];
				echo '<br>';
				echo $category;
				echo '<br>';
				if($points < 1) {
					echo 
					'	<div class = "container_LowMarks" id = "'.$category.'">'.$points.'</div>
						<span class = "progressBar"></span>

					';				

				}else {
					echo 
					'	<div class = "container_HighMarks" id = "'.$category.'">'.$points.'</div>
						<span class = "progressBar"></span>

					';					
				}

				// minimum threshold is 6 now.
				// must be 8 if there are 15 questions.
				if($points <1) {
					echo '
					<div class = "lowScore">
						Oops! Based on our test, you failed to meet the threshold percentage in this subject. So we recommend you to study hard for this subject. <br>
					</div>
					';
				}else if($points >=1 ) {
					echo '
					<div class = "goodScore">
						Hurrah! Based on our test, you have passed out the threshold percentage in this subject. Keep it up!
						 <br>
					</div>
					';
				} 
			}
		 ?>

		 </div>
	</div>
    <div class = "mainDiv">
		<h3>QUESTIONS & ANSWERES</h3>
   <?php 	
	
			//Question Numbering.
			$i = 1;
			if($faculty == "Science") {
				$sql1 = "SELECT * FROM testscience WHERE email = '$email'";
			}else if($faculty == "Management") {
				$sql1 = "SELECT * FROM testmanagement WHERE email = '$email'";

			}
			$result1 = mysqli_query($conn, $sql1);
			while($row = mysqli_fetch_assoc($result1)) {
				$userAnswer	 = $row['userAnswer'];
				$questionID = $row['questionID'];
				if($faculty == "Science") {
					$sql2 = "SELECT * FROM questionsscience WHERE questionID = '$questionID'";
				}else if($faculty == "Management") {
					$sql2 = "SELECT * FROM questionmanagement WHERE questionID = '$questionID'";

				}
				$result2 = mysqli_query($conn, $sql2);
				$row2 = mysqli_fetch_assoc($result2);
				$question = $row2['question'];
				echo '<div class = "resultDiv">';
					echo "Q".$i.") ";
					echo $question. '<br>';
					$answer = $row2['answer'];
					if($answer == $userAnswer) {
						echo '
						<div class = "correctAnswer">
							Your Answer: '.$userAnswer. '<br>
						</div>
						';
					}else {
						echo '
						<div class = "incorrectAnswer">
							Your Answer: '.$userAnswer. '<br>
						</div>
						';			
					}

					echo '
					<div class = "rightAnswer">
						Correct Answer: '. $answer. '<br>
					</div>
					';
				echo '</div>';
				$i++;
			}


		// echo '<pre>'; print_r($questionAnswerArray); echo '</pre>';
			// section to handle the user's data.
			echo '
				<form action="handleProgressData.php" method = "POST">
					<input type="submit" value = "FINISH AND LEAVE TEST"  class = \'goBackButton\'>
				</form>
			';
 	?>
    </div>


<script src = '../js/result.js'></script>
</body>
</html>
