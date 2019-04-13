<?php
	session_start();
	include 'function/db.php';

	$queryExc = "SELECT * FROM item";
	$resultExc = $mysqli->query($queryExc) or die(mysqli_error());

	if(mysqli_num_rows($resultExc) != 0){
		while($rowExc = mysqli_fetch_array($resultExc))
		{
			if(date("Y-m-d H:i") >date($rowExc['endtime'])){
				$itemExc_id = $rowExc['item_id'];
				$queryExcHB = "SELECT user_id FROM bidHistory WHERE item_id = $itemExc_id ORDER BY price DESC LIMIT 0, 1";
				$resultExcHB = $mysqli->query($queryExcHB) or die(mysqli_error());

				if(mysqli_num_rows($resultExcHB) != 0){
					$rowExcHB = mysqli_fetch_array($resultExcHB);
					$priceExcHB = $rowExcHB['user_id'];
				}else{
					$priceExcHB = 0;
				}
				$queryUpExc = "UPDATE item SET status=0, winner='$priceExcHB' WHERE item_id=$itemExc_id";
				$resultUpExc = $mysqli->query($queryUpExc) or die(mysqli_error());
			}
		}
	}
?>

<!DOCTYPE>
<html>
	<head>
		<meta charset="utf-8">
		<title>Auction by DEVLIM</title>
		<link rel="stylesheet" type="text/css" href="./asset/font/bebasneue.css">
		<link rel="stylesheet" type="text/css" href="./asset/font/mavenpro.css">
		<link rel="stylesheet" type="text/css" href="./asset/style.css" />
		<script src="./asset/jquery-1.6.3.min.js" type="text/javascript" charset="utf-8"></script>
	</head>
	<body>
		<div class="loginWrapper">
			<div class="login">
				<?php
					if(isset($_SESSION["user_id"])){
						echo "<p>Member: <a href='./user.php?view=true'>" . $_SESSION["username"] . "</a></p>";
						echo "<p><a href='logout.php'>logout</a><p>";
					}else{
						?>
						<form action="./login.php" method="post">
							<p>
								<label for="username">Username</label>
								<input type="text" name="username" id="username" />
							</p>
							<p>
								<label for="password">Password</label>
								<input type="password" name="password" id="password">
							</p>
							<p>
								<input type="submit" id="submit">
							</p>
						</form>

						<a href="user.php">Register as member</a>
						<?php
					}
				?>
			</div>
		</div>
		<div class="logoWrapper">
			<div class="logo">
				<h1><a href="index.php">AUCTION</a></h1>
				<div class="nav">
					<ul>
						<li><a href="index.php">Home</a></li>
						<li>
							<a href="category.php?category=all">Auction Item</a>
							<ul class="submenu">
								<?php
								include 'function/db.php';
								$query = "SELECT * FROM category";
								$result = $mysqli->query($query) or die(mysqli_error());

								while($row = mysqli_fetch_array($result))
								{
									echo "<li><a href='category.php?category=".$row['category_id']."'>" . $row['category_name'] . "</a></li>";
								}
								?>
							</ul>
						</li>
						<li>
							<a href="category.php?archive=all">Завершенные лоты</a>
							<ul class="submenu">
								<?php
								include 'function/db.php';
								$query = "SELECT * FROM category";
								$result = $mysqli->query($query) or die(mysqli_error());

								while($row = mysqli_fetch_array($result))
								{
									echo "<li><a href='category.php?archive=".$row['category_id']."'>" . $row['category_name'] . "</a></li>";
								}
								?>
							</ul>
						</li>
						<?php
							if(isset($_SESSION["user_id"])){
								echo "<li><a href='auction.php'>Добавить товар</a></li>";
							}
						?>
					</ul>
				</div>
			</div>
		</div>
		<div class="contentWrapper">
			<div class="content">
				<?php include "message.php"; ?>
