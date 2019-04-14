<?php
// echo "OK";
	if(isset($_SESSION['errorMsg'])){
		echo "<div class='error'>";
		echo $_SESSION['errorMsg']."<a href='#' id='closeMsg'>X</a>";
		echo "</div>";
	}

	if(isset($_SESSION['notice'])){
		echo "<div class='notice'>";
		echo $_SESSION['notice']."<a href='#' id='closeMsg'>X</a>";
		echo "</div>";
	}
?>
