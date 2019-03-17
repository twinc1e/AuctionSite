<?php

	session_start();
	if(empty($_SESSION["user_id"])){
		header('Location: index.php');
		exit();//hghgdhg
	}
	include 'function/db.php';
	include 'function/validate.php';
	//May wrong below 1 line code
	$_SESSION["notice"] = NULL;

	if(isset($_POST["submit"])){
		$_SESSION["errorMsg"] = NULL;
		$error = array();
		$name = $_POST['name'];
		$photo = $_FILES["photo"];
		$price = $_POST['price'];
		$description = $_POST['description'];
		$user = intval($_SESSION['user_id']);
		$category = intval($_POST['category']);
		/*Date*/
		$endtimetemp = $_POST["endtime"];
		$endHourtemp = $_POST["endhour"];
		$endminTmp = $_POST["endmin"];
		$endtime = date("Y-m-d $endHourtemp:$endminTmp", strtotime("$endtimetemp days"));
		/*End Date*/

		/* validate user input*/
		validateTextBox($name, array(3,255), $error, "Item name" ,false);
		validatePhoto($photo, $error, "Photo");
		validateCurrency($price, $error, true, 0, 10000, "Price");
		validateTextBox($description, array(25,1500), $error, "Item description" ,false);
		/* end of validate */

		if(empty($error)){
			move_uploaded_file($photo["tmp_name"], "asset/itemImg/" . $photo["name"]);

			$photoURL = "asset/itemImg/" . $photo["name"];
			$query = "INSERT INTO item(itemname, photo, description, initialprice, endtime, category_id, status, user_id) values('$name', '$photoURL', '$description', '$price', '$endtime', '$category', 1, $user)";
			$result = mysql_query($query) or die(mysql_error());

			if($result){
				//here didnt slove yet
				$lastQueryId = mysql_insert_id();
				$_SESSION["notice"] = "You have successfully post an auction.";
				header("Location: item.php?itemid=$lastQueryId");
				exit();
			}
		}else{
			for($i = 0; $i < count($error); $i++){
				$_SESSION["errorMsg"] .= $error[$i]."<br/>";
			}
			$_SESSION["errorMsg"] .= "Please try to post ur auction item again.";
			header('Location: auction.php');
		}
	}
?>

