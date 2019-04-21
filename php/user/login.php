<?php
	session_start();
	require_once('../core/db.php');

	$username = $_POST['username'];
	$password = $_POST['password'];
	$prev = $_SERVER['HTTP_REFERER'];

	if(empty($username) || empty($password)){
		$_SESSION['errorMsg'] = "Ошибка: имя пользователя или пароль не могут быть пустыми";
		header("Location: $prev");
		exit();
	}else{
		$_SESSION['errorMsg'] = NULL;
		$_SESSION['notice'] = NULL;
		$query = "SELECT * FROM user WHERE username = '$username' AND password = '$password'";
		$result = $mysqli->query($query) or die('Ошибка '.$mysqli->error);

	if(mysqli_num_rows($result)){
		// while(
		$row = mysqli_fetch_array($result);
	//)
		//{
			$_SESSION['user_id'] = $row['user_id'];
			$_SESSION['username'] = $row['username'];
		//}
		header("Location: $prev");
		exit();
	}else{
		$_SESSION['errorMsg'] = "Ошибка: Неправильное имя пользователя или пароль";
		header("Location: $prev");
		exit();
	}
}

?>
