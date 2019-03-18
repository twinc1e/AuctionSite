<?php
// $passwords = array("manager@mail.ru"=>"1234",
// 				"test@mail.ru"=>"12345678");
// if($_POST['password']== $passwords[$_POST['username']])
// {
// 	setcookie('auth', 'true');
// 	$_SESSION["auth_usename"]=$_POST["username"];
// 	header('Location: ./dashboard.php');
// 	exit;
// }
// else
// {
// 	header('Refresh:0; url=../index.php');
// 	exit;
// }


require_once('core/db.php');
if( (isset($_POST['username'])) & (isset($_POST['password'])) ){ // если пользователь ввёл логин и пароль
	// проверяем наличие пользователя в БД и достаём оттуда пароль
	$res= $mysqli->query('SELECT COUNT(*) FROM Users')->fetch_row();
	if($res['0']>0) {// если пользователь есть в БД, достаём все данные из БД
		$userinfo = $mysqli->query('SELECT * FROM Users WHERE Login="'.$_POST['username'].'" AND Password="'.$_POST['password'].'" ORDER BY Login')->fetch_assoc();
		if($_POST['password']== $userinfo['Password'])
		{// пользователь авторизован
			setcookie('AUTH', 'true');
			//$_SESSION["auth_usename"]=$POST["username"];
			setcookie("login", $_POST['username'], time()+3600 * 24 * 365);
			setcookie("password",$_POST['password'], time()+3600 * 24 * 365);
			header('Location: ./dashboard.php');
			exit;
		}
		else {
			header( 'Refresh: 0; url=/error.html' ); // переадресовать на страницу ошибки немедленно (без задержки).
			exit;
		}
	}else {
		header( 'Refresh: 0; url=/error.html' ); // переадресовать на страницу ошибки немедленно (без задержки).
		exit;
	}
}else {
	header( 'Refresh: 0; url=/error.html' ); // переадресовать на страницу ошибки немедленно (без задержки).
	exit;
}
?>
