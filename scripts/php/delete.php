<?php
  include("connection.php");

  $ID = $_POST['ID'];

  $query = "DELETE FROM winelist_".$_COOKIE['username']." WHERE ID='".$ID."';";
  if($result = mysqli_query($link, $query)){
    echo '<div class="alert alert-success">Wine Deleted Succesfully</div>';
    //header("Location: update_delete.php");
  }
  else{
    echo '<div class="alert alert-danger">There was an error deleting your wine. Please try again.</div>';
  }

 ?>
