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
 ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>winePad</title>
    <!--<script src="vendors/jquery/dist/jquery.min.js" type="text/javascript"></script>
    <script src="vendors/bootstrap/dist/js/bootstrap.min.js" type="text/javascript"></script>
    <link href="vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" />-->
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
    <script src="scripts/controllers/ShowWineController.js" type="text/javascript"></script>

    <link href="vendors/angular-material/angular-material.min.css" type="text/javascript"></script>
    <link href="styles/styles.css" rel="stylesheet" />
  </head>
<body>
  <div>
    <div>
      <div >
        <button>
            <span></span>
            <span></span>
            <span></span>
        </button>
        <a>winePad</a>
      </div>
      <div>
        <form method="POST">
        
            <label for="loginusername">User Name: </label>
            <input placeholder="User name" type="text" name="loginusername" id="loginusername" />
  
            <label for="loginpassword">Password: </label>
            <input placeholder="Password" type="password" name="loginpassword" />
          </div>

          <inputtype="submit" name="submit" value="Log In" />
        </form>
      </div>
    </div>
  </div>

  <div id="topContainer">
    <div>
      <div>
        <h1>winePad</h1>
        <p>Your Personal Wine Cellar Management System</p>
        <?php
        //Display any eorrs
          if($error){
            echo '<div>'.addslashes($error).'</div>'; //.addslashes escapes any quotes
          }
          if($message){
            echo '<div>'.addslashes($message).'</div>';
          }
         ?>
        <form method="POST">
            <label for="email">Name</label>
            <input placeholder="Name" type="text" name="name" id="name" value="<?php echo addslashes($_POST['name']);?>"/>

            <label for="email">User Name</label>
            <inputplaceholder="User Name" type="text" name="username" id="username" value="<?php echo addslashes($_POST['username']);?>"/>
 
            <label for="email">Email</label>
            <input placeholder="Email" type="email" name="email" id="email" value="<?php echo addslashes($_POST['email']);?>"/>

            <label for="password">Password</label>
            <input placeholder="Password" type="password" name="password" value="<?php echo addslashes($_POST['password']);?>"/>
          <input  type="submit" name="submit" value="Register" />
        </form>
      </div>
    </div>
  </div>
</body>
</html>
