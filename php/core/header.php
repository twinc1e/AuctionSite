<?php
	session_start();
	$queryExc = "SELECT * FROM item";
	$resultExc = $mysqli->query($queryExc) or die('Ошибка '.$mysqli->error);

	if(mysqli_num_rows($resultExc) != 0){
		while($rowExc = mysqli_fetch_array($resultExc))
		{
			if(date("Y-m-d H:i") >date($rowExc['endtime'])){
				$itemExc_id = $rowExc['item_id'];
				$queryExcHB = "SELECT user_id FROM bidHistory WHERE item_id = $itemExc_id ORDER BY price DESC LIMIT 0, 1";
				$resultExcHB = $mysqli->query($queryExcHB) or die('Ошибка '.$mysqli->error);

				if(mysqli_num_rows($resultExcHB) != 0){
					$rowExcHB = mysqli_fetch_array($resultExcHB);
					$priceExcHB = $rowExcHB['user_id'];
				}else{
					$priceExcHB = 0;
				}
				$queryUpExc = "UPDATE item SET status=0, winner='$priceExcHB' WHERE item_id=$itemExc_id";
				$resultUpExc = $mysqli->query($queryUpExc) or die('Ошибка '.$mysqli->error);
			}
		}
	}
?>

<!DOCTYPE>
<html>
	<head>
		<meta charset="utf-8">
		<title>Аукцион "Torgi"</title>
		<link rel="stylesheet" type="text/css" href="http://AuctionSite/asset/font/bebasneue.css">
		<link rel="stylesheet" type="text/css" href="http://AuctionSite/asset/style.css" />
		<script type="text/javascript" src="http://AuctionSite/js/jquery-1.6.3.min.js" charset="utf-8"></script>
		<script type="text/javascript" src="asset/js/funct.js"></script>
	</head>
	<body>
		<div class="loginWrapper">
			<div class="login">
				<?php
					if(isset($_SESSION["user_id"])){
						echo "<a href='http://AuctionSite/php/user/reg.php?view=true'>Личный кабинет ".$_SESSION["username"] . "</a><br>
						<button class = 'btn'><a href='http://AuctionSite/php/user/logout.php'>logout</a></button>";
					}else{
						?>
						<form action="http://AuctionSite/php/user/login.php" method="post">
							<p>
								<label for="username">Логин</label>
								<input type="text" name="username" id="username" />
							</p>
							<p>
								<label for="password">Пароль</label>
								<input type="password" name="password" id="password">
							</p>
							<p>
								<input type="submit" id="submit" value="Войти">
							</p>
						</form>
						<button class = 'btn'><a href='http://AuctionSite/php/user/reg.php'>Регистрация</a></button>
						<?php
					}
				?>
			</div>
		</div>
		<div class="logoWrapper">
			<div class="logo">
				<h1><a href="http://AuctionSite/index.php">Torgi</a></h1>
				<div class="nav">
					<ul>
						<li><a href="http://AuctionSite/index.php">Главная</a></li>
						<li>
							<a href="http://AuctionSite/php/item/category.php?category=all">Анонс</a>
							<ul class="submenu">
								<?php
								// require_once('function/db.php');
								$query = "SELECT * FROM category";
								$result = $mysqli->query($query) or die('Ошибка '.$mysqli->error);

								while($row = mysqli_fetch_array($result))
								{
									echo "<li><a href='http://AuctionSite/php/item/category.php?category=".$row['category_id']."'>" . $row['category_name'] . "</a></li>";
								}
								?>
							</ul>
						</li>
						<?php if(isset($_SESSION["user_id"])){?>
						<li>
							<a href="http://AuctionSite/php/item/category.php?archive=all">История лотов</a>
							<ul class="submenu">
								<?php
								// require_once('function/db.php');
								$query = "SELECT * FROM category";
								$result = $mysqli->query($query) or die('Ошибка '.$mysqli->error);

								while($row = mysqli_fetch_array($result))
								{
									echo "<li><a href='http://AuctionSite/php/item/category.php?archive=".$row['category_id']."'>" . $row['category_name'] . "</a></li>";
								}
								?>
							</ul>
						<?}	?>
						</li>
					</ul>
				</div>
			</div>
		</div>
		<div class="contentWrapper">
			<div class="content">
				<?php 	if ($link==null)	$link = '../module/message.php';
				require_once ($link); ?>
