<?php
	session_start();
	include 'function/validate.php';
	include 'function/db.php';
	
	if(isset($_GET['view'])=='true' && !empty($_SESSION['user_id'])){
		$user_id = $_SESSION['user_id'];
		$queryView = "SELECT * FROM user WHERE user_id = $user_id";
		$resultView = $mysqli->query($queryView) or die(mysqli_error());
		
		$rowView = mysqli_fetch_array($resultView);
	}
	
	if(isset($_GET['view'])=='true' && empty($_SESSION['user_id'])){
		header('Location: index.php');
	}
	
	if(isset($_POST["submit"])){
		$_SESSION["errorMsg"] = NULL;
		$error = array();
		$username = $_POST['username'];
		$name = $_POST['name'];
		$email = $_POST['email'];
		$password = $_POST['password'];

		/* validate user input */
		validateTextBox($username, array(3,20), $error, "Username" ,false);
		validateUniqueUsername($username, $error, "Username");
		validateTextBox($name, array(3,20), $error, "Name", false);
		validateEmail($email, $error, "Email", false);
		validateTextBox($password, array(3,20), $error, "Password", false);
		/* end of validate */

			if(empty($error)){
				$query = "INSERT INTO user(username, name, email, password) values('$username', '$name', '$email', '$password')";
				$result = $mysqli->query($query) or die(mysqli_error());

				if($result){
					$_SESSION["notice"] = "You have successfully register, you can login now";
					header('Location: index.php');
				}
			}else{
				for($i = 0; $i < count($error); $i++){
					$_SESSION["errorMsg"] .= $error[$i]."<br/>";
				}
				$_SESSION["errorMsg"].= "Please try to register again.";
				header('Location: user.php');
			}
	}
?>
<?php 
	include 'template/header.php';
	if(isset($_GET['view'])=='true' && !empty($_SESSION['user_id'])){
		echo "<h1>User info</h1>";
		echo "<p>Username: " . $rowView['username'] . "</p>";
		echo "<p>Name: " . $rowView['name'] . "</p>";
		echo "<p>Email: " . $rowView['email'] . "</p>";
	}else{
		?>
		<h1>Register</h1>
		<form action="" class="form" method="post">
			<p>
				<label for="username">Username</label>
				<input type="text" name="username" id="username" />
			</p>
			<p>
				<label for="name">Name</label>
				<input type="text" name="name" id="name"/>
			</p>
			<p>
				<label for="email">Email</label>
				<input type="text" name="email" id="email"/>
			</p>
			<p>
				<label for="password">Password</label>
				<input type="password" name="password" id="password"/>
			</p>
			<p>
				<input type="submit" id="submit" name="submit" value="submit">
			</p>	
		</form>
		<?php
	}	

	include 'template/footer.php';
?>	
