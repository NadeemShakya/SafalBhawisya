<?php
//Include GP config file && User class
include_once '../gpConfig.php';
include_once '../User.php';
include '../dbh.php';
if(isset($_GET['code'])){   
    $gClient->authenticate($_GET['code']);
    $_SESSION['token'] = $gClient->getAccessToken();
    header('Location: ' . filter_var($redirectURL, FILTER_SANITIZE_URL));
}

if (isset($_SESSION['token'])) {
    $gClient->setAccessToken($_SESSION['token']);
}

if ($gClient->getAccessToken()) {
    //Get user profile data from google
    $gpUserProfile = $google_oauthV2->userinfo->get();
    
    //Initialize User class
    $user = new User();
    
    //Insert or update user data to the database
    $gpUserData = array(
        'oauth_provider'=> 'google',
        'oauth_uid'     => $gpUserProfile['id'],
        'first_name'    => $gpUserProfile['given_name'],
        'last_name'     => $gpUserProfile['family_name'],
        'email'         => $gpUserProfile['email'],
        // 'gender'        => $gpUserProfile['gender'],
        'locale'        => $gpUserProfile['locale'],
        'picture'       => $gpUserProfile['picture'],
        'link'          => $gpUserProfile['link']
    );
    $userData = $user->checkUser($gpUserData);
    
    //Storing user data into session
    $_SESSION['userData'] = $userData;
    
    //Render facebook profile data
    if(!empty($userData)){
        // $output = '<h1>Google+ Profile Details </h1>';
        // $output .= '<img src="'.$userData['picture'].'" width="300" height="220">';
        // $output .= '<br/>Google ID : ' . $userData['oauth_uid'];
        // $output .= '<br/>Name : ' . $userData['first_name'].' '.$userData['last_name'];
        // $output .= '<br/>Email : ' . $userData['email'];
        // $output .= '<br/>Gender : ' . $userData['gender'];
        // $output .= '<br/>Locale : ' . $userData['locale'];
        // $output .= '<br/>Logged in with : Google';
        // $output .= '<br/><a href="'.$userData['link'].'" target="_blank">Click to Visit Google+ Page</a>';
        // $output .= '<br/>Logout from <a href="logout.php">Google</a>'; 
        $output = 'Hello User';
        $_SESSION['log'] = true;
        $_SESSION['firstName'] = $userData['first_name'];
        $_SESSION['lastName'] = $userData['last_name'];
        $_SESSION['picture'] = $userData['pictures'];
    }else{  
        $output = '<h3 style="color:red">Some problem occurred, please try again.</h3>';
    }
} else {
    $authUrl = $gClient->createAuthUrl();
    //$output = '<a href="'.filter_var($authUrl, FILTER_SANITIZE_URL).'"><img src="image/glogin.png" alt=""/></a>';
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Career Choices</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="../css/main.css">
    <link rel="stylesheet" type="text/css" href="../css/careerguidance.css">
    <link rel="icon" href="../image/logo.png">
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,500,700" rel="stylesheet">
</head>
<body>
            <!-- Start of Login and Signup Form -->
            <div class = 'signupWrapper'>
                <div class = "signupForm" id = 'signupFormID'> 
                    <div class = "signupHeader">
                        <img src="../image/cross.png" alt="" class = 'crossButton' id = 'crossButtonID' title = 'Close Form'>
                        <div class = 'signup' id = 'signupID'>
                            <h6 id = 'signupTextID'>SignUp</h6>
                        </div>
                        <div class = 'login' id = 'loginID'>
                            <h6 id = 'loginTextID'>Login</h6>
                        </div>
                    </div>
                    <div class = 'errormsgDisplay' id = 'errormsgDisplayID'>
                    <!--    <p>Passwords Doesn't Match!</p>
                        <p>nadim</p> -->
                    </div>
                    <div class = "signupBody" id = 'signupBodyID'>

                            <?php ;
                            // GOOGLE SIGNUP BUTTON
                             echo ' 
                                <form action="'.filter_var($authUrl, FILTER_SANITIZE_URL).'" method = "POST">
                                     <input type="submit" value = "Signup With Google" class = "googleSignup" >
                                </form> 
                            ';
                             ?>
                             <hr>
                        <form action="signup.php" method = 'POST' name = 'signupForm' enctype="multipart/form-data" onsubmit=" return validator()">
                            <input type = "text" placeholder=" First Name" name = 'first_name' autocomplete = 'off'required>
                            <input type = "text" placeholder=" Last Name" name = 'last_name' autocomplete = 'off'required>
                            <input type = "password" placeholder=" Password" id = 'signupPassword' name = 'password' required>
                            <img src="../image/view.png" alt="please_reload" class = 'visibilityImgSignup' id = 'visibilityImgID' onclick = 'togglePassword("signup")' title = 'Toggle Password'>
                            <input type = "password" placeholder = "Verify Password" id = 'signupPasswordVerify' required>
                            <input type = "email" placeholder=" Email" name = 'email' autocomplete = 'off'required>
                            <!-- <input type="file" name = "file" accept = "image/*"> -->
                            <input type = 'text' list = 'address' placeholder = "Address" name = 'address' required>

                            <datalist id = 'address'>
                                <option value="Gwarko, Lalitpur">Gwarko, Lalitpur</option>
                                <option value="Lagankhel, Lalitpur">Gwarko, Lalitpur</option><option value="Gwarko, Lalitpur">Kumaripati, Lalitpur</option><option value="Lokanthali, Bhaktapur">Gwarko, Lalitpur</option>
                                <option value=""></option>
                            </datalist>
                            <input type="submit" value = 'Signup' class = 'normalSignup'>
                            <br>
                        </form>

                            
                    </div>

                    <div class = 'loginBody' id = 'loginBodyID'>
                         <?php 
                        echo '
                            <form action="'.filter_var($authUrl, FILTER_SANITIZE_URL).'" method = "POST">
                                <input type="submit" value = "Login with Google" class = \'googleLogin\'>
                            </form>
                        ';
                         ?> <hr>
                        <form action="../login.php" method = 'POST'>
                            
                            <input type="text" placeholder = 'Email' name = 'email' autocomplete = 'off' required >
                            <input type="password" placeholder = 'Password' id = 'loginPassword' name = 'password' required>
                            <img src="../image/view.png" alt="please_reload" class = 'visibilityImgLogin' onclick = 'togglePassword("login")' title = 'Toggle Password'>
                            <input type="submit" value = 'Login' class = 'normalLogin' name = 'loginButton'>
                            <br>

                        </form>

                    </div>
                </div>  
            </div>
            <!-- End of Signup Login Form -->
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
                                   
                                    <div class = "profileImg-Div id = "profileImg-DivID" onclick = "showprofileOptions()">';
                                        $sql = "SELECT * FROM userregistration WHERE email = '$email'";
                                        $result = mysqli_query($conn, $sql);
                                        $row = mysqli_fetch_assoc($result);

                                            if($row['method'] == 'Google') {
                                                 echo '
                                                    <img src=" '. $_SESSION['picture']. '" alt="please_reload" class = "profileImg">
                                                    <img src="../image/caret-down.png" alt="please_reload" class = "caret-down">

                                                    ';
                                            }else if($row['method'] == 'SafalBhawishya') {
                                                if($row['pictures'] == NULL) {

                                                    echo '<img src="../image/user.png" alt="please_reload" class = "profileImgIcon">
                                                    <img src="../image/caret-down.png" alt="please_reload" class = "caret-down">';

                                                }else {
                                                 echo '
                                                    <img src="../profilePics/'.$row['pictures'].'" alt="please_reload" class = "profileImg">
                                                    <img src="../image/caret-down.png" alt="please_reload" class = "caret-down">

                                                    ';  
                                                }                         
                                            }
                                    echo '</div>
                                </div>';

                            }
                        ?>

                        <div class = "profileOptions-Div" id = 'profileOptions-DivID' style = "display:none">
                            <ul>
                                <li><a href="profile.php?value=Science">My Profile</a></li>
                                <li><a href="../logout.php">Logout</a></li>
                            </ul>
                        </div>
                </div>
            </div>
			

			<div class = "mainDiv">
				<div class = "listDiv">
					<div class = "listDivImg">
						<img src="../image/HSEB.jpeg" alt="please_reload">
					</div>
					<div class = "listDivText">
						<h3>+2 HSEB</h3>
						<span>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged</span> <br><br>
						<label>Course Duration </label>
						<span>2 Years</span> <br><br>
					</div>
					<button onclick = "document.location.href = 'HSEB.php'">View Course</button>
				</div>

				<div class = "listDiv">
					<div class = "listDivImg">
						<img src="./image/alevel.png" alt="please_reload">
					</div>
					<div class = "listDivText">
						<h3>A Level</h3>
						<span>A-Level is an Advanced Level General Certificate of Education (GCE A-Level) qualification which is equivalent to a two-year intermediate level study in Nepal. Run under Cambridge International Examination (CIE) Board, a part of University of Cambridge Local Examinations Syndicate (UCLES), GCE has been offering Advanced Level qualification for more than half a century throughout the world.</span><br><br><br>
                        <label>Course Duration </label>
                        <span>2 Years</span> 
					</div>
					<button onclick = "document.location.href = 'Alevel.php'">View Course</button>
				</div>

				<div class = "listDiv">
					<div class = "listDivImg">
						<img src="../image/pcl.jpg" alt="please_reload">
					</div>
					<div class = "listDivText">
						<h3>PCL Nursing</h3>
						<span>Nursing in Nepal has been one of the major choices of female science students of plus 2 and also SLC passed students. In recent years statistics show that nursing education is the next big thing and the heart-throb of female studentsMany students willing to get their hands on into the field of Medicine and healthcare are attracted to studying nursing in Nepal. Nursing study is easily accessible, widely spread and heavily on demand with the rise of healthcare industry in the country.</span><br><br><br>
                        <label>Course Duration </label>
                        <span>2 Years</span> <br>
					</div>
					<button onclick = "document.location.href = 'pcl.php'">View Course</button>
				</div>

        <div class = 'fakeWrapper' id = 'fakeWrapperID'>
            
        </div>
<div class = 'fakeWrapper' id = 'fakeWrapperID'></div>
<script src = '../js/main.js'></script>
</body>
</html>