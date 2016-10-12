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

  if($_POST['submit']=='Update Wine'){
    $ID = $_POST['id'];
    $name = $_POST['name'];
    $vintage = $_POST['vintage'];
    $varietal = $_POST['varietal'];
    $appellation = $_POST['appellation'];
    $region = $_POST['region'];
    $cost = $_POST['cost'];
    $imageurl = $_POST['imageurl'];
    $price = $_POST['price'];
    $size = $_POST['size'];
    $inventory = $_POST['inventory'];
    $tastingnotes = $_POST['tastingnotes'];
    $wineryinfo = $_POST['wineryinfo'];

    $query = "UPDATE `winelist_".$_COOKIE['username']."`".
              "SET `Name`='".$name."',`Varietal`='".$varietal."',`Vintage`='".$vintage."',`Appellation`='".$appellation."',`Region`='".$region."',`Imgurl`='".$imageurl."',`Cost`='".$cost."',`Price`='".$price."',`Size`='".$size."',`Inventory`='".$inventory."', ".
              "`Tastingnotes`='".$tastingnotes."',`Wineryinfo`='".$wineryinfo."' WHERE ID='".$ID."';";

    if(mysqli_query($link, $query)){
      $message = '<div class="alert alert-success">Wine Updated Succesfully</div>';
    }else{
      $message = '<div class="alert alert-danger">There was an error updating your wine. Please try again.</div>';
    }
  }

 ?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Update Delete</title>
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
    <script src="scripts/controllers/UpdateDeleteController.js" type="text/javascript"></script>

    <link href="styles/styles.css" rel="stylesheet" />
  </head>
<body data-spy="scroll" data-target=".navbar-collapse">
  
  <div ng-include src="'views/partials/navigation.php'"></div>
  
  <div class="container" id="topContainer">
    <div class="row">
      <div class="col-md-6 col-md-offset-3">
        <h1>Update / Delete Wine</h1>
        <div class="response">
          <?php
            if($message){
              echo $message;
            }
          ?>
        </div>

        <div class="wine-feed-box">

        <?php
          $query = "SELECT * FROM winelist_".$_COOKIE['username'].";";
          if($result = mysqli_query($link, $query)){

            while ($row = mysqli_fetch_array($result)){
              echo('<div class="animated fadeInRight underline">
                      <div class="wine-avatar"><img class="pull-left" src="'.$row['Imgurl'].'" /></div>
                      <div><b>'.$row['Name'].' '.$row['Vintage'].' '.$row['Varietal'].'</b></div>
                      <div>Inventory: '.number_format($row['Inventory'],1).' Cost: $'.number_format($row['Cost'],2).' Price: $'.number_format($row['Price'],2).'</div>
                      <button data-id="'.$row['ID'].'" value="'.$row['ID'].'" class="btn btn-danger update-wine" name="update" data-toggle="modal" data-target="#updateWine">Update</button><button value="'.$row['ID'].'" data-id="'.$row['ID'].'" class="btn btn-danger delete" name="delete" >Delete</button>
                   </div>');
              }
            }
         ?>


       </div>

      </div>
    </div>
  </div>

<!--Delete Wine Modal-->
  <div class="modal fade" id="deleteWine" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel">Search Results</h4>
        </div>
        <div class="modal-body">
          <div class="wine-results">
            <p>Are You Sure You Want to Delete This Wine?</p>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger confirm-delete" data-dismiss="modal">Yes</button>
          <button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
        </div>
      </div>
    </div>
  </div>
  <!--End of Delete Wine Modal-->
  <!--Start of Update Modal-->
  <div class="modal fade" id="updateWine" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel">Search Results</h4>
        </div>
        <div class="modal-body" id="wineUpdateBody">

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>


</body>
</html>
