<?php
//require('scripts/php/registration_login_script.php');//bring in php script
$server = 'us-cdbr-iron-east-04.cleardb.net';
$username = 'bc2c2a7b9fa38a';
$password = 'c529e739';
$db = 'heroku_d318c8835a649ae';

$link = mysqli_connect($server, $username, $password, $db);
//require('scripts/php/connection.php');//brings in the connection for the database
session_start();


 ?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Home</title>
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
    <link href="styles/styles.css" rel="stylesheet" />
    <link href="styles/animate.css" rel="stylesheet" />
  </head>
<body>

  <div ng-include src="'views/partials/navigation.php'"></div>

  <div class="container" id="topContainer">
    <div class="row">
      <div class="col-md-6 col-md-offset-3">
          <h1>Home</h1>
          <div class="dashboard">

          </div>
          <div class="wine-feed-box">

          </div>
    </div>
  </div>
</div>
</body>
</html>
