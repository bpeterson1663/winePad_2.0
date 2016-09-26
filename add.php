<?php
//require('scripts/php/registration_login_script.php');//bring in php script
$server = 'us-cdbr-iron-east-04.cleardb.net';
$username = 'bc2c2a7b9fa38a';
$password = 'c529e739';
$db = 'heroku_d318c8835a649ae';

$link = mysqli_connect($server, $username, $password, $db);
//require('scripts/php/connection.php');//brings in the connection for the database
session_start();

//checks if user is logged out and displays a message
if($_GET['logout']==1 AND $_SESSION['id']){
  session_destroy();
  $message = "You have been logged out. Have a nice day!";
  session_start();
}


//checks which submit button was pressed
//Register button pressed
if($_POST['submit']=="Register"){
  //form validation
  if(!$_POST['name']){//if name is blank
    $error.="<br/>Pleae enter your name";
  }
  if(!$_POST['username']){//if name is blank
    $error.="<br/>Pleae enter a User Name";
  }
  if(!$_POST['email']){//if they didnt enter anything for email
    $error.="<br/>Please enter your email";
  }else if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){//checks if valid email
    $error.="<br/>Please enter a valid email address";
  }
  if (!$_POST['password']){//check if they enter anything for a password
    $error.="<br/>Please enter your password";
  }else{
    if(strlen($_POST['password']) < 8 ){//checks if password is atleast 8 characters
      $error.="<br/>Please enter a password longer than 8 characters.";
    }
    if(!preg_match('`[A-Z]`', $_POST['password'])){//checks to see if any capital letters are in the password and if not throw an error
      $error.="<br/>Please include at least one capital letter in your password";
    }
  }
  if ($error){
    $error = "<br/>There were error(s) in your signup details:".$error;
  }else{//check to see if email already exists
    //create query string that will look for the email they entered
    $query="SELECT * FROM users WHERE username='".mysqli_real_escape_string($link, $_POST['username'])."'";

    $result = mysqli_query($link, $query);//runs the query and stores the results

    $results = mysqli_num_rows($result); //mysqli_num_rows returns the number of rows

    if($results){
      $error = "That User Name is already registered. Do you want to log in?";
    }else{
      $query = "INSERT INTO `users` (`name`, `email`, `username`, `password`) VALUES ('".$_POST['name']."', '".$_POST['email']."', '".mysqli_real_escape_string($link, $_POST['username'])."', '".md5(md5($_POST['username']).$_POST['password'])."');";

      mysqli_query($link, $query);
      //creates new wine list table for each user
      $query = "CREATE TABLE winelist_".$_POST['username']." (ID int NOT NULL AUTO_INCREMENT, Name text, Varietal text, Vintage text, Appellation text, Region text, Imgurl text, Cost decimal, Price decimal, Size text, Inventory decimal, Tastingnotes text, Wineryinfo text, PRIMARY KEY (ID));";

      mysqli_query($link, $query);

      header("Location: home.php");

      $_SESSION['id']=mysqli_insert_id($link);//starts the session with the last person that was created


    }
  }
}

if ($_POST['submit'] == "Log In") {

  setcookie('username', $_POST['loginusername']);
  $query = "SELECT * FROM users WHERE username='".mysqli_real_escape_string($link, $_POST['loginusername'])."' AND password='".md5(md5($_POST['loginusername']).$_POST['loginpassword'])."';";

  $result = mysqli_query($link, $query);

  $row = mysqli_fetch_array($result);

  if($row){

    $_SESSION['id']=$row['id'];

    header("Location:home.php");

  } else {
    $error = "We could not find a user with that password. Please try again.";
  }

}

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
    <script src="vendors/angular/angular.min.js" type="text/javascript"></script>
    <script src="vendors/angular-animate/angular-animate.min.js" type="text/javascript"></script>
    <script src="vendors/angular-aria/angular-aria.min.js" type="text/javascript"></script>
    <script src="vendors/angular-material/angular-material.min.js" type="text/javascript"></script>
    <script src="vendors/angular-messages/angular-messages.min.js" type="text/javascript"></script>
    <script src="vendors/angular-route/angular-route.min.js" type="text/javascript"></script>
    <script src="vendors/angular-sanitize/angular-sanitize.min.js" type="text/javascript"></script>
    <script src="vendors/angular-touch/angular-touch.min.js" type="text/javascript"></script>
     
    <script src="scripts/app.js" type="text/javascript"></script>
    <script src="scripts/factories.js" type="text/javascript"></script>
    <script src="scripts/controllers/LoginController.js" type="text/javascript"></script>
    <script src="scripts/controllers/NavigationController.js" type="text/javascript"></script>
    <script src="scripts/controllers/AddWineController.js" type="text/javascript"></script>

    <link href="styles/styles.css" rel="stylesheet" />
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
