<?php
	require_once('php/core/db.php');
	$link = 'php/module/message.php';
	$linku = 'php/user/user.php?view=true';
	require_once('php/core/header.php');
?>

<h1>Действующий аукцион</h1>
<button class = "btn"><span onclick="php/item/auction.php"> Добавить товар </span></button>
<?php
	$query = "SELECT * FROM item, category WHERE item.category_id = category.category_id AND status=1 ORDER BY item_id DESC LIMIT 0,10";
	$result = $mysqli->query($query) or die(mysqli_error());

	if(mysqli_num_rows($result) != 0){
		while($row = mysqli_fetch_array($result))
		{
			echo "<div class='item'>";
			echo "<div class='itemImage'><a href='php/item/item.php?itemid=" . $row['item_id'] . "'><img src='" . $row['photo'] . "' alt='" . $row['itemname'] . "'/></a></div>";
			echo "<p><span class='itemname'>Name:</span><a href='php/item/item.php?itemid=" . $row['item_id'] . "'>" . $row['itemname'] . "</a></p>";
			echo "<p><span>End time:</span> " . $row['endtime'] . "</p>";
			echo "<p><span class='itemcategory'>Category:</span><a href='php/category.php?category=" . $row['category_id'] . "'>" . $row['category_name'] . "</a></p>";
			echo "</div>";
		}
	}
?>

<script type="text/javascript" src="asset/equalHeightCol.js"></script>
<?php
	require_once('php/core/footer.php');
?>