<?php include 'template/header.php'; ?>
	<h1>Auction You Item</h1>
	<form action="" class="form" method="post" enctype="multipart/form-data">
		<p>

			<label for="name">Item name</label>
			<input type="text" name="name" id="name"/>
		</p>
		<p>
			<label for="photo">Photo</label>
			<input type="file" name="photo" id="photo" />
		</p>
		<p>
			<label for="price">Price</label>
			<input type="text" name="price" id="price"/>
		</p>
		<p>
			<label for="endtime">End time</label>
            <?php
            $format ="Y-m-d\TG:i";//2018-06-07T00:00
            $now_datetime=date($format);
            ?>
            <input type="datetime-local" id="end_datetime"
            min="<?php echo $now_datetime;?>">
            <!--
			<select id="endtime" name="endtime">
				<option value='0'>0 day</option>
				<option value='1'>1 day</option>
				<option value='2'>2 day</option>
				<option value='3'>3 day</option>
				<option value='4'>4 day</option>
				<option value='5'>5 day</option>
				<option value='6'>6 day</option>
				<option value='7'>7 day</option>
				<option value='8'>8 day</option>
				<option value='9'>9 day</option>
				<option value='10'>10 day</option>
				<option value='11'>11 day</option>
				<option value='12'>12 day</option>
				<option value='13'>13 day</option>
				<option value='14'>14 day</option>
				<option value='15'>15 day</option>
				<option value='16'>16 day</option>
				<option value='17'>17 day</option>
				<option value='18'>18 day</option>
				<option value='19'>19 day</option>
				<option value='20'>20 day</option>
				<option value='21'>21 day</option>
				<option value='22'>22 day</option>
				<option value='23'>23 day</option>
				<option value='24'>24 day</option>
				<option value='25'>25 day</option>
				<option value='26'>26 day</option>
				<option value='27'>27 day</option>
				<option value='28'>28 day</option>
				<option value='29'>29 day</option>
				<option value='30'>30 day</option>
				<option value='31'>30 day</option>
			</select>
			at
			<select id="endhour" name="endhour">
				<option value='00'>00 hours</option>
				<option value='01'>01 hours</option>
				<option value='02'>02 hours</option>
				<option value='03'>03 hours</option>
				<option value='04'>04 hours</option>
				<option value='05'>05 hours</option>
				<option value='06'>06 hours</option>
				<option value='07'>07 hours</option>
				<option value='08'>08 hours</option>
				<option value='09'>09 hours</option>
				<option value='10'>10 hours</option>
				<option value='11'>11 hours</option>
				<option value='12'>12 hours</option>
				<option value='13'>13 hours</option>
				<option value='14'>14 hours</option>
				<option value='15'>15 hours</option>
				<option value='16'>16 hours</option>
				<option value='17'>17 hours</option>
				<option value='18'>18 hours</option>
				<option value='19'>19 hours</option>
				<option value='20'>20 hours</option>
				<option value='21'>21 hours</option>
				<option value='22'>22 hours</option>
				<option value='23'>23 hours</option>
			</select>
			at
			<select id="endmin" name="endmin">
				<option value='00'>0 minute</option>
				<option value='01'>1 minute</option>
				<option value='02'>2 minute</option>
				<option value='03'>3 minute</option>
				<option value='04'>4 minute</option>
				<option value='05'>5 minute</option>
				<option value='06'>6 minute</option>
				<option value='07'>7 minute</option>
				<option value='08'>8 minute</option>
				<option value='09'>9 minute</option>
				<option value='10'>10 minute</option>
				<option value='11'>11 minute</option>
				<option value='12'>12 minute</option>
				<option value='13'>13 minute</option>
				<option value='14'>14 minute</option>
				<option value='15'>15 minute</option>
				<option value='16'>16 minute</option>
				<option value='17'>17 minute</option>
				<option value='18'>18 minute</option>
				<option value='19'>19 minute</option>
				<option value='20'>20 minute</option>
				<option value='21'>21 minute</option>
				<option value='22'>22 minute</option>
				<option value='23'>23 minute</option>
				<option value='24'>24 minute</option>
				<option value='25'>25 minute</option>
				<option value='26'>26 minute</option>
				<option value='27'>27 minute</option>
				<option value='28'>28 minute</option>
				<option value='29'>29 minute</option>
				<option value='30'>30 minute</option>
				<option value='31'>31 minute</option>
				<option value='32'>32 minute</option>
				<option value='33'>33 minute</option>
				<option value='34'>34 minute</option>
				<option value='35'>35 minute</option>
				<option value='36'>36 minute</option>
				<option value='37'>37 minute</option>
				<option value='38'>38 minute</option>
				<option value='39'>39 minute</option>
				<option value='40'>40 minute</option>
				<option value='41'>41 minute</option>
				<option value='42'>42 minute</option>
				<option value='43'>43 minute</option>
				<option value='44'>44 minute</option>
				<option value='45'>45 minute</option>
				<option value='46'>46 minute</option>
				<option value='47'>47 minute</option>
				<option value='48'>48 minute</option>
				<option value='49'>49 minute</option>
				<option value='50'>50 minute</option>
				<option value='51'>51 minute</option>
				<option value='52'>52 minute</option>
				<option value='53'>53 minute</option>
				<option value='54'>54 minute</option>
				<option value='55'>55 minute</option>
				<option value='56'>56 minute</option>
				<option value='57'>57 minute</option>
				<option value='58'>58 minute</option>
				<option value='59'>59 minute</option>
			</select>
			-->
		</p>
		<p>
			<label for="category">Category</label>
			<select name="category" id="category">
				<?php
					$query = "SELECT * FROM category";
					$result = mysql_query($query) or die(mysql_error());
					while($row = mysql_fetch_array($result))
					{
						echo "<option value='" . $row['category_id'] . "'>" . $row['category_name'] . "</option>";
					}
				?>
			</select>
		</p>
		<p>
			<label for="description">Description</label>
			<textarea id="description" name="description"></textarea>
		</p>
		<p>
			<input type="submit" id="submit" name="submit" value="submit">
		</p>
	</form>
<?php include 'template/footer.php'; ?>
