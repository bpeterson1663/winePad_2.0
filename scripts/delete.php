<?php
  include("connection.php");

  $ID = $_POST['ID'];
  echo $ID;
  $query = "DELETE FROM winelist_".$_COOKIE['username']." WHERE ID='".$ID."';";
  if($result = mysqli_query($link, $query)){
    $message = '<div class="alert alert-success">Wine Deleted Succesfully</div>';
    header("Location: update_delete.php");
  }
  else{
    $message = '<div class="alert alert-danger">There was an error deleting your wine. Please try again.</div>';
  }

 ?>
