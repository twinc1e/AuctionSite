<?php
	session_start();
	require_once('../core/db.php');
	require_once('../module/func.php');
	require_once('../module/validate.php');

	if(!isset($_GET['ID'])){
		header('Location: http://AuctionSite/index.php');
		exit();
	}

	$itemId = $_GET['ID'];
	$query = "SELECT * FROM item,user,category WHERE item_id = $itemId AND item.user_id = user.user_id AND item.category_id = category.category_id";
	$result = $mysqli->query($query) or die('Ошибка '.$mysqli->error);

	if(mysqli_num_rows($result) == 0){
		header('Location: http://AuctionSite/index.php');
		exit();
	}else{
		$row = mysqli_fetch_array($result);
		$item_id = $row['item_id'];
		$itemname = $row['itemname'];
		$photo = $row['photo'];
		$description = $row['description'];
		$initialprice = $row['initialprice'];
		$endtime = $row['endtime'];
		$categoryName = $row['category_name'];
		$username = $row['username'];
		$usernameId = $row['user_id'];


		// //Calculate left time
		// $today = date("Y-m-d H:i");
		// $second = abs(time()-strtotime($endtime));
		// $leftime = sec2hms($second);

		//Получить последнюю ставку
		$queryHigherBid = "SELECT max(price) FROM bidHistory WHERE item_id = '$item_id' ORDER BY bidhistory_id DESC LIMIT 0, 1";
		$resultHigherBid = $mysqli->query($queryHigherBid) or die('Ошибка '.$mysqli->error());
		$rowHigherBid = mysqli_fetch_array($resultHigherBid);
		$priceHigherBid = $rowHigherBid['max(price)'];
	}
	//
	// //что-то
	// if(isset($_POST['bid'])){
	// 	$_SESSION['notice'] = NULL;
	// 	$_SESSION['errorMsg'] = NULL;
	// 	$price = $_POST["bidPrice"];
	// 	$error = array();
	//
	// 	validateCurrency($price, $error, true, 1, 10000, "Цена");
	// 	validateBidPrice($price, $initialprice, $error, $item_id, "Ваша ставка = ");
	//
	// 	if(empty($error)){
	// 		$currentUser = $_SESSION['user_id'];
	// 		$queryBid = "INSERT INTO bidHistory(item_id, user_id, price) values('$item_id', '$currentUser', '$price')";
	// 		$resultBid = $mysqli->query($queryBid) or die('Ошибка '.$mysqli->error());
	// 		if($resultBid){
	// 			$prev = $_SERVER['HTTP_REFERER'];
	// 			$_SESSION["notice"] = "Ставка сделана";
	// 			header("Location: item.php?itemid=$item_id");
	// 		}
	// 	}else{
	// 		$_SESSION["errorMsg"] .= $error[0]."<br/>";
	// 		$_SESSION["errorMsg"] .= "Сделайте ставку снова";
	// 		header("Location: item.php?itemid=$item_id");
	// 	}
	// }
?>

<?php require_once('../core/header.php'); ?>
<h1>Item: <?php echo $itemname; ?></h1>
<div class="itemimg">
	<img src="<?php echo $photo; ?>" alt="product image" />
</div>
<div class="itemdesc">
	<input type="hidden" name="itemIdAjax" class="itemIdAjax" value="<?php echo $item_id ?>" />
	<p><span>Название товара:</span> <?php echo $itemname; ?></p>
	<p><span>Категория:</span> <?php echo $categoryName; ?></p>
	<!-- <p><span>Аукционист:</span> <?php //echo $username; ?></p> -->
	<p><span>Начальная цена:</span> <?php echo $initialprice; ?>руб.</p>
	<p>
		<span>Текущая ставка:</span>
		<?php
			if($emptyBidHis){
				echo "-";
			}else{
				echo $priceHigherBid;
			}
		?>
	руб.</p>
<!--
				<p id="hms">
					<span>Осталось времени (Hours:Minutes:Second):</span>
					<span id="hour"></span>:<span id="min"></span>:<span id="second"></span>
					<input type="hidden" id="timeleftHidden" value="<?php echo $leftime; ?>">
				</p> -->

	<p><span>Конец через:</span> <?php echo $endtime; ?></p>
	<p><span>Описание:</span> <?php echo $description; ?></p>

	</div>
<div class="clear"></div>
<div class="bidhistory">
	<!--
		Load from itemLoadBidHistory.php via ajax
	-->
</div>
<!-- <script type="text/javascript" src="../../asset/js/countDown.js"></script> -->
<?php require_once('../core/footer.php'); ?>
