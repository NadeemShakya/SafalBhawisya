  <?php 

    include 'dbh.php';
    session_start();

   ?>

  <!DOCTYPE html>
  <head> 
    <meta charset="utf-8">
    <title>Safal Bhawishya</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="css/faq.css">
    <link rel="stylesheet" type="text/css" href="css/main.css">

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
                                    <li onclick = \'openForm("signup")\'><a href="#">Signup</a></li>';
                            }
                         ?>
                    </ul>
               </div>
    </div>

      <hr>
    <div class= "faqWrapper">
      <h2>Questions You May Have</h2>
      <button onclick = "show_answer1()" class="faq_ques"> What can I do to register an account? </button>
        <div class="faq_ans" >
          <p id = "answer1" style="display:none"> You can either fill the signup form or you can even signup using your google account. </p>
        </div>

      <button onclick = "show_answer2()" class="faq_ques"> How do I login using Google? </button>
        <div class="faq_ans" >
         <p id = "answer2" style="display:none"> Press the login with google button present in login section if you already have a google account. </p>
         
      </div>

      <button onclick = "show_answer3()" class="faq_ques"> How do I take aptitude test? </button>
        <div class="faq_ans" >
          <p id = "answer3" style="display:none"> You must login first. Then enter aptitude test section. You can take exam of science or management section.
         </p>
      </div>

      <button onclick = "show_answer4()" class="faq_ques"> How do I see my result?</button>
        <div class="faq_ans" >
          <p id = "answer4" style="display:none"> After completing the test press submit button which will lead you to your scorecard having the result of test.
         </p>
      </div>

      <button onclick = "show_answer5()" class="faq_ques"> Can I change my name afterwards?</button>
        <div class="faq_ans" >
          <p id = "answer5" style="display:none"> Currently the system won't allow you to change name afterwards. Be careful while you signup.
         </p>
      </div>

      <button onclick = "show_answer6()" class="faq_ques"> Can I reset my password?</button>
        <div class="faq_ans" >
          <p id = "answer6" style="display:none">  Currently the system won't allow you to change password afterwards. Your password is encrypted so noone knows it except you.
         </p>
      </div>
    </div>

      <div class="right_faq">
         <img src="image/faq_img.png" alt="please_reload" class="faq_img">
       </div>


    <script src = 'faq.js'> </script>
     
</body>