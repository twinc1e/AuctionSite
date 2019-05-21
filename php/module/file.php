<?require_once('../core/db.php');?>
<h3 class="sub-header">Чек покупателя</h3>
<div class="table-responsive">
<table class="table table-striped">
  <thead>
    <tr>
      <th>Наименование</th>
      <th>Количество</th>
      <th>Цена</th>
      <th>Сумма</th>
    </tr>
  </thead>
  <tbody>
    <tr><?
    $num=7
    $query = "SELECT item.item_id as Num, item.itemname as Name, MAX(bidHistory.price) as Price
              FROM item, bidHistory
              WHERE item.item_id=bidHistory.item_id AND item.winner=bidHistory.user_id
              AND bidHistory.user_id="+$num+" GROUP BY item.item_id";
  	$result = $mysqli->query($query)or die('Error: '.$mysqli->error);
    $count=mysqli_num_rows($result);
    if( $count!= 0)
  		while($data = mysqli_fetch_array($result)){
          echo '<tr>
          <td>'.$row['Name'].' </td>
          <td>1 </td>
          <td>'.$row['Price'].' </td>
          <td>'.$row['Price'].'9 </td>
      }';
    }
    //echo'<td>'.sum($row['Price']).' </td>';
    ?>
  </tr>
</table>
</div>
