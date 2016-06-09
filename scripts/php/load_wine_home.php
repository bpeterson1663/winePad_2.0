<?php

  include('connection.php');

  $query = "SELECT * FROM winelist_".$_COOKIE['username'].";";

  if($result = mysqli_query($link, $query)){
    while ($row = mysqli_fetch_array($result)){
        echo '<div class="animated fadeInRight underline">
                <div class="wine-avatar"><img class="pull-left" src="'.$row['Imgurl'].'" /></div>
                <div><b>'.$row['Name'].' '.$row['Vintage'].' '.$row['Varietal'].'</b></div>
                <div>Inventory: '.number_format($row['Inventory'], 1).' Cost: $'.number_format($row['Cost'],2).' Price: $'.number_format($row['Price'],2).'</div>
              </div>';
    };
  }
 ?>
