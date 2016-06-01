<?php
  include('scripts/connection.php');
  include('scripts/registration_login_script.php');

  $query = "SELECT * FROM winelist_".$_COOKIE['username'].";";

 ?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Update Delete</title>
    <script src="vendors/jquery/dist/jquery.min.js" type="text/javascript"></script>
    <script src="vendors/bootstrap/dist/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="scripts/edit.js" type="text/javascript"></script>

    <link href="vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="styles/styles.css" rel="stylesheet" />
    <link href="styles/animate.css" rel="stylesheet" />
  </head>
<body data-spy="scroll" data-target=".navbar-collapse">
  <div class="navbar navbar-default navbar-fixed-top">
    <div class="container">
      <div class="navbar-header">
        <button class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand">winePad</a>
      </div>
      <div class="collapse navbar-collapse">
        <div class="pull-left">
          <ul class="navbar-nav nav">
            <li><a href="home.php">Home</a></li>
            <li><a href="add.php">Add</a></li>
            <li><a href="update_delete.php">Update / Delete</a></li>
            <li><a href="wine_menu.php">Wine Menu</a></li>
          </ul>
        </div>
        <div class="pull-right">
          <ul class="navbar-nav nav">
            <li><a href="index.php?logout=1">Log Out</a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>

  <div class="container" id="topContainer">
    <div class="row">
      <div class="col-md-6 col-md-offset-3">
        <h1>Update / Delete Wine</h1>
        <div class="wine-feed-box">

        <?php
          if($result = mysqli_query($link, $query)){

            while ($row = mysqli_fetch_array($result)){
              echo('<div class="animated fadeInRight underline">
                      <div class="wine-avatar"><img class="pull-left" src="'.$row['Imgurl'].'" /></div>
                      <div><b>'.$row['Name'].' '.$row['Vintage'].' '.$row['Varietal'].'</b></div>
                      <div>Inventory: '.$row['Inventory'].' Cost: $'.$row['Cost'].' Price: $'.$row['Price'].'</div>
                      <button value="'.$row['ID'].'" class="btn btn-danger update" name="update">Update</button> <button value="'.$row['ID'].'" class="btn btn-danger" name="delete">Delete</button>
                   </div>');
              }
            }


         ?>


       </div>

      </div>
    </div>
  </div>



</body>
</html>
