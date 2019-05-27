<?php
	require_once('php/core/db.php');
	require_once('php/module/func.php');
	$link = 'php/module/message.php';
	$linku = 'php/user/reg.php';
	require_once('php/core/header.php');

		$query = "SELECT * FROM item, category WHERE item.category_id = category.category_id AND item.endtime >CURRENT_TIMESTAMP";
		$result = $mysqli->query($query) or die('Ошибка '.$mysqli->error);

		if(mysqli_num_rows($result) == 0){
			header('Location: http://AuctionSite/index.php');
			exit();
		}else{
			$row = mysqli_fetch_array($result);
			$item_id = $row['item_id'];
			$endtime = $row['endtime'];
}
			//Вычисляет оставшееся время
			$today = date("Y-m-d H:i");
			var_dump("now-",$today."<br>");
			//секунды учитываем. time() - время в сек.
			$second = abs(time()-strtotime($endtime));//strtotime($endtime)=strtotime($endtime, $today)
			print_r("now-".time()."--end-".strtotime($endtime)."<br>now1-".strtotime($today));
			print_r("<br>sec-".$second);
			$leftime = sec2hms($second);
<<<<<<< HEAD

			//-------------------------------------

				//Ваша ставка
				if(isset($_POST['bid'])){
					$_SESSION['notice'] = NULL;
					$_SESSION['errorMsg'] = NULL;
					$price = $_POST["bidPrice"];
					$error = array();

					validateCurrency($price, $error, true, 1, 10000, "Цена");
					validateBidPrice($price, $initialprice, $error, $item_id, "Ваша ставка = ");

					if(empty($error)){
						$currentUser = $_SESSION['user_id'];
						$queryBid = "INSERT INTO bidHistory(item_id, user_id, price) values('$item_id', '$currentUser', '$price')";
						$resultBid = $mysqli->query($queryBid) or die('Ошибка '.$mysqli->error());
						if($resultBid){
							$prev = $_SERVER['HTTP_REFERER'];
							$_SESSION["notice"] = "Ставка сделана";
							header("Location: item.php?itemid=$item_id");
						}
					}else{
						$_SESSION["errorMsg"] .= $error[0]."<br/>";
						$_SESSION["errorMsg"] .= "Сделайте ставку снова";
						header("Location: item.php?itemid=$item_id");
					}
				}
?>

	<script type="text/javascript" src="js/countDown.js"></script>
=======
?>

>>>>>>> parent of 81e6c9f... correct time. Cannot take stavka
<h1>Действующий аукцион</h1>
<?php
	if(isset($_SESSION["user_id"]) && $_SESSION["permission"] ==2 && mysqli_num_rows($result)<=1)
	{
		echo "<div class = 'btn add'><a href='php/item/add.php'> Добавить лот </a></div>";
	}
	if(mysqli_num_rows($result) != 0){
		/* while(*/$row = mysqli_fetch_array($result);//){
			echo "<div class='item'>";
			echo "<div class='itemImage'><a href='php/item/item.php?ID=" . $row['item_id'] . "'><img src='" . $row['photo'] . "' alt='" . $row['itemname'] . "'/></a></div>";
			echo "<p><span class='itemname'>Название:</span><a href='php/item/item.php?ID=" . $row['item_id'] . "'>" . $row['itemname'] . "</a></p>";
			echo "<p><span>Время окончания:</span> " . $row['endtime'] . "</p>";
			echo "<p><span class='itemcategory'>Категория:</span><a href='php/item/category.php?category=" . $row['category_id'] . "'>" . $row['category_name'] . "</a></p>";
			echo "</div>";
		}else{
			echo "<p>Пусто</p>";
		}
		?>
	<div class="itemdesc">
		<p id="hms">
			<span>Осталось времени (Часы:Минуты:Секунды):</span><br>
			<span id="hour"></span>:<span id="min"></span>:<span id="second"></span>
			<input type="hidden" id="timeleftHidden" value="<?php echo $leftime; ?>">
		</p>
	</div><?
	//}

	require_once('php/core/footer.php');
?>
