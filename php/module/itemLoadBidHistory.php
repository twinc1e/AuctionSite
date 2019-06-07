<?php
	if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'){
		require_once('../core/db.php');
		$item_id = $_GET['item_id'];
			$queryBidHis = "SELECT * FROM bidHistory WHERE bidHistory.item_id = $item_id ORDER BY bidHistory.bidhistory_id DESC";
		// $queryBidHis = "SELECT * FROM bidHistory LEFT JOIN user ON bidHistory.user_id=user.user_id
		// WHERE bidHistory.item_id = $item_id
		// GROUP BY item_id ORDER BY bidHistory.bidhistory_id DESC";
		// $queryBidHis = "SELECT * FROM bidHistory LEFT JOIN user Using(user_id) WHERE bidHistory.item_id = $item_id ORDER BY bidHistory.bidhistory_id DESC";
		$resultBidHis = $mysqli->query($queryBidHis) or die('Ошибка '.$mysqli->error);
		$emptyBidHis = (mysqli_num_rows($resultBidHis) == 0? true:false);
		}
?>

<table>
	<caption><h1>История аукционов</h1></caption>
	<tbody>
	<?php
		if($emptyBidHis){
			echo "<tr>
			<td style='border:none'><h3>Пусто</h3></td>
			<input type='hidden' name='user_id' id='user_id' value='0'>
			</tr>";
		}else{
			echo "<tr><th>Пользователь</th><th>Ставка</th></tr>";
			while($rowBidHis = mysqli_fetch_array($resultBidHis))
			{
				$bidUser = $rowBidHis['user_id'];
				$queryuser = $mysqli->query("SELECT * FROM user WHERE user_id=$bidUser")->fetch_array() or die('Ошибка '.$mysqli->error);
					//echo "user ".$row['user_id']." bid".$rowBidHis['user_id']."<br>";
					// if ($row['user_id']==$rowBidHis['user_id'])
						$name = $queryuser['username'];
						//echo "name ".$name;//$queryBidHis =
				//if ($rowBidHis['item_id'] == $item_id)
					echo "<tr>
					<td>" . $bidUser." ".$name. "</td><td>" . $rowBidHis['price'] . "</td>
					<input type='hidden' name='user_id' id='user_id' value='".$bidUser."'/>
				</tr>";
			}
		}
	?>
	</tbody>
</table>
