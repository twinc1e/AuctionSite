<?php

	function validateTextBox($text, $length, &$error, $attr, $empty=false){
		if(is_string($text)){
			if($empty == false){
				if(empty($text)){
					array_push($error, "$attr не может быть пустым");
					return;
				}
			}

			if(strlen($text) < $length[0] || strlen($text) > $length[1]){
				array_push($error, "$attr длина должна быть от $length[0] до $length[1]");
				return;
			}
		}else{
			$error = array();
			array_push($error, "$attr не является текстом");
		}
	}

	function validateEmail($text, &$error, $attr, $empty=false){
		if(is_string($text)){
			if($empty == false){
				if(empty($text)){
					array_push($error, "$attr cannot be blank");
					return;
				}
			}

			if(!preg_match("/^[_\.0-9a-zA-Z-]+@([0-9a-zA-Z][0-9a-zA-Z-]+\.)+[a-zA-Z]{2,6}$/i", $text)){
				array_push($error, "$attr это не эл.почта");
				return;
			}
		}else{
			$error = array();
			array_push($error, "$attr is not a text value");
		}
	}

	function validateCurrency($textBox, &$error, $checkMinMax = false, $min=1, $max, $attr, $empty=false){
		$text = floatval($textBox);

		if(false == $empty){
			if(empty($textBox)){
				array_push($error, "$attr cannot be blank");
				return;
			}
		}

		if(!is_numeric($textBox)){
			array_push($error, "$attr это не число");
			return;
		}

		if(true == $checkMinMax){
			if(!empty($min) || !empty($max)){
				if($text <= 0 || $text > $max){
					array_push($error, "$attr must be between $min to $max");
				}
			}
		}
	}

	function validateUniqueUsername($username, &$error, $attr){
		// require_once('../core/db.php');

		$query = "SELECT * FROM user WHERE username = '$username'";
		$result = $mysqli->query($query) or die('Ошибка '.$mysqli->error());

		if($result->num_rows==0){
			array_push($error, "$attr уже существует");
		}
	}

	function validatePhoto(&$photo, &$error, $attr){
		if((($photo["type"]=="image/gif") || ($photo["type"]=="image/jpeg") || ($photo["type"]=="image/pjpeg") || ($photo["type"]== "image/png"))){
			if($photo["error"] > 0)
			{
			   array_push($error, "Код ошибки: " . $photo["error"]);
			}else{
				if (file_exists("http:/AuctionSite/asset/itemImg/" . $_FILES["photo"]["name"]))
			     {
			     	$photo["name"] = "1".$photo["name"];
			     }
			}
		}else{
			array_push($error, "фото должно быть gif, jpeg, pjpeg, или png формата");
		}
	}

	function validateBidPrice($pricebid, $initialprice, &$error, $itemid, $attr){
			// require_once('php/core/db.php');
		$query = "SELECT max(price) FROM bidHistory WHERE item_id = '$itemid' ORDER BY bidhistory_id DESC LIMIT 0, 1";
		$result = $mysqli->query($query) or die('Ошибка '.$mysqli->error());
		$row = $mysqli->fetch_array($result);
		$pricebidhis = $row['max(price)'];
		if($initialprice >= $pricebid){
			array_push($error, "Ставка должна быть выше, чем первоначальная цена: $initialprice");
		}elseif($pricebidhis >= $pricebid){
			array_push($error, "Ставка должна быть выше, чем последняя поставленная: $pricebidhis");
		}
	}
?>
