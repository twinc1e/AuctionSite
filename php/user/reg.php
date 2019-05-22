<?php
	session_start();
	require_once('../core/db.php');
	require_once('../module/validate.php');

	$query = "SELECT item.item_id as Num, item.itemname as Name, MAX(bidHistory.price) as Price
						FROM item, bidHistory
						WHERE item.item_id=bidHistory.item_id AND item.winner=bidHistory.user_id
						AND bidHistory.user_id=7 GROUP BY item.item_id";

	$result = $mysqli->query($query)or die('Ошибка '.$mysqli->error);
	$data=array();
		//if(count($result) != 0)
		//var_dump(count($result));
			for($i=0;$row=mysqli_fetch_array($result);$i++){
		 		$data[]=$row;//adding element in array: https://www.php.net/manual/ru/function.array-push.php
				//var_dump("circle",array_values($data[i]));
			}
			//var_dump("count=",count($data));

	if(isset($_GET['view'])=='true' && !empty($_SESSION['user_id'])){
		$user_id = $_SESSION['user_id'];
		$queryView = "SELECT * FROM user WHERE user_id = $user_id";
		$resultView = $mysqli->query($queryView) or die('Ошибка '.$mysqli->error);
		$rowView = mysqli_fetch_array($resultView);
	}

	if(isset($_GET['view'])=='true' && empty($_SESSION['user_id'])){
		header('Location: http://AuctionSite/index.php');
	}

	if(isset($_POST["submit"])){
		$_SESSION["errorMsg"] = NULL;
		$error = array();
		$username = $_POST['username'];
		$name = $_POST['name'];
		$email = $_POST['email'];
		$password = $_POST['password'];

		/* validate user input */
		validateTextBox($username, array(3,20), $error, "Пользователь" ,false);
		validateUniqueUsername($username, $error, "ID");
		validateTextBox($name, array(3,20), $error, "Имя", false);
		validateEmail($email, $error, "Эл.почта", false);
		validateTextBox($password, array(3,20), $error, "Пароль", false);
		/* end of validate */

			if(empty($error)){//perm = 0 по ТЗ регаться только клиентам
				$query = "INSERT INTO user(username, name, email, password, permission) values('$username', '$name', '$email', '$password',0)";
				$result = $mysqli->query($query) or die('Ошибка '.$mysqli->error);

				if($result){
					$_SESSION["notice"] = "Вы успешно зарегистрировались, теперь можете войти";
					header('Location: http://AuctionSite/index.php');
				}
			}else{
				for($i = 0; $i < count($error); $i++){
					$_SESSION["errorMsg"] .= $error[$i]."<br/>";
				}
				$_SESSION["errorMsg"].= "Заново зарегистрируйтесь, пожалуйста";
				header('Location: reg.php');
			}
	}
?>
<?php
	require_once('../core/header.php');
	if(isset($_GET['view'])=='true' && !empty($_SESSION['user_id'])){
		echo "<h1>Информация о пользователе</h1>";
		echo "<p>Пользователь: " . $rowView['username'] . "</p>";
		echo "<p>Имя: " . $rowView['name'] . "</p>";
		echo "<p>Эл.почта: " . $rowView['email'] . "</p>";

		//-------Чек таблица в pdf-----------------
		require('../module/func.php');
		echo "<button class = 'btn'><a href='' onclick='send()'>Получить чек </a></button>";
		//var_dump("all_",$data);
		printToPDF($data);
	}else{

		?>
		<h1>Регистрация</h1>
		<form action="" class="form" method="post">
			<p>
				<label for="username">Пользователь</label>
				<input type="text" name="username" id="username" />
			</p>
			<p>
				<label for="name">Имя</label>
				<input type="text" name="name" id="name"/>
			</p>
			<p>
				<label for="email">Эл.почта</label>
				<input type="text" name="email" id="email"/>
			</p>
			<p>
				<label for="password">Пароль</label>
				<input type="password" name="password" id="password"/>
			</p>
			<p>
				<input type="submit" id="submit" name="submit">
			</p>
		</form>
		<?php
	}

	require_once('../core/footer.php');
?>
