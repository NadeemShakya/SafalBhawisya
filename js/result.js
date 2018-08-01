var faculty = document.getElementById('faculty').value;
console.log('hello');
if(faculty == 'Science') {
	var chemistry = document.getElementById('Chemistry');
	var chemistryPoint = parseInt(chemistry.innerHTML);
	var chemistryPercent = (chemistryPoint / 15) * 100;
	chemistry.style.width = chemistryPercent + "%";
	chemistry.innerHTML = parseInt(chemistryPercent) + "%";

	var maths = document.getElementById('Maths');
	var mathsPoint = parseInt(maths.innerHTML);
	var mathsPercent = (mathsPoint / 15) * 100;
	maths.style.width = mathsPercent + "%";
	maths.innerHTML = parseInt(mathsPercent) + "%";

	var physics = document.getElementById('Physics');
	var physicsPoint = parseInt(physics.innerHTML);
	var physicsPercent = (physicsPoint / 15) * 100;
	physics.style.width = physicsPercent + "%";
	physics.innerHTML = parseInt(physicsPercent) + "%";

	var biology = document.getElementById('Biology');
	var biologyPoint = parseInt(biology.innerHTML);
	var biologyPercent = (biologyPoint / 15) * 100;
	biology.style.width = biologyPercent + "%";
	biology.innerHTML = parseInt(biologyPercent) + "%";

	var english = document.getElementById('English');
	var englishPoint = parseInt(english.innerHTML);
	var englishPercent = (englishPoint / 15) * 100;
	english.style.width = englishPercent + "%";
	english.innerHTML = parseInt(englishPercent) + "%";

}else if(faculty == 'Management') {
	var account = document.getElementById('Account');
	var accountPoint = parseInt(account.innerHTML);
	var accountPercent = (accountPoint / 1) * 100;
	account.style.width = accountPercent + "%";
	account.innerHTML = parseInt(accountPercent) + "%";

	var english = document.getElementById('English');
	var englishPoint = parseInt(english.innerHTML);
	var englishPercent = (englishPoint / 1) * 100;
	english.style.width = englishPercent + "%";
	english.innerHTML = parseInt(englishPercent) + "%";

	var GK = document.getElementById('GK');
	var GKPoint = parseInt(GK.innerHTML);
	var GKPercent = (GKPoint / 2) * 100;
	GK.style.width = GKPercent + "%";
	GK.innerHTML = parseInt(GKPercent) + "%";
}
