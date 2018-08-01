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
                        <img src="image/bsc.jpeg" alt="please_reload">
                    </div>
                    <div class = "listDivText">
                        <h3>BSc</h3>
                        <span>Bachelor of Science (BSc) offers theoretical as well as practical knowledge about different subject areas. These subject areas usually include any one of the main Science fields (Physics, Chemistry, and Biology) and other fields depending on the specialisation a student opts. <br><br>
                        Pursuing a BSc course is most beneficial for students who have a strong interest and background in Science and Mathematics. The course is also beneficial for students who wish to pursue multi and inter-disciplinary science careers in future.<br><br>To know about bachelor of science click view course button: </span>
                    </div>
                    <button onclick = "document.location.href = 'bsc.php'">View Course</button>
                </div>

				<div class = "listDiv">
					<div class = "listDivImg">
						<img src="image/mbbs.jpeg" alt="please_reload">
					</div>
					<div class = "listDivText">
						<h3>MBBS</h3>
						<span>There is a great demand for medical professionals and it is increasing with the unfortunate upsurge of diseases and ailments day by day. Also, many super specialty hospitals are mushrooming offering employment opportunities. Some of the places where there is job scope for medical professionals are as follows...</span> <br><br>
						<label>Course Duration </label>
						<span>Four and a half year integrated program followed by a compulsory internship training of one year.</span> <br>
					</div>
					<button onclick = "document.location.href = 'MBBS.php'">Read More</button>
				</div>

                <div class = "listDiv">
                    <div class = "listDivImg">
                        <img src="image/bds.jpeg" alt="please_reload">
                    </div>
                    <div class = "listDivText">
                        <h3>Bachelors of Dental Surgery</h3>
                        <span>Those students who complete the BDS course have many opportunities in Dentistry. They can look forward for career in dental departments in private and government hospitals, dental treatments centers and even in teaching department. They can open their own private dental clinic. Besides this, they can get jobs with pharmaceutical companies and other firms that develop oral care products....</span> <br><br>
                        <label>Course Duration </label>
                        <span>4 Years</span> <br>
                    </div>
                    <button onclick = "document.location.href = 'BDS.php'">Read More</button>
                </div>

                <div class = "listDiv">
                    <div class = "listDivImg">
                        <img src="image/pharmacy.jpeg" alt="please_reload">
                    </div>
                    <div class = "listDivText">
                        <h3>Bachelor of Pharmacy</h3>
                        <span>In Nepal, there is a good scope of pharmacy because in the context of 2057-2067 only 4% of doctors, nurses are there to attend the patients. As, in Nepal there are many places where chemical drugs i.e. medicines are not available till today’s date. So, we always need pharmacy and pharmacist to fulfill the lack of medicines and clinics. In fact, Pharmacist have provision to open their own clinic therefore, ...</span> <br><br>
                        <label>Course Duration </label>
                        <span>4 Years</span> <br>
                    </div>
                    <button onclick = "document.location.href = 'pharmacy.php'">Read More</button>
                </div>
                <div class = "listDiv">
                    <div class = "listDivImg">
                        <img src="image/ayur.jpeg" alt="please_reload">
                    </div>
                    <div class = "listDivText">
                        <h3>Bachelor of Ayurvedic Medicine and Surgery (BAMS)</h3>
                        <span>Ayurvedic Sciences and courses are becoming more and more popular in recent days not only in Nepal and India but also in European and American countries, be it the Panch Karma Therapy or the medicines or massages. The trend of SPAs and the requirement of being counseled by a good Ayurvedic doctor has become the need of the hour. Nepal have its history and culture for providing it with a secret for not only ...</span> <br><br>
                        <label>Course Duration </label>
                        <span>five and half years course including one year rotating internship</span> <br>
                    </div>
                    <button onclick = "document.location.href = 'ayurveda.php'">Read More</button>
                </div>
                <div class = "listDiv">
                    <div class = "listDivImg">
                        <img src="image/bph.jpeg" alt="please_reload">
                    </div>
                    <div class = "listDivText">
                        <h3>Bachelors in Public Health</h3>
                        <span>The completion in BPH opens up a variety of scopes for the BPH graduates in Nepal. The ones after passing BPH in Nepal can work as Public Health Officer in the government sector. They have the opportunities in becoming the Chief Public Health Officer.  Not only this there are a lot of organizations ...</span> <br><br>
                        <label>Course Duration </label>
                        <span>4 Years</span> <br>
                    </div>
                    <button onclick = "document.location.href = 'BPH.php'">Read More</button>
                </div>                
                <div class = "listDiv">
                    <div class = "listDivImg">
                        <img src="image/opto.jpeg" alt="please_reload">
                    </div>
                    <div class = "listDivText">
                        <h3>Bachelor of Optometry</h3>
                        <span>Ophthalmic Optics is a branch of science that deals primarily with the structure, function and the working of the human eye. Optometry is generally concerned with the examination, diagnosis and treatment of eyes especially related to visual, optical symptoms, refractive errors and ... </span> <br><br>
                        <label>Course Duration </label>
                        <span>4 Years</span> <br>
                    </div>
                    <button onclick = "document.location.href = 'optometry.php'">View Course</button>
                </div>
                
                <div class = "listDiv">
                    <div class = "listDivImg">
                        <img src="image/vet.jpeg" alt="please_reload">
                    </div>
                    <div class = "listDivText">
                        <h3>Bachelor in Veterinary Medicine</h3>
                        <span>Veterinary is the branch of science which deals with the study of animals. It is the most prestigious course which is more expensive after a law in the world. The course is for 5 years. In Nepal, It is called as the latest course. Earlier, only fewer students were used ...</span> <br><br>
                        <label>Course Duration </label>
                        <span>4 Years</span> <br>
                    </div>
                    <button onclick = "document.location.href = 'veterinary.php'">View Course</button>
                </div>


			</div>

<div class = 'fakeWrapper' id = 'fakeWrapperID'></div>
<script src = '../js/main.js'></script>
</body>
</html>