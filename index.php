<?php
	require_once('php/core/db.php');
	require_once('php/module/func.php');
	require_once('php/module/validate.php');
	$link = 'php/module/message.php';
	$linku = 'php/user/reg.php';
	require_once('php/core/header.php');

		$query = "SELECT * FROM item, category WHERE item.category_id = category.category_id AND item.endtime >CURRENT_TIMESTAMP";
		$result = $mysqli->query($query) or die('Ошибка '.$mysqli->error);

		if(mysqli_num_rows($result) != 0){
			$row = mysqli_fetch_array($result);
			$item_id = $row['item_id'];
			$endtime = $row['endtime'];
			$initialprice = $row['initialprice'];
}
			//Вычисляет оставшееся время
			$today = date("Y-m-d H:i");
			//секунды учитываем. time() - время в сек.
			$second = abs(time()-strtotime($endtime));
			$leftime = sec2hms($second);
			//-------------------------------------

				//Ваша ставка
				if(isset($_POST['bid'])){
					$_SESSION['notice'] = NULL;
					$_SESSION['errorMsg'] = NULL;
					$price = $_POST["bidPrice"];
					$error = array();

					validateCurrency($price, $error, true, 1, 10000, "Цена");
					// validateBidPrice($price, $initialprice, $error, $item_id);
////////////////
					// $query = "SELECT IFNULL(max(price),0) AS max_p FROM bidHistory WHERE item_id = $item_id ORDER BY bidhistory_id";
					// $result = $mysqli->query($query) or die('Ошибка '.$mysqli->error());
					// // if(mysqli_num_rows($result) == 0)
					// // 	$pricebidhis = $initialprice;
					// // else{
					// 		$row = $mysqli->fetch_assoc($result);
					// 		$pricebidhis = $row["max_p"];
					// 		echo "price".$pricebidhis;
					// 	//}
					// if($initialprice >= $pricebid){
					// 	array_push($error, "Ставка должна быть выше, чем первоначальная цена: $initialprice");
					// }elseif($pricebidhis >= $pricebid){
					// 	array_push($error, "Ставка должна быть выше, чем последняя поставленная: $pricebidhis");
					// }
//////////////////////////
					if(empty($error)){
						$currentUser = $_SESSION['user_id'];
						$queryBid = "INSERT INTO bidHistory(item_id, user_id, price) values('$item_id', '$currentUser', '$price')";
						$resultBid = $mysqli->query($queryBid) or die('Ошибка '.$mysqli->error());
						if($resultBid){
							$prev = $_SERVER['HTTP_REFERER'];
							$_SESSION["notice"] = "Ставка сделана";
							// header("Location: index.php");
						}
					}else{
						$_SESSION["errorMsg"] .= $error[0]."<br/>";
						$_SESSION["errorMsg"] .= "Сделайте ставку снова";
						// header("Location: index.php");
					}
				}
?>

<h1>Действующий аукцион</h1>
<?php
	if(isset($_SESSION['user_id'])&& $_SESSION["permission"] ==2 && mysqli_num_rows($result)<=2)
	{
		echo "<div class = 'btn add'><a href='php/item/add.php'> Добавить лот </a></div>";
	}
	if(mysqli_num_rows($result) != 0){
		// /* while(*/$row = mysqli_fetch_array($result);//){
			echo "<div class='item'>";
			echo "<div class='itemImage'><a href='php/item/item.php?ID=" . $row['item_id'] . "'><img src='" . $row['photo'] . "' alt='" . $row['itemname'] . "'/></a></div>";
			echo "<p><span class='itemname'>Название:</span><a href='php/item/item.php?ID=" . $row['item_id'] . "'>" . $row['itemname'] . "</a></p>";
			echo "<p><span>Время окончания:</span> " . $row['endtime'] . "</p>";
			echo "<p><span class='itemcategory'>Категория:</span><a href='php/item/category.php?category=" . $row['category_id'] . "'>" . $row['category_name'] . "</a></p>";
			echo "<p><span>Начальная цена:</span>". $row['initialprice'] . "</p>";
					if($emptyBidHis){
						echo "-";
					}else{
						echo $priceHigherBid;
					}
			echo "</p></div>";
		//}
		?>
	<div class="itemdesc" id="<?php echo $item_id ?>">
		<p id="hms">
			<span>Осталось времени (Час:Мин:Сек):</span><br>
			<span id="hour"></span>:<span id="min"></span>:<span id="second"></span>
			<input type="hidden" id="timeleftHidden" value="<?php echo $leftime; ?>">
		</p>
	</div>
<?
	if(isset($_SESSION['user_id']) && $_SESSION['user_id'] == $usernameId){
		?>
			<form id="biddingForm" action="#" method="post">
				<p class='warning'>Нельзя за свой лот делать ставку</p>
				<input type="hidden" name="itemId" value="<?php echo $item_id ?>" />
			</form>
		<?php
	}elseif(isset($_SESSION['user_id'])){
		?>
			<form id="" action="" class="bid" method="post">
				<input type="hidden" name="itemId" value="<?php echo $item_id ?>" />
				<label for="bidPrice">Ставка:</label>
				<input type="text" name="bidPrice" />
				<input type="submit" name="bid" id="bid" value="Хочу">
			</form>
		<?php
	}
	// else{
	// $queryWinner = "SELECT * FROM bidHistory, user WHERE bidHistory.item_id = $item_id AND bidHistory.user_id =user.user_id ORDER BY bidHistory.bidhistory_id DESC LIMIT 0,1";
	// $resultWinner = $mysqli->query($queryWinner) or die('Ошибка '.$mysqli->error());
	// if(mysqli_num_rows($resultWinner) != 0){
	// 	$rowWinner = mysqli_fetch_array($resultWinner);
	// 	echo "<p><span>Победитель:</span> " . $rowWinner['username'] . "</p>";
	// }else{
	// 	echo "<p><span>Победитель:</span>-</p>";
	// }
	// }

?>
	<div class="clear"></div>
	<div class="bidhistory">
	<!--
	Load from itemLoadBidHistory.php via ajax
	-->
	</div>
</div>
	<script type="text/javascript" src="js/countDown.js"></script>
<?}else{
		echo "<p>Пусто</p>";
	}
	require_once('php/core/footer.php');
?>
