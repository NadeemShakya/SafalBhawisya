fakeWrapper = document.getElementById('fakeWrapperID');
let loginButton = document.getElementById('loginID');
let signupButton = document.getElementById('signupID');
let loginBody = document.getElementById('loginBodyID');
let signupBody = document.getElementById('signupBodyID');
let closeButton = document.getElementById('crossButtonID');
let signupForm = document.getElementById('signupFormID');
let signupText = document.getElementById('signupTextID');
let loginText = document.getElementById('loginTextID');
let errormsg = document.getElementById('errormsgDisplayID');
let profileOptionsDiv = document.getElementById('profileOptions-DivID');
let mobileLogin = document.getElementById('thirdnavBarID');
function showprofileOptions() {
	if(profileOptionsDiv.style.display == "none") {
		profileOptionsDiv.style.display = "block";
	}else {
		profileOptionsDiv.style.display = "none";

	}
}

function showLoginForm() {
	fakeWrapper.style.display = 'block';
	signupBody.style.display = 'none';
	loginBody.style.display = 'block';

	//alteration in signupButton color	
	signupButton.style.backgroundColor = '#15c39a';
	signupText.style.color = '#fff';
	//alteration in loginButton color
	loginText.style.color = '#15c39a';
	loginButton.style.backgroundColor = '#fff';

}

function showSignupForm() {

	loginBody.style.display = 'none';
	signupBody.style.display = 'block';
	//alteration in signupButton color	
	signupButton.style.backgroundColor = '#fff';
	signupText.style.color = '#15c39a';
	//alteration in loginButton color
	loginText.style.color = '#fff';
	loginButton.style.backgroundColor = '#15c39a';

}
function closeForm() {
	signupForm.style.display = 'none';
	fakeWrapper.style.display = 'none';

}
function openForm(value) {
	fakeWrapper.style.display = 'block';
	signupForm.style.display = 'block';

	if(value == 'login') {
		showLoginForm();
	}else if(value == 'signup'){
		showSignupForm();
	}

}
function togglePassword(value) {
	if(value == 'signup') {
		let image = document.getElementById('visibilityImgID');
		let x = document.getElementById('signupPassword');
		if(x && x.type == 'password') {
			x.type = 'text';
		}else {
			x.type = 'password';	
		}
	}else if(value == 'login') {
		let x = document.getElementById('loginPassword');
		if(x && x.type == 'password') {
				x.type = 'text';
		}else {
			x.type = 'password';	
		}
	}

	
}
loginButton.addEventListener('click', showLoginForm);
signupButton.addEventListener('click', showSignupForm);
closeButton.addEventListener('click', closeForm);

function validator() {
	let password1 = document.getElementById('signupPassword');
	let password2 = document.getElementById('signupPasswordVerify');	
	//checking if password matches.
	if(password1.value !== password2.value) {
		errormsg.style.display = 'block';
		let p1 = document.createElement('p');
		let p1text = document.createTextNode('Password Doesn\'t Match');
		p1.appendChild(p1text);
		errormsg.appendChild(p1);
		return false;
	} else {
		return true;
	}

}

function showmobileLogin() {
	if(mobileLogin.style.display == 'block') {
		mobileLogin.style.display = 'none';

	}else {
		mobileLogin.style.display = 'block';

	}
}