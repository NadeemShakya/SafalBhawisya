<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Safal Bhawishya</title>
	<link rel="stylesheet" href="css/main.css">
	<link rel="icon" href="image/logo.png">
	<link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
</head>
<body>
	<div class = "mainWrapper">
		<div class = "fakeWrapper">
			<div class = "navigation">
				<button onclick = 'openForm("login")'>Login</button>
				<button onclick = 'openForm("signup")'>Signup</button>

			</div>
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
				<!-- 	<p>Passwords Doesn't Match!</p>
					<p>nadim</p> -->
				</div>
				<div class = "signupBody" id = 'signupBodyID'>
					<form action="signup.php" method = 'POST' name = 'signupForm' onsubmit=" return validator()">
						<input type = "text" placeholder=" Full Name" required>
						<input type = "password" placeholder=" Password" id = 'signupPassword' required>
						<img src="image/view.png" alt="please_reload" class = 'visibilityImg' id = 'visibilityImgID' onclick = 'togglePassword("signup")' title = 'Toggle Password'>
						<input type = "password" placeholder = "Verify Password" id = 'signupPasswordVerify' required>
						<input type = "email" placeholder=" Email" required>
						<!-- <input type="number" placeholder = "Mobile Number"  id = 'loginNumberID'>
						<select name = "gender" id="genderID" required>
							<option value="">Gender</option>
							<option value="male">Male</option>
							<option value="female">Female</option>
						</select> -->
						<input type = 'text' list = 'address' placeholder = "Address" required>

						<datalist id = 'address'>
							<option value="Gwarko, Lalitpur">Gwarko, Lalitpur</option>
							<option value="Lagankhel, Lalitpur">Gwarko, Lalitpur</option><option value="Gwarko, Lalitpur">Kumaripati, Lalitpur</option><option value="Lokanthali, Kathmandu">Gwarko, Lalitpur</option>
							<option value=""></option>
						</datalist>
						<input type="submit" value = 'Signup' >
						<br>
						<hr>
						<input type="submit" value = 'Signup with Google' >
						<input type="submit" value = 'Signup with Facebook' >

						
					</form>
				</div>

				<div class = 'loginBody' id = 'loginBodyID'>
					<form action="">
						<input type="text" placeholder = 'Mobile Number' required >
						<input type="password" placeholder = 'Password' id = 'loginPassword' required>
						<img src="image/view.png" alt="please_reload" class = 'visibilityImg' onclick = 'togglePassword("login")' title = 'Toggle Password'>
						<input type="submit" value = 'Login'>
						<br>
						<hr>
						<input type = 'submit' value = 'Login With Facebook'>
						<input type="submit" value = 'Login with Google'>

					</form>
				</div>
			</div>
		</div>
	</div>
<script src = 'main.js'></script>
</body>
</html>