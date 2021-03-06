<?php
	session_start();
	//echo "session ".$_SESSION['user_id'];
	if(empty($_SESSION['user_id'])|| $_SESSION["permission"] <2){
		header('Location: http://AuctionSite/index.php');
		exit();
	}
	require_once('../core/db.php');
	require_once('../module/validate.php');
	//May wrong below 1 line code
	$_SESSION['notice'] = NULL;
    //$link=mysqli_connect("127.0.0.1","root","","auction");
	if(isset($_POST["submit"])){
		$_SESSION["errorMsg"] = NULL;
		$error = array();
		$name = $_POST['name'];
		$photo = $_FILES["photo"];
		$price = $_POST['price'];
		$description = $_POST['description'];
		$user = intval($_SESSION['user_id']);
		$category = intval($_POST['category']);

		$endtimetemp = $_POST["end_datetime"];

        $endtime=str_replace('T',' ',$endtimetemp);

		/* validate user input. funct at /validate.php*/
		validateTextBox($name, array(3,255), $error, "Название товара" ,false);
		validatePhoto($photo, $error, "Фото");
		validateCurrency($price, $error, true, 0, 10000, "Цена");
		validateTextBox($description, array(25,1500), $error, "Описание товара" ,false);
		/* end of validate */

		if(empty($error)){
			move_uploaded_file($photo["tmp_name"], "../../asset/itemImg/" . $photo["name"]);

			$photoURL = "../../asset/itemImg/" . $photo["name"];

			$query = "INSERT INTO item(itemname, photo, description, initialprice, endtime, category_id, user_id) values('$name', '$photoURL', '$description', '$price', '$endtime', '$category', $user)";
			$result = $mysqli->query($query)or die('Ошибка '.$mysqli->error);

			if($result){
				//here didnt solve yet
				$lastQueryId = $mysqli->insert_id;
				$_SESSION['notice'] = "Лот успешно создан.";
				header("Location: item.php?itemid=$lastQueryId");
				exit();
			}
		}else{
			for($i = 0; $i < count($error); $i++){
				$_SESSION["errorMsg"] .= $error[$i]."<br/>";
			}
			$_SESSION["errorMsg"] .= "Создайте лот заново, пожалуйста";
			header('Location: add.php');
		}
	}
?>

<?php require_once('../core/header.php'); ?>
	<h1>Добавить лот</h1>
	<form action="" class="form" method="post" enctype="multipart/form-data">
		<p>

			<label for="name">Название лота</label>
			<input type="text" name="name" id="name"/>
		</p>
		<p>
			<label for="photo">Фото</label>
			<input type="file" name="photo" id="photo" />
		</p>
		<p>
			<label for="price">Цена</label>
			<input type="text" name="price" id="price"/>
		</p>
		<p>
			<label for="endtime">Конец времени</label>
            <?php
            $format ="Y-m-d\TG:i";//2018-06-07T00:00
            $now_datetime=date($format);
            ?>
            <input type="datetime-local" name="end_datetime" id="end_datetime"
            min="<?php echo $now_datetime;?>">

		</p>
		<p>
			<label for="category">Категория</label>
			<select name="category" id="category">
				<?php
					$query = "SELECT * FROM category";
                    $result = $mysqli->query($query);

					while($row = $result->fetch_array())
					{
						echo "<option value='" . $row['category_id'] . "'>" . $row['category_name'] . "</option>";
					}
				?>
			</select>
		</p>
		<p>
			<label for="description">Описание</label>
			<textarea id="description" name="description"></textarea>
		</p>
		<p>
			<input type="submit" id="submit" name="submit" value="submit">
		</p>
	</form>
<?php require_once('../core/footer.php'); ?>
