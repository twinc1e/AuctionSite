<?php
	require_once('../core/db.php');
	require_once('../core/header.php');

	if(isset($_GET['category'])){
		$category_id = $_GET['category'];
		if($category_id == 'all'){
			$query = "SELECT * FROM item, category WHERE category.category_id = item.category_id ORDER BY item.item_id DESC";
		}else{
			$query = "SELECT * FROM item, category WHERE category.category_id = '$category_id' AND item.category_id = '$category_id' ORDER BY item.item_id DESC";
		}
		$result = $mysqli->query($query) or die('Ошибка '.'Ошибка '.$mysqli->error);
	}

	if(isset($_GET['archive'])){
		$archive_id = $_GET['archive'];
		if($archive_id == 'all'){
			$query = "SELECT * FROM item, category WHERE category.category_id = item.category_id ORDER BY item.item_id DESC";
		}else{
			$query = "SELECT * FROM item, category WHERE category.category_id = '$archive_id' AND item.category_id = '$archive_id'ORDER BY item.item_id DESC";
		}
		$result = $mysqli->query($query) or die('Ошибка '.$mysqli->error);
	}

	if(!isset($_GET['archive']) && !isset($_GET['category'])){
		header('Location: http://AuctionSite/index.php');
		exit();
	}
?>

<h1>
<?php
	if(!empty($category_id)){
		$queryCat = "SELECT * FROM category WHERE category_id = '$category_id' LIMIT 1";
		$resultCat = $mysqli->query($queryCat) or die('Ошибка '.$mysqli->error);
		if(mysqli_num_rows($resultCat)!=0){
			$rowCat = mysqli_fetch_array($resultCat);
			echo "Категория: ".$rowCat['category_name'];
		}else{
			echo "Категория: ВСЕ";
		}
	}
	if(!empty($archive_id)){
		$queryArch = "SELECT * FROM category WHERE category_id = '$archive_id' LIMIT 1";
		$resultArch = $mysqli->query($queryArch) or die('Ошибка '.$mysqli->error);
		if(mysqli_num_rows($resultArch)!=0){
			$rowArch = mysqli_fetch_array($resultArch);
			echo "История: ".$rowArch['category_name'];
		}else{
			echo "История лотов: ВСЕ";
		}
	}
?>
</h1>
<?php
	if(mysqli_num_rows($result) == 0){
		echo "<p>Пусто</p>";
	}else{
		while($row = mysqli_fetch_array($result))
		{
			echo "<div class='item'>";
			echo "<div class='itemImage'>
										<a href='item.php?ID=" . $row['item_id'] . "'><img src='" . $row['photo'] . "' alt='" . $row['itemname'] . "'/></a></div>";
			echo "<p><span class='itemname'>Название:</span><a href='item.php?itemid=" . $row['item_id'] . "'>" . $row['itemname'] . "</a></p>";
			echo "<p><span>Конец времени:</span> " . $row['endtime'] . "</p>";
			if(!empty($category_id)){
				echo "<p><span class='itemcategory'>Категория:</span><a href='category.php?category=" . $row['category_id'] . "'>" . $row['category_name'] . "</a></p>";
			}
			if(!empty($archive_id)){
				echo "<p><span class='itemcategory'>Категория:</span><a href='category.php?archive=" . $row['category_id'] . "'>" . $row['category_name'] . "</a></p>";
			}
			echo "</div>";
		}
	}
?>
<!-- <script type="text/javascript" src="../../asset/js/equalHeightCol.js"></script> -->
<?php require_once('../core/footer.php'); ?>
