<?php
	session_start();
	if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'){
		if(isset($_POST['clear'])){
			$_SESSION['errorMsg'] = NULL;
			$_SESSION['notice'] = NULL;
		}
		echo true;
	}
?>