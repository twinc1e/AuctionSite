<?
if ($permission > $userinfo['Permission']) {
header( 'Refresh:2; url=/error.html');
  exit("Нет прав!");
}
?>
