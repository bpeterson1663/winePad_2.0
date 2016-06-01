<?php
  include('scripts/registration_login_script.php');//bring in php script
  include('scripts/connection.php');//brings in the connection for the database
 ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>winePad</title>
    <script src="vendors/jquery/dist/jquery.min.js" type="text/javascript"></script>
    <script src="vendors/bootstrap/dist/js/bootstrap.min.js" type="text/javascript"></script>
    <link href="vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" />
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
        <form class="navbar-form navbar-right" method="POST">
          <div class="form-group">
            <label for="loginusername">User Name: </label>
            <input class="form-control" placeholder="User name" type="text" name="loginusername" id="loginusername" />
          </div>
          <div class="form-group">
            <label for="loginpassword">Password: </label>
            <input class="form-control" placeholder="Password" type="password" name="loginpassword" />
          </div>

          <input class="btn btn-danger" type="submit" name="submit" value="Log In" />
        </form>
      </div>
    </div>
  </div>

  <div class="container" id="topContainer">
    <div class="row">
      <div class="col-md-6 col-md-offset-3">
        <h1>winePad</h1>
        <p class="lead">Your Personal Wine Cellar Management System</p>
        <?php
        //Display any eorrs
          if($error){
            echo '<div class="alert alert-danger">'.addslashes($error).'</div>'; //.addslashes escapes any quotes
          }
          if($message){
            echo '<div class="alert alert-success">'.addslashes($message).'</div>';
          }
         ?>
        <form method="POST">
          <div class="form-group">
            <label for="email">Name</label>
            <input class="form-control" placeholder="Name" type="text" name="name" id="name" value="<?php echo addslashes($_POST['name']);?>"/>
          </div>
          <div class="form-group">
            <label for="email">User Name</label>
            <input class="form-control" placeholder="User Name" type="text" name="username" id="username" value="<?php echo addslashes($_POST['username']);?>"/>
          </div>
          <div class="form-group">
            <label for="email">Email</label>
            <input class="form-control" placeholder="Email" type="email" name="email" id="email" value="<?php echo addslashes($_POST['email']);?>"/>
          </div>
          <div class="form-group">
            <label for="password">Password</label>
            <input class="form-control" placeholder="Password" type="password" name="password" value="<?php echo addslashes($_POST['password']);?>"/>
          </div>

          <input class="btn btn-lg btn-danger" type="submit" name="submit" value="Register" />
        </form>


      </div>
    </div>
  </div>
</body>
</html>
