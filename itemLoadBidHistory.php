<?php
	if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'){
		include 'function/db.php';
		$item_id = $_GET['item_id'];
	
		$queryBidHis = "SELECT * FROM bidHistory, user WHERE bidHistory.item_id = $item_id AND bidHistory.user_id =user.user_id ORDER BY bidHistory.bidhistory_id DESC";
		$resultBidHis = $mysqli->query($queryBidHis) or die(mysqli_error());
		$emptyBidHis = (mysqli_num_rows($resultBidHis) == 0? true:false);
	}
?>

<table>	
	<caption><h1>Bidding History</h1></caption>
	<tbody>
	<?php
		if($emptyBidHis){
			echo "<tr>
			<td style='border:none'><h3>No bidding history</h3></td>
			<input type='hidden' name='user_id' id='user_id' value='0'>
			</tr>";
		}else{
			echo "<tr><th>User</th><th>Biding value</th></tr>";
			while($rowBidHis = mysqli_fetch_array($resultBidHis))
			{
				echo "<tr>
					<td>" . $rowBidHis['username'] . "</td><td>" . $rowBidHis['price'] . "</td>
					<input type='hidden' name='user_id' id='user_id' value='".$rowBidHis['user_id']."'/>
				</tr>";
			}
		}
	?>	
	</tbody>
</table>