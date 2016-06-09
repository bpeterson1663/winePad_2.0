<?php

include('scripts/php/registration_login_script.php');

include('scripts/php/connection.php');
if($_POST['submit']=='Add Wine'){
  $name = $_POST['name'];
  $vintage = $_POST['vintage'];
  $varietal = $_POST['varietal'];
  $appellation = $_POST['appellation'];
  $region = $_POST['region'];
  $cost = (float)$_POST['cost'];
  $imageurl = $_POST['imageurl'];
  $price = (float)$_POST['price'];
  $size = $_POST['size'];
  $inventory = (float)$_POST['inventory'];
  $tastingnotes = $_POST['tastingnotes'];
  $wineryinfo = $_POST['wineryinfo'];

  $query = "INSERT INTO `winelist_".$_COOKIE['username']."` (`Name`, `Varietal`, `Vintage`, `Appellation`, `Region`, `Imgurl`, `Cost`, `Price`, `Size`, `Inventory`, `Tastingnotes`, `WineryInfo`) VALUES ('".$name."', '".$varietal."', '".$vintage."', '"
              .$appellation."', '".$region."', '".$imageurl."', '".$cost."', '".$price."', '".$size."', '".$inventory."', '".$tastingnotes."', '".$wineryinfo."');";

  if(mysqli_query($link, $query)){
    $message = '<div class="alert alert-success">Wine Added Succesfully</div>';
  }else{
    $message = '<div class="alert alert-danger">There was an error adding your wine. Please try again.</div>';
  }

}

 ?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Add</title>
    <script src="vendors/jquery/dist/jquery.min.js" type="text/javascript"></script>
    <script src="vendors/bootstrap/dist/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="scripts/js/wine_api.js" type="text/javascript"></script>

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
          <h1>Add Wine</h1>
          <?php
            if($message){
              echo $message;
            }
          ?>
          <p class="lead">Search Winery</p>

            <form  id="searchApi" >
              <div class="form-group">
                <input class="form-control" placeholder="Winery" type="text" name="searchApi"/>
              </div>
              <input class="btn btn-danger" type="submit" name="submit" value="Search" data-toggle="modal" data-target="#searchResults" />
            </form>


      </div>
    </div>

    <div class="row">
      <div class="col-md-6 col-md-offset-3">
        <p class="lead">Add Wine Manually</p>
        <button class="btn btn-danger manually-add" data-toggle="modal" data-target="#addWineManuallyModal">Add Wine</button>

      </div>
    </div>
  </div>
  <!--Search Results Modal -->
<div class="modal fade" id="searchResults" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Search Results</h4>
      </div>
      <div class="modal-body">
        <div class="wine-results" id="searchResultsList">

        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<!--End Search Results-->
<!--Start of Add Mannually-->
<div class="modal fade" id="addWineManuallyModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Search Results</h4>
      </div>
      <div class="modal-body">
        <div class="wine-results">
          <form id="addWineManually" method="POST" >
            <div class="form-group">
              <label for="name">Name: </label>
              <input class="form-control" placeholder="Name" type="text" name="name"/>
            </div>
            <div class="form-group">
              <label for="varietal">Varietal: </label>
              <input class="form-control" placeholder="Varietal" type="text" name="varietal"/>
            </div>
            <div class="form-group">
              <label for="vintage">Vintage: </label>
              <input class="form-control" placeholder="Vintage" type="text" name="vintage"/>
            </div>
            <div class="form-group">
              <label for="appellation">Appellation: </label>
              <input class="form-control" placeholder="Appellation" type="text" name="appellation"/>
            </div>
            <div class="form-group">
              <label for="region">Region: </label>
              <input class="form-control" placeholder="Region" type="text" name="region"/>
            </div>
            <div class="form-group">
              <label for="imageurl">Image URL: </label>
              <input class="form-control" placeholder="Imageurl" type="text" name="imageurl"/>
            </div>
            <div class="form-group">
              <label for="cost">Cost: </label>
              <input class="form-control" placeholder="Cost" type="number" step="any" name="cost"/>
            </div>
            <div class="form-group">
              <label for="price">Price: </label>
              <input class="form-control" placeholder="Price" type="number" step="any" name="price"/>
            </div>
            <div class="form-group">
              <label for="inventory">Inventory: </label>
              <input class="form-control" placeholder="Inventory" type="number" step="any" name="inventory"/>
            </div>
            <div class="form-group">
              <label for="size">Size: </label>
              <select class="form-control" placeholder="Size" type="number" name="size">
                <option value="">-</option>
                <option value="187 mL">187 mL</option>
                <option value="375 mL">375 mL</option>
                <option value="750 mL">750 mL</option>
                <option value="1.5 L">1.5 L</option>
                <option value="3.0 L">3.0 L</option>
              </select>
            </div>
            <div class="form-group">
              <label for="tastingnotes">Tasting Notes: </label>
              <input class="form-control" placeholder="Tasting Notes" type="text" name="tastingnotes"/>
            </div>
            <div class="form-group">
              <label for="wineryinfo">Winery Information: </label>
              <input class="form-control" placeholder="Winery Information" type="text" name="wineryinfo"/>
            </div>
              <input class="btn btn-danger" type="submit" name="submit" value="Add Wine"  />
          </form>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
</div>

</body>
</html>
