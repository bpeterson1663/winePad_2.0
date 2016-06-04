<?php
  include('connection.php');

  $value = $_POST['update'];
  $ID = (int)$value;
  $query = "SELECT * FROM winelist_".$_COOKIE['username']." WHERE ID='".$ID."';";
  $result = mysqli_query($link, $query);


  echo (int)$ID.'</br>';
  echo $_COOKIE['username'];
  while($row = mysqli_fetch_array($result)){
      echo $row['Name'];

  }

 ?>
