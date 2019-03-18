<?php
	session_start();
	include 'function/db.php';
	include 'function/func.php';
	include 'function/validate.php';
	
	if(!isset($_GET['itemid'])){
		header('Location: index.php');
		exit();
	}
	
	$itemId = $_GET['itemid'];
	$query = "SELECT * FROM item,user,category WHERE item_id = $itemId AND item.user_id = user.user_id AND item.category_id = category.category_id";
	$result = $mysqli->query($query) or die(mysqli_error());
	
	if(mysqli_num_rows($result) == 0){
		header('Location: index.php');
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
		$itemStatus = $row['status'];
		
		//Calculate left time
		$today = date("Y-m-d H:i");
		$second = abs(time()-strtotime($endtime, $today));
		$leftime = sec2hms($second);
		
		//Get the lastest bid
		$queryHigherBid = "SELECT max(price) FROM bidHistory WHERE item_id = '$item_id' ORDER BY bidhistory_id DESC LIMIT 0, 1";
		$resultHigherBid = $mysqli->query($queryHigherBid) or die(mysqli_error());
		$rowHigherBid = mysqli_fetch_array($resultHigherBid);
		$priceHigherBid = $rowHigherBid['max(price)'];
	}
	
	//Do till here at the moment
	if(isset($_POST['bid'])){
		$_SESSION['notice'] = NULL;
		$_SESSION['errorMsg'] = NULL;
		$price = $_POST["bidPrice"];
		$error = array();
		
		validateCurrency($price, $error, true, 1, 10000, "Price");
		validateBidPrice($price, $initialprice, $error, $item_id, "Biding value");
		
		if(empty($error)){
			$currentUser = $_SESSION['user_id'];
			$queryBid = "INSERT INTO bidHistory(item_id, user_id, price) values('$item_id', '$currentUser', '$price')";
			$resultBid = $mysqli->query($queryBid) or die(mysqli_error());
			if($resultBid){
				$prev = $_SERVER['HTTP_REFERER'];
				$_SESSION["notice"] = "You have successfully bid";
				header("Location: item.php?itemid=$item_id");
			}
		}else{
			$_SESSION["errorMsg"] .= $error[0]."<br/>";
			$_SESSION["errorMsg"] .= "Please try to bid again.";
			header("Location: item.php?itemid=$item_id");
		}
	}
?>

<?php include 'template/header.php'; ?>
<h1>Item: <?php echo $itemname; ?></h1>
<div class="itemimg">
	<img src="<?php echo $photo; ?>" alt="product image" />
</div>
<div class="itemdesc">
	<input type="hidden" name="itemIdAjax" class="itemIdAjax" value="<?php echo $item_id ?>" />
	<p><span>item name:</span> <?php echo $itemname; ?></p>
	<p><span>Category:</span> <?php echo $categoryName; ?></p>
	<p><span>Post by:</span> <?php echo $username; ?></p>
	<p><span>Starting price:</span> <?php echo $initialprice; ?></p>
	<p>
		<span>Currenty bid price:</span> 
		<?php
			if($emptyBidHis){
				echo "NONE";
			}else{
				echo $priceHigherBid;
			}
		?>
	</p>
	<?php
		if($itemStatus != 0){
			?>
				<p id="hms">
					<span>Time left (Hours:Minutes:Second):</span>
					<span id="hour"></span>:<span id="min"></span>:<span id="second"></span>
					<input type="hidden" id="timeleftHidden" value="<?php echo $leftime; ?>">
				</p>
			<?php
		}
	?>
	<p><span>end on:</span> <?php echo $endtime; ?></p>
	<p><span>description:</span> <?php echo $description; ?></p>

	<?php
		if($itemStatus != 0){
			if(isset($_SESSION["user_id"]) && $_SESSION["user_id"] == $usernameId){
				?>
					<form id="biddingForm" action="#" method="post">
						<p class='warning'>You are not allow to bid your own auction item</p>
						<input type="hidden" name="itemId" value="<?php echo $item_id ?>" />
					</form>	
				<?php
			}elseif(isset($_SESSION["user_id"])){
				?>
					<form id="biddingForm" action="" method="post">
						<input type="hidden" name="itemId" value="<?php echo $item_id ?>" />
						<label for="bidPrice">Biding value:</label>
						<input type="text" name="bidPrice" />
						<input type="submit" name="bid" id="bid" value="Bid">
					</form>
				<?php
			}
		}else{
			$queryWinner = "SELECT * FROM bidHistory, user WHERE bidHistory.item_id = $item_id AND bidHistory.user_id =user.user_id ORDER BY bidHistory.bidhistory_id DESC LIMIT 0,1";
			$resultWinner = $mysqli->query($queryWinner) or die(mysqli_error());
			if(mysqli_num_rows($resultWinner) != 0){
				$rowWinner = mysqli_fetch_array($resultWinner);
				echo "<p><span>winner:</span> " . $rowWinner['username'] . "</p>";
			}else{
				echo "<p><span>winner:</span>N/A</p>";
			}
		}
	?>
</div>
<div class="clear"></div>
<div class="bidhistory">
	<!--
		Load from itemLoadBidHistory.php via ajax
	-->	
</div>	
<script type="text/javascript" src="asset/countDown.js"></script>
<?php include 'template/footer.php'; ?>