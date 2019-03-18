<?php
mb_internal_encoding('UTF-8');
$db_host="localhost";
$db_name="auction";
$db_admin="root";
$db_password="";
$mysqli = new mysqli($db_host, $db_admin, $db_password, $db_name);
if (mysqli_connect_errno()) {
  echo 'Ошибка подключения: '.mysqli_connect_error();
  exit();
}?>
