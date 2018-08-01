<?php 
	session_start();
	include '../dbh.php';

	$email = $_SESSION['email'];
	$faculty = $_SESSION['faculty'];

	if($faculty == 'Science') {
		// obtaining Maths' Point.
		$sql = "SELECT * FROM pointstablescience WHERE email = '$email' AND Category = 'Maths'";
		$result = mysqli_query($conn, $sql);
		$row = mysqli_fetch_assoc($result);
		$mathsPoint = $row['points'];
		// Obtaing Chemistry's Point.
		$sql = "SELECT * FROM pointstablescience WHERE email = '$email' AND Category = 'Chemistry'";
		$result = mysqli_query($conn, $sql);
		$row = mysqli_fetch_assoc($result);
		$chemistryPoint = $row['points'];
		// Obtaining Biology's Point.
		$sql = "SELECT * FROM pointstablescience WHERE email = '$email' AND Category = 'Biology'";
		$result = mysqli_query($conn, $sql);
		$row = mysqli_fetch_assoc($result);
		$biologyPoint = $row['points'];

		// Obtaining Physics's  Point
		$sql = "SELECT * FROM pointstablescience WHERE email = '$email' AND Category = 'Physics'";
		$result = mysqli_query($conn, $sql);
		$row = mysqli_fetch_assoc($result);
		$physicsPoint = $row['points'];

		//Obtaining English's Point 
		$sql = "SELECT * FROM pointstablescience WHERE email = '$email' AND Category = 'English'";
		$result = mysqli_query($conn, $sql);
		$row = mysqli_fetch_assoc($result);
		$englishPoint = $row['points'];


		$sql = "SELECT * FROM progressscience WHERE email = '$email' ";
		$result = mysqli_query($conn, $sql);
		$row_count = mysqli_num_rows($result);

		if($row_count == 0) {
			// User's data isn't present so insert new.
			$sql = "INSERT INTO progressscience VALUES('$email', '$mathsPoint', '$chemistryPoint', '$biologyPoint', '$physicsPoint', '$englishPoint', 1)";
			$result = mysqli_query($conn, $sql);

		}else if($row_count > 0) {
			// User's Data is already present so update.
			$sql = "SELECT * FROM progressscience WHERE email = '$email'";
			$result = mysqli_query($conn, $sql);
			$row = mysqli_fetch_assoc($result);

			//updating the current data.
			$mathsPoint += $row['Maths'];
			$chemistryPoint += $row['Chemistry'];
			$biologyPoint += $row['Biology'];
			$physicsPoint += $row['Physics'];
			$englishPoint += $row['English'];
			$totalTest = $row['totalTest'];
			echo $totalTest;
			$sql = "UPDATE progressscience SET email = '$email', Maths = '$mathsPoint', Chemistry = '$chemistryPoint', Biology = '$biologyPoint', Physics = '$physicsPoint', English = '$englishPoint', totalTest = '$totalTest'";
			$result = mysqli_query($conn, $sql);
			if(!$result) {
				echo 'Error';
			}
		}
		// Delete the ONCE-DISPLAY data from the pointstablescience.
		$sql = "DELETE FROM pointstablescience WHERE email = '$email'";
		$result = mysqli_query($conn, $sql);
		$sql1 = "DELETE FROM testscience WHERE email = '$email'";
		$result1 = mysqli_query($conn, $sql1);
		if(!$result1) {
			echo 'Error In Deleteing the temporary data from the testscience table';
		}
		if(!$result) {
			echo 'error in deleting the temporary data from the pointstablescience';
		}
	}else if($faculty == 'Management') {
		// obtaining GK's Point.
		$sql = "SELECT * FROM pointstablemanagement WHERE email = '$email' AND Category = 'GK'";
		$result = mysqli_query($conn, $sql);
		$row = mysqli_fetch_assoc($result);
		$GKPoint = $row['points'];
		//Obtaining English's Point
		$sql = "SELECT * FROM pointstablemanagement WHERE email = '$email' AND Category = 'English'";
		$result = mysqli_query($conn, $sql);
		$row = mysqli_fetch_assoc($result);
		$englishPoint = $row['points'];
		//Obtaining Account Point
		$sql = "SELECT * FROM pointstablemanagement WHERE email = '$email' AND Category = 'Account'";
		$result = mysqli_query($conn, $sql);
		$row = mysqli_fetch_assoc($result);
		$accountPoint = $row['points'];

		$sql = "SELECT * FROM progressmanagement WHERE email = '$email' ";
		$result = mysqli_query($conn, $sql);
		$row_count = mysqli_num_rows($result);

		if($row_count == 0) {
			// User's data isn't present so insert new.
			$sql = "INSERT INTO progressmanagement VALUES('$email', '$accountPoint', '$GKPoint', '$englishPoint', 1)";
			$result = mysqli_query($conn, $sql);

		}else if($row_count > 0) {
			// User's Data is already present so update.
			$sql = "SELECT * FROM progressmanagement WHERE email = '$email'";
			$result = mysqli_query($conn, $sql);
			$row = mysqli_fetch_assoc($result);
			//updating the current data.
			$GKPoint += $row['GK'];
			$englishPoint += $row['English'];
			$accountPoint += $row['Account'];
			$totalTest = $row['totalTest'];
			$totalTest += 1;
			$sql = "UPDATE progressmanagement SET email = '$email', GK = '$GKPoint', Account = '$accountPoint', English = '$englishPoint', totalTest = '$totalTest'";
			$result = mysqli_query($conn, $sql);
			if(!$result) {
				echo 'Error';
			}
		}
		// Delete the ONCE-DISPLAY data from the pointstablescience.
		$sql = "DELETE FROM pointstablemanagement WHERE email = '$email'";
		$result = mysqli_query($conn, $sql);
		if(!$result) {
			echo 'error in deleting the temporary data from the pointstablescience';
		}
		$sql1 = "DELETE FROM testmanagement WHERE email = '$email'";
		$result1 = mysqli_query($conn, $sql1);
		if(!$result1) {
			echo 'Error In Deleteing the temporary data from the testscience table';
		}
	}

	// redirect to the index page.
	header('Location: ../index.php');
 ?>