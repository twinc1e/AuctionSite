<?php
	session_start();
	include 'function/db.php';
	
	$username = $_POST['username'];
	$password = $_POST['password'];
	$prev = $_SERVER['HTTP_REFERER'];
	
	if(empty($username) || empty($password)){
		$_SESSION['errorMsg'] = "Error: username and password cannot be blank";
		header("Location: $prev");
		exit();
	}else{
		$_SESSION['errorMsg'] = NULL;
		$_SESSION['notice'] = NULL;
		$query = "SELECT * FROM user WHERE username = '$username' AND password = '$password'";
		$result = $mysqli->query($query) or die(mysqli_error());
		
		if(mysqli_num_rows($result)){
			while($row = mysqli_fetch_array($result))
			{
				$_SESSION['user_id'] = $row['user_id'];
				$_SESSION['username'] = $row['username'];
			}
			
			
			header("Location: $prev");
			exit();
		}else{
			$_SESSION['errorMsg'] = "Error: username or password are incorrect, please try again.";
			header("Location: $prev");
			exit();
		}		
	}
	
?>