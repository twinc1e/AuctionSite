<?
require_once('db.php');
// if (!isset($_COOKIE['auth']))
// 	{
// 		header('Location: /index.php');
// 		exit;
// 	}
$AUTH=FALSE;
setcookie('AUTH', 'false');
//print_r("some", $_COOKIE['login']);
if($_COOKIE['login'] != '' and $_COOKIE['password'] != '') {
  $login=htmlspecialchars(trim($_COOKIE['login']));
  $password=htmlspecialchars(trim($_COOKIE['password']));
  $userinfo = $mysqli->query('SELECT * FROM Users WHERE Login="'.$login.'" AND Password="'.$password.'" ORDER BY Login')->fetch_assoc();
  if($password == $userinfo['Password'] && $login == $userinfo['Login']) {
  	$AUTH=TRUE;
    setcookie('AUTH', 'true');
    unset($login,$password);//удаляет перечисленные переменные
  } else {
    /*После передачи клиенту cookie станут доступны через массив $_COOKIE
     при следующей загрузке страницы. */
    setcookie("login");
    setcookie("password");
  }
}
//  else {
//   	header( 'Refresh: 5; url=../404.html');
//   exit();
// }
?>
