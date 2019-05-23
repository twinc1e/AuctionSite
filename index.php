<?php
	require_once('php/core/db.php');
	require_once('php/module/func.php');
	$link = 'php/module/message.php';
	$linku = 'php/user/reg.php';
	require_once('php/core/header.php');

		$query = "SELECT * FROM item, category WHERE item.category_id = category.category_id AND item.endtime >CURRENT_TIMESTAMP";
		$result = $mysqli->query($query) or die('Ошибка '.$mysqli->error);

		if(!mysqli_num_rows($result) == 0){
			$row = mysqli_fetch_array($result);
			$endtime = $row['endtime'];
			$initialprice = $row['initialprice'];
}
			//Вычисляет оставшееся время
			$today = date("Y-m-d H:i");
			//var_dump("now-",$today."<br>");
			//секунды учитываем. time() - время в сек.
			$second = abs(time()-strtotime($endtime));//strtotime($endtime)=strtotime($endtime, $today)
			//print_r("now-".time()."--end-".strtotime($endtime)."<br>now1-".strtotime($today));
			//print_r("<br>sec-".$second);
			$leftime = sec2hms($second);

			//-------------------------------------

				//что-то
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

	<script type="text/javascript" src="../../js/countDown.js"></script>
<h1>Действующий аукцион</h1>
<?php
	if(isset($_SESSION["user_id"]) && $_SESSION["permission"] ==2 && mysqli_num_rows($result)<=1)
	{
		echo "<div class = 'btn add'><a href='php/item/add.php'> Добавить лот </a></div>";
	}
	if(mysqli_num_rows($result) != 0){
		// /* while(*/$row = mysqli_fetch_array($result);//){
			echo "<div class='item'>";
			echo "<div class='itemImage'><a href='php/item/item.php?ID=" . $row['item_id'] . "'><img src='" . $row['photo'] . "' alt='" . $row['itemname'] . "'/></a></div>";
			echo "<p><span class='itemname'>Name:</span><a href='php/item/item.php?ID=" . $row['item_id'] . "'>" . $row['itemname'] . "</a></p>";
			echo "<p><span>End time:</span> " . $row['endtime'] . "</p>";
			echo "<p><span class='itemcategory'>Category:</span><a href='php/item/category.php?category=" . $row['category_id'] . "'>" . $row['category_name'] . "</a></p>";
			echo "</div>";
		}else{
			echo "<p>Пусто</p>";
		}
		?>
	<div class="itemdesc">
		<p id="hms">
			<span>Осталось времени (Hours:Minutes:Second):</span><br>
			<span id="hour"></span>:<span id="min"></span>:<span id="second"></span>
			<input type="hidden" id="timeleftHidden" value="<?php echo $leftime; ?>">
		</p>
	</div>
	<?php
		if(isset($_SESSION["user_id"]) && $_SESSION["user_id"] == $usernameId){
			?><div class="item">
				<form id="biddingForm" action="#" method="post">
					<p class='warning'>Нельзя за свой лот делать ставку</p>
					<input type="hidden" name="itemId" value="<?php echo $item_id ?>" />
				</form>
			</div>
			<?php
		}elseif(isset($_SESSION["user_id"])){
			?><div class="item">
				<form id="biddingForm" action="" method="post">
					<input type="hidden" name="itemId" value="<?php echo $item_id ?>" />
					<label for="bidPrice">Ставка:</label>
					<input type="text" name="bidPrice" />
					<input type="submit" name="bid" id="bid" value="Bid">
				</form>
			</div>
			<?php
		}else{
			$queryWinner = "SELECT * FROM bidHistory, user WHERE bidHistory.item_id = $item_id AND bidHistory.user_id =user.user_id ORDER BY bidHistory.bidhistory_id DESC LIMIT 0,1";
			$resultWinner = $mysqli->query($queryWinner) or die('Ошибка '.$mysqli->error());
			if(mysqli_num_rows($resultWinner) != 0){
				$rowWinner = mysqli_fetch_array($resultWinner);
				echo "<p><span>Победитель:</span> " . $rowWinner['username'] . "</p>";
			}else{
				echo "<p><span>Победитель:</span>-</p>";
			}
		}
	//}
	require_once('php/core/footer.php');
?>
