<?php
	if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'){
		$user_id = $_POST['user_id'];
		$item_id = $_POST['item_id'];
		$resultMsg;
		
		include 'function/db.php';
		
		if($user_id != 0){
			$query = "UPDATE item SET status=0, winner=$user_id WHERE item_id=$item_id";
			$result = $mysqli->query($query) or die(mysqli_error());
			
			if($result){
				$resultMsg = "winner";
			}
		}else{
			$query = "UPDATE item SET status=0, winner=0 WHERE item_id=$item_id";
			$result = $mysqli->query($query) or die(mysqli_error());
			
			if($result){
				$resultMsg =  "nowinner";
			}
		}	
		
		echo $resultMsg;
	}	
?>