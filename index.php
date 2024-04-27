<?php
require './core/database.php';
require './controllers/baseController.php';
require './models/baseModel.php';
require 'login-google/vendor/autoload.php';
require 'core/googleAPI.php';
$client = clientGoogle();
$url = $client->createAuthUrl();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./css/style.css">
  <link rel="stylesheet" href="./css/login.css">
  <link rel="stylesheet" href="./css/user/header.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
    integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap" />

  <title>Document</title>
</head>

<body>
  <?php
  require './views/user/header.php';
  ?>
  <div class="container">
    <?php

    // '?controller=user&action=login'
    if (isset($_GET['controller'])) {
      $controllerName = $_GET['controller'] . 'Controller'; // => userController
      // echo $controllerName;
      $actionName = isset($_REQUEST['action']) ? strtolower($_REQUEST['action']) : 'index';
      //include nguyen cai file controller do.
      require "./controllers/" . $controllerName . ".php"; //=>./controllers/userController.php
      //khoi tao 1 doi tuong
      $controllerObject = new $controllerName;
      //tu doi tuong goi ham can chay
      $controllerObject->$actionName(); //login
    } else {
      require "./views/general/login.php";
    }
    ?>
  </div>


</body>

</html>