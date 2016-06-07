<?php

  include('connection.php');

  $query = "SELECT * FROM winelist_".$_COOKIE['username'].";";

  if($result = mysqli_query($link, $query)){
    while ($row = mysqli_fetch_array($result)){
        echo '<div class="animated fadeInRight underline">
                <div class="wine-avatar"><img class="pull-left" src="'.$row['Imgurl'].'" /></div>
                <div><b>'.$row['Name'].' '.$row['Vintage'].' '.$row['Varietal'].'</b></div>
                <div>Inventory: '.$row['Inventory'].' Cost: $'.$row['Cost'].' Price: $'.$row['Price'].'</div>
              </div>';
    };
  }
 ?>
