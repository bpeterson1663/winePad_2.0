<?php
session_start();

//checks if user is logged out and displays a message
if($_GET['logout']==1 AND $_SESSION['id']){
  session_destroy();
  $message = "You have been logged out. Have a nice day!";
  session_start();
}


include('connection.php');

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

      $query = "CREATE TABLE winelist_".$_POST['username']." (ID int NOT NULL AUTO_INCREMENT, Name text, Varietal text, Vintage text, Appelation text, Region text, Imgurl text, Cost int, Price int, Inventory int, Tastingnotes text, Wineryinfo text, PRIMARY KEY (ID));";

      mysqli_query($link, $query);

      header("Location: home.php");

      $_SESSION['id']=mysqli_insert_id($link);//starts the session with the last person that was created


    }
  }
}

if ($_POST['submit'] == "Log In") {

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
