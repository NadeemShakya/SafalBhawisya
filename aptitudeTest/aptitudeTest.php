<?php 
	include '../dbh.php';
	session_start();
	$questions = [];
	$category = [];
	if($_SERVER['REQUEST_METHOD'] == "POST") {
		$faculty = $_POST['faculty'];
		$_SESSION['faculty'] = $faculty;
	}

	if($faculty == 'Science') {
		$sql = "SELECT * FROM aptitudetestscience ORDER BY RAND()";
		$result = mysqli_query($conn, $sql);
		while($row = mysqli_fetch_assoc($result)) {
			array_push($category, $row['Category']);
		}
		$category_length = sizeof($category);
		for($i = 0; $i < $category_length; $i++) {
			$questionFetch_sql = "SELECT * FROM questionsscience WHERE Category = '$category[$i]' ORDER BY RAND() LIMIT 10 ";	
			$questionFetch_result = mysqli_query($conn, $questionFetch_sql);
			while($questionFetch_row = mysqli_fetch_assoc($questionFetch_result)) {
				array_push($questions, $questionFetch_row['questionID']);
			}
		}

	}else if($faculty == "Management") {
		$sql = "SELECT * FROM aptitudetestmanagement ORDER BY RAND()";
		$result = mysqli_query($conn, $sql);
		while($row = mysqli_fetch_assoc($result)) {
			array_push($category, $row['Category']);
		}
		$category_length = sizeof($category);
		for($i = 0; $i < $category_length; $i++) {
			$questionFetch_sql = "SELECT * FROM questionmanagement WHERE Category = '$category[$i]' ORDER BY RAND() LIMIT 10 ";	
			$questionFetch_result = mysqli_query($conn, $questionFetch_sql);
			while($questionFetch_row = mysqli_fetch_assoc($questionFetch_result)) {
				array_push($questions, $questionFetch_row['questionID']);
			}
		}
	}
	
	$_SESSION['questions'] = $questions;
	header('Location: view.php?pageCounter=0&button=None');


 ?>