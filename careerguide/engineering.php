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
						<img src="../image/civil.jpg" alt="please_reload">
					</div>
					<div class = "listDivText">
						<h3>Civil Engineering</h3>
						<span>Civil engineering is the most popular and oldest discipline of engineering in Nepal and outside Nepal too. There are wide variety of scopes that civil engineers deal with. The most common infrastructures of civilizations like building a home or bridge, designing a road line involves civil engineering.Most of the engineering colleges in Kathmandu as well as other cities in Nepal have maximum number of seats for Civil Engineering.Civil engineering is an exciting and rewarding profession in Nepal as it is in rest of the world. The career prospects of civil engineering is unlimited. They can work in small construction projects to designing space stations.</span> <br><br>
						<label>Course Duration </label>
						<span>4 Years</span> <br>
					</div>
					<button onclick = "document.location.href = 'civilEngineering.php'">View Course</button>
				</div>
                <div class = "listDiv">
                    <div class = "listDivImg">
                        <img src="../image/electrical.jpeg" alt="please_reload">
                    </div>
                    <div class = "listDivText">
                        <h3>Electrical Engineering</h3>
                        <span>An electrical engineer is the person who is behind the design, development and innovation of new electrical equipments by using his/her engineering skills in the research, design, testing and development. An electrical engineer is a specialized type of engineer who deals with electronics, electromagnetism and electric energy.Electrical engineers work in various projects ranging from small-scale pocket devices to huge projects like satellite and robotics.</span> <br><br>
                        <label>Course Duration </label>
                        <span>4 Years</span> <br>
                    </div>
                    <button onclick = "document.location.href = 'electrical.php'">View Course</button>
                </div>
                <div class = "listDiv">
                    <div class = "listDivImg">
                        <img src="../image/electronic.jpeg" alt="please_reload">
                    </div>
                    <div class = "listDivText">
                        <h3>Electronic Engineering</h3>
                        <span>Electronics engineers create, design and develop everyday devices such as mobile phones, portable music devices and computers. Electronic engineering offers the chance to produce new innovations and developments in telecommunications, robotics, computing hardware, and power and electrical equipment.</span> <br><br>
                        <label>Course Duration </label>
                        <span>4 Years</span> <br>
                    </div>
                    <button onclick = "document.location.href = 'electronic.php'">View Course</button>
                </div>
                
                <div class = "listDiv">
                    <div class = "listDivImg">
                        <img src="../image/computer.jpeg" alt="please_reload">
                    </div>
                    <div class = "listDivText">
                        <h3>Computer Engineering</h3>
                        <span>Computer science engineering is one the best engineering course with excellent scope, growth and salary packages. If you are planning to pursue computer science engineering, here we have exposed everything that will help and guide you to take decision wisely and to know the future scope with this engineering branch.</span> <br><br>
                        <label>Course Duration </label>
                        <span>4 Years</span> <br>
                    </div>
                    <button onclick = "document.location.href = 'computer.php'">View Course</button>
                </div>
                <div class = "listDiv">
                    <div class = "listDivImg">
                        <img src="../image/mech.jpeg" alt="please_reload">
                    </div>
                    <div class = "listDivText">
                        <h3>Mechanical Engineering</h3>
                        <span>Mechanical engineering is the discipline that applies engineering, physics, engineering mathematics, and materials science principles to design, analyze, manufacture, and maintain mechanical systems. It is one of the oldest and broadest of the engineering disciplines.The mechanical engineering field requires an understanding of core areas including mechanics, dynamics, thermodynamics, materials science, structural analysis, and electricity.</span> <br><br>
                        <label>Course Duration </label>
                        <span>4 Years</span> <br>
                    </div>
                    <button onclick = "document.location.href = 'civil.php'">View Course</button>
                </div>
 
                <div class = "listDiv">
                    <div class = "listDivImg">
                        <img src="../image/geo.jpeg" alt="please_reload">
                    </div>
                    <div class = "listDivText">
                        <h3>Geomatics Engineering</h3>
                        <span>Geomatics Engineering, Geomatic Engineering, Geospatial Engineering is a rapidly developing engineering discipline that focuses on spatial information . The location is the primary factor used to integrate a very wide range of data for spatial analysis and visualization. Geomatics engineers apply engineering principles to spatial information and implement relational data structures involving measurement sciences, thus using geomatics and acting as spatial information engineers. </span> <br><br>
                        <label>Course Duration </label>
                        <span>4 Years</span> <br>
                    </div>
                    <button onclick = "document.location.href = 'civil.php'">View Course</button>
                </div>   
                <div class = "listDiv">
                    <div class = "listDivImg">
                        <img src="../image/enve.jpeg" alt="please_reload">
                    </div>
                    <div class = "listDivText">
                        <h3>Environmental Engineering</h3>
                        <span>Environmental engineering system is the branch of engineering concerned with the application of scientific and engineering principles for protection of human populations from the effects of adverse environmental factors; protection of environments, both local and global, from potentially deleterious effects of natural and human activities; and improvement of environmental quality.Environmental engineering system can also be described as a branch of applied science and technology that addresses the issues of energy preservation, protection of assets and control of waste from human and animal activities.</span> <br><br>
                        <label>Course Duration </label>
                        <span>4 Years</span> <br>
                    </div>
                    <button onclick = "document.location.href = 'civil.php'">View Course</button>
                </div>   
                   
                <div class = "listDiv">
                    <div class = "listDivImg">
                        <img src="../image/chem.jpeg" alt="please_reload">
                    </div>
                    <div class = "listDivText">
                        <h3>Chemical Engineering</h3>
                        <span>Chemical engineering is a branch of engineering that uses principles of chemistry, physics, mathematics and economics to efficiently use, produce, transform, and transport chemicals, materials and energy. A chemical engineer designs large-scale processes that convert chemicals, raw materials, living cells, microorganisms and energy into useful forms and products. Chemical engineers are involved in many aspects of plant design and operation, including safety and hazard assessments, process design and analysis, control engineering, chemical reaction engineering, construction specification and operating instructions.</span> <br><br>
                        <label>Course Duration </label>
                        <span>4 Years</span> <br>
                    </div>
                    <button onclick = "document.location.href = 'civil.php'">View Course</button>
                </div>                                          
			</div>

<div class = 'fakeWrapper' id = 'fakeWrapperID'></div>
<script src = '../js/main.js'></script>
</body>
</html>