<?php
  include("connection.php");

  $ID = $_POST['ID'];
  echo $ID;
  $query = "DELETE FROM winelist_".$_COOKIE['username']." WHERE ID='".$ID."';";
  if($result = mysqli_query($link, $query)){
    echo "Successfully Deleted";
    header("Location: update_delete.php");
  }
  else{
    echo "Try again";
  }

 ?>
