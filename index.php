<?php
//Include GP config file && User class
include_once 'gpConfig.php';
include_once 'User.php';
include 'dbh.php';
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
<html>
<head>
    <meta charset="utf-8">
    <title>Safal Bhawishya</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <link rel="icon" href="image/logo.png">
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,500,700" rel="stylesheet">
</head>
<body>
    <div class ='mainWrapper'>

            <!-- Start of Login and Signup Form -->
            <div class = 'signupWrapper'>
                <div class = "signupForm" id = 'signupFormID'> 
                    <div class = "signupHeader">
                        <img src="image/cross.png" alt="" class = 'crossButton' id = 'crossButtonID' title = 'Close Form'>
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
                            <img src="image/view.png" alt="please_reload" class = 'visibilityImgSignup' id = 'visibilityImgID' onclick = 'togglePassword("signup")' title = 'Toggle Password'>
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
                    <div class = 'errormsgDisplay' id = 'errormsgDisplayID'>
                        <?php echo 'incorrect login credentials!';?>
                    </div>
                         <?php 
                        echo '
                            <form action="'.filter_var($authUrl, FILTER_SANITIZE_URL).'" method = "POST">
                                <input type="submit" value = "Login with Google" class = \'googleLogin\'>
                            </form>
                        ';
                         ?> <hr>
                        <form action="login.php" method = 'POST'>
                            
                            <input type="text" placeholder = 'Email' name = 'email' autocomplete = 'off' required >
                            <input type="password" placeholder = 'Password' id = 'loginPassword' name = 'password' required>
                            <img src="image/view.png" alt="please_reload" class = 'visibilityImgLogin' onclick = 'togglePassword("login")' title = 'Toggle Password'>
                            <input type="submit" value = 'Login' class = 'normalLogin' name = 'loginButton'>
                            <br>

                        </form>

                    </div>
                </div>  
            </div>
            <!-- End of Signup Login Form -->

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
                    <!-- adding menu icon for responsive design. -->
                    <?php
                        if(!isset($_SESSION['log'])) {
                            echo' <img src="image/menu.svg" alt="please_reload" class = "menuIcon" onclick = "showmobileLogin()">';
                 
                        }
                    ?>
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

                                                    echo '<img src="./image/user.png" alt="plssease_reload" class = "profileImgIcon">
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
                                <li><a href="profile.php?value=Science">My Profile</a></li>
                                <li><a href="logout.php">Logout</a></li>
                            </ul>
                        </div>
                </div>
            </div>
            <div class = "thirdnavBar" id = 'thirdnavBarID'>
                <ul>
                    <li onclick = 'openForm("login")'>Login</li>
                    <li onclick = 'openForm("login")'>Signup</li>
                </ul>
            </div>
            <div class = 'banner'>
               <img src="image/back.png" alt="please_reload" class = 'desktopBanner'>
               <div class = "mobBanner">
                   <h1><span class = 'safalText'>SAFAL</span> <span class = 'bhawishyaText'>BHAWISHYA</span></h1>
                   <p>Our Goal, <span class = 'futureText'>Your Future.<span></p>
               </div>
            </div>

            <div class = 'secondnavBar'>
                <ul>
                    <li> SafalBhawishya Gives You:</li>
                    <li> <img src = 'image/careerguide.svg'> Career Paths </li>
                    <li> <img src = 'image/test.svg'>&nbsp Aptitude Test</li>
                    <li> <img src = 'image/record.svg'>Test Records</li>

                </ul>
            </div>


            <div class="main-section">
                <h1>Make your Bhawishya Safal.</h1>
                <h3>View our top features, prepare yourselves.</h3>
                <a href="careerguide/careerguide.php">
                <div class="portion1">
                    <div class = 'fakeDiv'>
                        <div class = 'information'>Find all the possible career paths you can choose after your S.E.E. Along with that, get to know where each and every career path leads you in the future. <br> We have atleast 50 career paths with their future scopes like job placement, salary scale, popularity etc. </div>
                    </div>
                    <div class = 'text-portion1'>
                        CAREER PATH
                    </div>
                    <img src="image/careerguide.jpeg" alt = "please_reload">
                </div>
                </a>
                <a href="aptitudeTest/selection.php">
                <div class="portion2">
                  
                    <div class = 'fakeDiv'>
                        <div class = "information">
                        200+ frequently asked questions for entrance exams in top colleges like St.Xavier's, United Academy. Take our aptitude test to prepare yourselves for the upcoming entrance tests. <br><br>With our tests, get to know your inherent skills and keep track of your progress points in all the subjects so that you can know which subject to focus more for getting through the entrance exams with flying colors.
                        </div>

                    </div>
                    <div class = 'text-portion2'>
                       APTITUDE TEST
                    </div>                      
                    <img src="image/aptitudetest.jpg" alt = "please_reload">

                </div>
                </a>
                <a href="faq.php">
                <div class="portion3">
                     <div class = 'fakeDiv'>
                        <div class = "information">
                            Some frequetly asked questions by our users which might help you to get through your problems with using our website.
                        </div>

                    </div>
                    <div class = 'text-portion3'>
                       FAQ
                    </div>                    
                    <img src="image/faq.jpeg" alt = "please_reload">

                </div>  
                </a>
            </div>
    
            <div class="info">
                <div class="infotext">
                    <h2 class = 'infotext-header'>  WHY SAFALBHAWISHYA? </h2>
                    <p> Many students in Nepal feels helpless when it comes to decide their courses or careers. They have their aims and dreams but they are unaware of the path which can guide them to become successful person in their desired field. The biggest problem today for Nepalese students is that there is a huge shortage of good and credible career counselors. While there are many who masquerade as Career Counselors in many cities and towns; however, they are not true career counselors, most of the times their objective is to get the personal information about the student and then somehow persuade them to take admission in second grade colleges and universities. There is a lack of online career counseling sites based on Nepal’s education and career development sector. Due to this many student choose wrong course and ruin their career unknowingly. In order to resolve all these kinds of problems faced by students, this project is intended. 
                    <br>    
                    Our project focuses to help students solve every kind of problem raised while choosing their courses and career. It will help them choose their careers by not only providing them with a list of choices out there but also test their real inherent talent using standardized and reliable aptitude tests. This will surely help them excel and be extra-ordinary performer in their future.</p>
                </div>
                
        <!--         <div class="infoimg">
                        <img src="image/whysafalbhawishya.png" alt="please_reload ">
                </div> -->
            </div>

            <div class="footer">
                &copy SafalBhawishya.com.np 2018 Nepal <br> 
                Developed and Maintained by SafalBhawishya Team.

            </div>
        <div class = 'fakeWrapper' id = 'fakeWrapperID'></div>

    </div>

<script src = 'js/main.js'></script>
</body>
</html>