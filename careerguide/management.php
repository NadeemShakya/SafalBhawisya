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
						<img src="../image/BBS.jpeg" alt="please_reload">
					</div>
					<div class = "listDivText">
						<h3>BBS</h3>
						<span>The objective of the BBS programme is to develop students into competent managers for any sector of organized activity. The programme is based on the principle that graduates will spend a major portion of their life in a constantly changing environment. Therefore, the student should have an opportunity to obtain a broad knowledge of the concepts and reality-based skills underlying the operation and management of organizations.Upon graduation, a student should be equipped to function as a manager in business, industry and government. </span> <br><br>
						<label>Course Duration </label>
						<span>4 Years</span> <br>
					</div>
					<button onclick = "document.location.href = 'BBS.php'">View Course</button>
				</div>
                <div class = "listDiv">
                    <div class = "listDivImg">
                        <img src="../image/BBA.jpeg" alt="please_reload">
                    </div>
                    <div class = "listDivText">
                        <h3>BBA</h3>
                        <span>Bachelors in Business administration commonly known as BBA in Nepal, is an undergraduate programme. BBA is most suitable for the students willing to pursue their career in the field of business and management.BBA is a course designed for students with management background or without the management background.This course can be done by the students with science or management students of high school commonly referred top +2, in Nepal. This course in the beginning years focuses on basic concept of business, management andcommerce studies.</span> <br><br>
                        <label>Course Duration </label>
                        <span>4 Years</span> <br>
                    </div>
                    <button onclick = "document.location.href = 'BBA.php'">View Course</button>
                </div>
                <div class = "listDiv">
                    <div class = "listDivImg">
                        <img src="../image/LAW.jpeg" alt="please_reload">
                    </div>
                    <div class = "listDivText">
                        <h3>LAW</h3>
                        <span>Bachelor of Arts Bachelor of Laws (BA LLB in Nepal) is a course program designed in order to make legal education compatible with changed national and international context. The main motive behind this study program is to provide law students the comprehensive theoretical and practical knowledge in indigenous as well as foreign legal traditions, lawyer skills and research to meet the challenges of the age.The law component provides professionals legal skills including the ability to analyse legal material, understand fundamental legal principles, understand the relationship between law and society and gain general analytical skills for critical thinking and problem solving. </span> <br><br>
                        <label>Course Duration </label>
                        <span>5 Years</span> <br>
                    </div>
                    <button onclick = "document.location.href = 'LAW.php'">View Course</button>
                </div>
                <div class = "listDiv">
                    <div class = "listDivImg">
                        <img src="../image/CA.jpeg" alt="please_reload">
                    </div>
                    <div class = "listDivText">
                        <h3>CHARTERD ACCOUNTANT</h3>
                        <span>The history of Chartered Accountancy in Nepal is only a decade long. Despite its short history, CA has able to mark its existence in Nepal quite firmly. The popularity of CA in Nepal is ever so growing and is still in full swing.The advancement in the business and the career security has made CA one of the first picked courses by the students. The number of students studying CA within the country is increasing. The career prospect it holds is the key component and main reason behind its popularity and becoming priority of many.</span> <br><br>
                        <label>Course Duration </label>
                        <span>4-5 Years</span> <br>
                    </div>
                    <button onclick = "document.location.href = 'CA.php'">View Course</button>
                </div>
                <div class = "listDiv">
                    <div class = "listDivImg">
                        <img src="../image/TNT.jpeg" alt="please_reload">
                    </div>
                    <div class = "listDivText">
                        <h3>TRAVEL AND TOURISM</h3>
                        <span>Strictly speaking, Nepal is one best country for tourism and thereby opportunities in travel and tourism industry can’t be explained in single line or in a paragraph. The need of professionals required to develop the travel and tourism industry is increasing day by day, and therefore Tribhuvan University has introduced a course named as Bachelor in Travel and Tourism Management (BTTM). The main motto of this course is to produce the best professionals to serve in travel and tourism industry in best way at both private and public sector.</span> <br><br>
                        <label>Course Duration </label>
                        <span>4 Years</span> <br>
                    </div>
                    <button onclick = "document.location.href = 'TNT.php'">View Course</button>
                </div>
                <div class = "listDiv">
                    <div class = "listDivImg">
                        <img src="../image/IT.jpeg" alt="please_reload">
                    </div>
                    <div class = "listDivText">
                        <h3>INFORMATION TECHNOLOGY (IT)</h3>
                        <span>BIT in Nepal is one of best course in Nepal which directly deals with changing information technology. Over the years, it has been seen that BIT has been supplying the current need of IT industries. The bachelor in Information technology is an academic program comprising of core and advance IT unit. The core unit provides fundamentals of information technology that provides student the knowledge and skills in programming, system design, computer networks and communication. The advanced unit enables the students to exercise, develop and apply their knowledge and skills in many areas like multimedia, Artificial intelligence, mobile communication internet etc.</span> <br><br>
                        <label>Course Duration </label>
                        <span>4 Years</span> <br>
                    </div>
                    <button onclick = "document.location.href = 'IT.php'">View Course</button>
                </div>
               

<div class = 'fakeWrapper' id = 'fakeWrapperID'></div>
<script src = '../js/main.js'></script>
</body>
</html>