<?php
	session_start();
	$_SESSION = array();
	session_destroy();
	
	$prev = $_SERVER['HTTP_REFERER'];
	header("Location: $prev");
	exit();
?>