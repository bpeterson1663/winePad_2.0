<?php
  include('connection.php');
  if($_POST['submit']=='Add Wine'){
    $name = $_POST['name'];
    $vintage = $_POST['vintage'];
    $varietal = $_POST['varietal'];
    $appellation = $_POST['appellation'];
    $region = $_POST['region'];
    $cost = $_POST['cost'];
    $imageurl = $_POST['imageurl'];
    $price = $_POST['price'];
    $size = $_POST['size'];
    $tastingnotes = $_POST['tastingnotes'];
    $wineryinfo = $_POST['wineryinfo'];

    $query = "INSERT INTO `winelist` (`User`, `Name`, `Varietal`, `Vintage`, `Appellation`, `Region`, `Cost`, `Price`, `Size`, `Inventory`, `Tastingnotes`, `WineryInfo`) VALUES ('".$_COOKIE['username']."', '".$name."', '".$varietal."', '".$vintage."', '"
                .$appellation."', '".$region."', '".$cost."', '".$price."', '".$size."', '".$inventory."', '".$tastingnotes."', '".$wineryinfo."');";

    mysqli_query($link, $query);
  }
  echo "This is name ".$_POST['name'];
?>
