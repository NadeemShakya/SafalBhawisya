<?php 
	include 'dbh.php';
	session_start();
	if($_SERVER['REQUEST_METHOD'] == "GET") {
		$type = $_GET['value'];
	}
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>My Profile</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <link rel="stylesheet" type="text/css" href="css/myprofile.css">

    <link rel="icon" href="image/logo.png">
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,500,700" rel="stylesheet">
</head>
<body>

            <div class="nav-bar">
                <div class = 'nav-bar-element'>
                    <a href="index.php"><img src="image/logo.png" alt="please_reload" class = 'logo'></a>
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
                                   
                                    <div class = "profileImg-Div id = "profileImg-DivID" onclick = "showprofileOptions()">';
                                        $sql = "SELECT * FROM userregistration WHERE email = '$email'";
                                        $result = mysqli_query($conn, $sql);
                                        $row = mysqli_fetch_assoc($result);

                                            if($row['method'] == 'Google') {
                                                 echo '
                                                    <img src=" '. $_SESSION['picture']. '" alt="please_reload" class = "profileImg">
                                                    <img src="image/caret-down.png" alt="please_reload" class = "caret-down">

                                                    ';
                                            }else if($row['method'] == 'SafalBhawishya') {
                                                if($row['pictures'] == NULL) {

                                                    echo '<img src="image/user.png" alt="please_reload" class = "profileImgIcon">
                                                    <img src="image/caret-down.png" alt="please_reload" class = "caret-down">';

                                                }else {
                                                 echo '
                                                    <img src="profilePics/'.$row['pictures'].'" alt="please_reload" class = "profileImg">
                                                    <img src="image/caret-down.png" alt="please_reload" class = "caret-down">

                                                    ';  
                                                }                         
                                            }
                                    echo '</div>
                                </div>';

                            }
                        ?>

                        <div class = "profileOptions-Div" id = 'profileOptions-DivID' style = "display:none">
                            <ul>
                                <li><a href="logout.php">Logout</a></li>
                            </ul>
                        </div>
                </div>
            </div>
            <div class = "rightDiv">
            	<?php 
            	            $email = $_SESSION['email'];
            				$sql = "SELECT * FROM userregistration WHERE email = '$email'";
            				$result = mysqli_query($conn, $sql);
            				$row = mysqli_fetch_assoc($result);
            	echo '
            		<div class = "rightDiv_Image">
            			';
            			if($row['method'] == "SafalBhawishya") {	
							if($row['pictures'] == NULL) {
							echo '<img src="image/user.png" alt="please_reload">';								
							}else {
							echo '<img src="profilePics/'.$row['pictures'].'" alt="please_reload">';
							}
            			}else {
            				echo '<img src="'.$row['pictures'].'" alt="please_reload">';

            			}
            	echo '
            		</div>
            		<div class = "rightDiv_Text">
            				<h2>'.$row['first_name']. ' ' .$row['last_name'].'</h2>';
            				
            					echo '
								<label>Email:</label>
								<span>'.$email.'</span>
								<br>	<br>	
								<label>Address:</label>
								<span>'.$row['address'].'</span> <br><br>
								<label>Log In Method:</label>
								<span>'.$row['method'].'</span>
            					';


            			 ?>
            		</div>
             <div class = "selectionMenu">
				<ul>
			
						
					<li><a href="profile.php?value=Science">Science </a></li>
	
					
					<li id = 'managementOption_ID'><a href="profile.php?value=Management">Management</a></li>
				</ul>

            </div>
					<?php 
						$email = $_SESSION['email'];
						if($type == "Science") {
							$sql = "SELECT * FROM progressscience WHERE email = '$email'";
						}else if($type == "Management") {
							$sql= "SELECT * FROM progressmanagement WHERE email = '$email'";	
						}
						$result = mysqli_query($conn, $sql);
						$row = mysqli_fetch_assoc($result);
						$row_count = mysqli_num_rows($result);
						$totalQuestions = $row['totalTest'] * 15;
						if($row_count != 0) {
							if($type == "Science"){
							echo '
						
								<ul class = "subjectDiv_Science">
									<li>
										<h4>Physics</h4>
										<hr>
										<span><b>'.$row["Physics"].'</b> / '.$totalQuestions.'</span>
									</li>
									<li>
										<h4>Chemistry</h4>
										<hr>
										<span><b>'.$row["Chemistry"].'</b> / '.$totalQuestions.'</span>
									</li>
									<li>
										<h4>Maths</h4>
										<hr>
										<span><b>'.$row["Maths"].'</b> / '.$totalQuestions.'</span>
									</li>
									<li>
										<h4>Biology</h4>
										<hr>
										<span><b>'.$row["Biology"].'</b> / '.$totalQuestions.'</span>
									</li>
									<li>
										<h4>English</h4>
										<hr>
										<span><b>'.$row["English"].'</b> / '.$totalQuestions.'</span>
									</li> 



								</ul>
							';
							}else {
							echo '
								
								<ul class = "subjectDiv_Management">

									<li>
										<h4>GK</h4>
										<hr>
										<span><b>'.$row["GK"].'</b> / '.$totalQuestions.'</span>
									</li>
									<li>
										<h4>Account</h4>
										<hr>
										<span><b>'.$row["Account"].'</b> / '.$totalQuestions.'</span>
									</li>
									<li>
										<h4>English</h4>
										<hr>
										<span><b>'.$row["English"].'</b> / '.$totalQuestions.'</span>
									</li>

								</ul>
							';								
							}
						}else {
							echo ' <h4 class = "informationnoTest">You haven\'t taken any test for this faculty!! Progress points get stored only after you take tests.</h4>';
						}




					 ?>

            </div>
 <script src = 'js/main.js'></script>
 <script src = 'js/profile.js'></script>

</body>
</html>