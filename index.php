<?php
	require_once('php/core/db.php');
	$link = 'php/module/message.php';
	$linku = 'php/user/reg.php';
	require_once('php/core/header.php');
?>

<h1>Действующий аукцион</h1>
<button class = "btn"><a href="php/item/add.php"> Добавить лот </a></button>
<?php
	$query = "SELECT * FROM item, category WHERE item.category_id = category.category_id ORDER BY item_id DESC LIMIT 0,10";
	$result = $mysqli->query($query) or die('Ошибка '.$mysqli->error);

	if(mysqli_num_rows($result) != 0){
		while($row = mysqli_fetch_array($result))
		{
			echo "<div class='item'>";
			echo "<div class='itemImage'><a href='php/item/item.php?ID=" . $row['item_id'] . "'><img src='" . $row['photo'] . "' alt='" . $row['itemname'] . "'/></a></div>";
			echo "<p><span class='itemname'>Name:</span><a href='php/item/item.php?ID=" . $row['item_id'] . "'>" . $row['itemname'] . "</a></p>";
			echo "<p><span>End time:</span> " . $row['endtime'] . "</p>";
			echo "<p><span class='itemcategory'>Category:</span><a href='php/category.php?category=" . $row['category_id'] . "'>" . $row['category_name'] . "</a></p>";
			echo "</div>";
		}
	}

	require_once('php/core/footer.php');
?>
