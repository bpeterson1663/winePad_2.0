<?php
  include('connection.php');

  $query = 'SELECT Inventory, Cost FROM winelist_'.$_COOKIE['username'].';';

  if($result = mysqli_query($link, $query)){
    while ($row = mysqli_fetch_array($result)){
      $totalInventory+=$row['Inventory'];
      $totalCostInventory = $totalCostInventory + ($row['Inventory'] * $row['Cost']);
    };

    echo '<p><b>Total Inventory:</b> '.number_format($totalInventory,1).' bottle(s) | <b>Total Cost of Inventory:</b> $'.number_format($totalCostInventory, 2).'</p>';
  }
 ?>
