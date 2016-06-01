<?php
  include('connection.php');
  
  $ID = $_POST['ID'];
  $query = "SELECT * FROM winelist_".$_COOKIE['username']." WHERE ID='".$ID."';";
  $result = mysqli_query($link, $query);

 ?>
