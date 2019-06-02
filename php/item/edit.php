<?
$permission = 2;
require_once 'core/main.php';
//require_once ('/bd.php');
$row = $mysqli->query("SELECT * FROM Tasks WHERE ID=". $_GET['id'])->fetch_assoc();
?>
	  <h3>Редактировать информацию о товаре</h3>
		<form action="edit.php?edit=true&id=<?=$_GET['id']?>" class="form-signin" method="POST">
		  <input type="text" class="form-control" name="Name" placeholder="Название проблемы" value="<?=$row['Name']?>"><br />
	    <input type="text" class="form-control" name="Text" placeholder="Описание проблемы" value="<?=$row['Text']?>"><br />
			<button type="submit" name="action" class="btn btn-lg btn-primary btn-block">Edit</button>
		</form>
<?
if($_GET['edit'] == "true") {//данные из формы 'change' получены
	$sqlquery=$mysqli->query("UPDATE Tasks SET
	ID = ".$_GET['id']." ,Name = '".$_POST['Name']."' ,Text = '".$_POST['Text']."'
	WHERE ID=". $_GET['id']);
	if ($sqlquery==true)//удалось изменить данные, запрос прошел
			 header("location: ./dashboard.php");//переадресовать на главную страницу
	else header( 'Refresh: 10; url=/error.html' ); // переадресовать на страницу ошибки немедленно (без задержки).
}
