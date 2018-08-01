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
            <!-- eha bata suru hunxa -->
            <div class = "mainDiv">
<div class = "listDiv" style = "height:950px;">
                    <div class = "listDivImg">
                        <img src="./image/alevel.png" alt="please_reload">
                    </div>
                    <div class = "listDivText">
                        <h3>Alevel</h3>
                        <span>
                            <ul>
                             <li> What are the GCE A Levels?<br>
                            The General Certificate of Education (GCE) is one of the most internationally recognised qualifications at the secondary level. GCE examinations are set by the University of Cambridge International Examinations.

                            Students can take this qualification at the Advanced Subsidiary (AS) Level or the Advanced (A) Level, depending on their needs and on the courses they intend to follow. We advise students to take a preparation course that follows the specific syllabus for the subject they wish to give exams in.<br><br>

                            <li>How many years does it take to complete an A Level degree?<br>

                            A CIE A Level degree typically takes two years to complete and includes a flexible course of students that gives students the freedom to select subjects that are appropriate for them. Schools and learners find CIE AS and A Level programmes very flexible as schools can offer almost any combination of the wide range of subjects available. Learners have the freedom to select subjects that are right for them—they either follow a broad course of study, or specialise in a particular area.<br><br>


                            <li>What do the terms AS and A2 or A Level mean?<br>

                            The Advanced Subsidiary (AS) is offered in most subjects and became available for the first time in 2001. The subsidiary is a new way of facilitating staged assessment. The subject content of the new A Level syllabi has been subdivided into two parts: the AS syllabus content, which is expected to be covered in the first half of the course, and the second part of the syllabus, commonly referred to as A2, taken at the end of the second year of study. In terms of the UCAS tariff, the AS is worth half the points of a GCE Advanced Level qualification. There are certain subjects that are only available at AS Level and can be taken as free-standing qualifications.<br><br>

                            <li>Why should students study AS and A Level?<br>

                            The CIE AS and A Levels are internationally benchmarked qualifications providing excellent preparation for university education. They are taken in over 160 countries and offer a choice of 60 different subjects and are widely recognised and valued <http://www.cie.org.uk/qualifications/academic/uppersec/alevel/recognition> by universities and employers alike. Some US universities give up to a year’s credit as a result. Every year, thousands of A Level students gain places at good universities worldwide—including the UK, USA, Canada, New Zealand, Australia and Nepal.<br><br>

                            <li>What are the benefits of studying AS and A Levels rather than +2?<br>

                            The main reason for choosing AS and A Levels to +2 would be the international recognition. Cambridge International AS and A Levels have widespread international recognition as educational qualifications. This recognition is because:
                            <ul>
                               <li>CIE AS and A Levels qualifications are recognised by universities as equivalent in value to UK AS and A Levels

                              <li> Good grades at AS and A Levels can result in one full year of advanced standing or credit at universities in the USA and Canada
                                <li>It is accepted as an entry qualification by universities of the European Union, at par with the French Baccalaureate, the German Abitur, etc

                               <li>Good AS and A Level grades are vital for admission to all the world’s major English-speaking universities and many non-English-speaking universities

                              <li> AS and A Levels are rigorous programmes that encourage high academic standards

                              <li> AS and A Levels have a high profile amongst English-medium international schools around the world
                         </ul>

                    </span><br><br>
                    <span> Top Colleges:                     
                          <ul>
                           <li>Little Angel's College 
                           <li>Xavier International College
                           <li>Gandaki Boarding Higher Secondary School 
                           <li>Kathmandu Academy
                           <li>Malpi International College 
                           <li>Kathmandu Valley Higher Secondary School
                           <li>Saipal Academy
                           <li>Lumbini International College
                           <li>Orient College of Science and Management
                            <li>Cosmos International College

                        </ul>
                    </span>
                    </div>
                </div>
                                                                       
            </div>

<div class = 'fakeWrapper' id = 'fakeWrapperID'></div>
<script src = '../js/main.js'></script>
</body>
</html>