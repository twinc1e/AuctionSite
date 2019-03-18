<?php
	include 'template/header.php'; 
	include 'function/db.php';
	
	if(isset($_GET['category'])){
		$category_id = $_GET['category'];
		if($category_id == 'all'){
			$query = "SELECT * FROM item, category WHERE category.category_id = item.category_id AND status = 1 ORDER BY item.item_id DESC";
		}else{
			$query = "SELECT * FROM item, category WHERE category.category_id = '$category_id' AND item.category_id = '$category_id' AND status = 1 ORDER BY item.item_id DESC";
		}
		$result = $mysqli->query($query) or die(mysqli_error());
	}
	
	if(isset($_GET['archive'])){
		$archive_id = $_GET['archive'];
		if($archive_id == 'all'){
			$query = "SELECT * FROM item, category WHERE category.category_id = item.category_id AND status = 0 ORDER BY item.item_id DESC";
		}else{
			$query = "SELECT * FROM item, category WHERE category.category_id = '$archive_id' AND item.category_id = '$archive_id' AND status = 0 ORDER BY item.item_id DESC";
		}
		$result = $mysqli->query($query) or die(mysqli_error());
	}
	
	if(!isset($_GET['archive']) && !isset($_GET['category'])){
		header('Location: index.php');
		exit();
	}
?>

<h1> 
<?php
	if(!empty($category_id)){
		$queryCat = "SELECT * FROM category WHERE category_id = '$category_id' LIMIT 1";
		$resultCat = $mysqli->query($queryCat) or die(mysqli_error());
		if(mysqli_num_rows($resultCat)!=0){
			$rowCat = mysqli_fetch_array($resultCat);
			echo "Category: ".$rowCat['category_name'];
		}else{
			echo "Category: ALL";
		}	
	}
	if(!empty($archive_id)){
		$queryCat = "SELECT * FROM category WHERE category_id = '$archive_id' LIMIT 1";
		$resultCat = $mysqli->query($queryCat) or die(mysqli_error());
		if(mysqli_num_rows($resultCat)!=0){
			$rowCat = mysqli_fetch_array($resultCat);
			echo "Archive: ".$rowCat['category_name'];
		}else{
			echo "Archive: ALL";
		}
	}
?>
</h1>
<?php
	if(mysqli_num_rows($result) == 0){
		echo "<p>No auction item available in this category</p>";
	}else{
		while($row = mysqli_fetch_array($result))
		{
			echo "<div class='item'>";
			echo "<div class='itemImage'><a href='item.php?itemid=" . $row['item_id'] . "'><img src='" . $row['photo'] . "' alt='" . $row['itemname'] . "'/></a></div>";
			echo "<p><span class='itemname'>Name:</span><a href='item.php?itemid=" . $row['item_id'] . "'>" . $row['itemname'] . "</a></p>";
			echo "<p><span>End time:</span> " . $row['endtime'] . "</p>";
			if(!empty($category_id)){
				echo "<p><span class='itemcategory'>Category:</span><a href='category.php?category=" . $row['category_id'] . "'>" . $row['category_name'] . "</a></p>";	
			}
			if(!empty($archive_id)){
				echo "<p><span class='itemcategory'>Category:</span><a href='category.php?archive=" . $row['category_id'] . "'>" . $row['category_name'] . "</a></p>";	
			}
			echo "</div>";
		}
	}
?>	
<script type="text/javascript" src="asset/equalHeightCol.js"></script>
<?php include 'template/footer.php'; ?>