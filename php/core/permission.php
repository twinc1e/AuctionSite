<?
//echo $permission ." ". $userinfo['Permission'];
//var_dump($userinfo);
if ($permission > $userinfo['Permission']) {
//header( 'Refresh:2; url=http://pomodor/error.html');
  exit("Нет прав!");//Вывести сообщение и прекратить выполнение текущего скрипта
}
?>
