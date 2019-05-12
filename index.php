<?php
	require_once('php/core/db.php');
	$link = 'php/module/message.php';
	$linku = 'php/user/reg.php';
	require_once('php/core/header.php');
?>

<h1>Действующий аукцион</h1>
<?php
	$query = "SELECT * FROM item, category WHERE item.category_id = category.category_id AND item.endtime >CURRENT_TIMESTAMP";
	$result = $mysqli->query($query) or die('Ошибка '.$mysqli->error);
	if(isset($_SESSION["user_id"]) && $_SESSION["permission"] ==2 && mysqli_num_rows($result)<=1)
	{
		echo "<div class = 'btn add'><a href='php/item/add.php'> Добавить лот </a></div>";
	}
	if(mysqli_num_rows($result) != 0){
		/* while(*/$row = mysqli_fetch_array($result);//){
			echo "<div class='item'>";
			echo "<div class='itemImage'><a href='php/item/item.php?ID=" . $row['item_id'] . "'><img src='" . $row['photo'] . "' alt='" . $row['itemname'] . "'/></a></div>";
			echo "<p><span class='itemname'>Name:</span><a href='php/item/item.php?ID=" . $row['item_id'] . "'>" . $row['itemname'] . "</a></p>";
			echo "<p><span>End time:</span> " . $row['endtime'] . "</p>";
			echo "<p><span class='itemcategory'>Category:</span><a href='php/item/category.php?category=" . $row['category_id'] . "'>" . $row['category_name'] . "</a></p>";
			echo "</div>";
		}else{
			echo "<p>Пусто</p>";
		}
	//}

	require_once('php/core/footer.php');
	mysqli_close($db);
?>
?>
