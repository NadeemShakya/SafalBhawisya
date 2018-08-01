let scienceOption = document.getElementById('scienceOption_ID');
let managementOption = document.getElementById('managementOption_ID');

scienceOption.addEventListener("click", function(){
	// console.log("clicked");
	// alert("hello");
	scienceOption.style.backgroundColor = "#02b875";
	scienceOption.style.color = "#fff";
	managementOption.style.backgroundColor = "#fff";
	managementOption.style.color = '#02b875';

});
