var leftDiv = document.getElementById('leftDivID');
var rightDiv = document.getElementById('rightDivID');

leftDiv.addEventListener('mouseenter', function() {
		document.getElementById('managementButton').style.display = "block";
});

leftDiv.addEventListener('mouseleave', function() {
	document.getElementById('managementButton').style.display = "none";

})
rightDiv.addEventListener('mouseenter', function() {
		document.getElementById('scienceButton').style.display = "block";
});
rightDiv.addEventListener('mouseleave', function() {
		document.getElementById('scienceButton').style.display = "none";
});


