<?
	session_start();
	if(empty($_SESSION["user_id"])||$_SESSION["user_id"])<2){
		header('Location: http://AuctionSite/index.php');
		exit();
	}
	require_once('../core/db.php');
	require_once('../module/validate.php');
	//May wrong below 1 line code
	$_SESSION["notice"] = NULL;

?>
<h3>Удалить лот</h3>
<form action="delete.php?delete=true&id=<?=$_GET['id']?>" class="form-signin" method="POST">
<label>Лот под номером <?=$_GET['id']?> будет удален </label> 	<h1></h1>
<button type="submit" name="action" class="btn btn-lg btn-primary btn-block">Удалить</button>
</form>
<?
if($_GET['delete'] == "true") {//данные из формы 'delete' получены
	$sqlquery=$mysqli->query("DELETE FROM Tasks WHERE ID='". $_GET['id']."'");
	if ($sqlquery==true){
		$_SESSION["notice"] = "Лот успешно создан.";
			header("location: $_SERVER['HTTP_REFERER']");
	}
	else {
		$_SESSION["errorMsg"] .= "Попробуйте удалить лот позже, пожалуйста";
		header('Location: delete.php');
	}
}
