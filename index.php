<?php
require './core/database.php';
require './controllers/baseController.php';
require './models/baseModel.php';
require './message.php';
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/cloudinary-jquery/2.13.1/cloudinary-jquery.min.js"></script>
  <link rel="stylesheet" href="./css/style.css">
  <link rel="stylesheet" href="./css/login.css">
  <link rel="stylesheet" href="./css/user/main.css">
  <link rel="stylesheet" href="./css/user/profile.css">
  <link rel="stylesheet" href="./css/admin/main.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.7.28/sweetalert2.all.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.7.28/sweetalert2.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
    integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap" />
  <script>

    function handleCredentialResponse(response) {
      // Post JWT token to server-side
      fetch("auth_init.php", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ request_type: 'user_auth', credential: response.credential }),
      })
        .then(response => response.json())
        .then(data => {
          if (data.status == 1) {
            let responsePayload = data.pdata; //dữ liệu người dùng trả về từ gmail.
          }
        })
        .catch(console.error);
    }

    // Sign out the user
    function signOut(authID) {
      document.getElementsByClassName("pro-data")[0].innerHTML = '';
    }
  </script>
 <link rel="shortcut icon" type="image/png" href="./upload/logo-admin.png"/>
  <title>TRUNG TÂM HỌC LIỆU CTUT</title>
</head>

<body>

  <div class="container">
    <?php

    if (isset($_GET['controller'])) {
      $controllerName = $_GET['controller'] . 'Controller';
      if ($_GET['controller'] === 'user') {
        require_once './views/user/header.php';
        echo '<div class="background-container">';
      } else if ($_GET['controller'] === 'admin') {
        require_once './views/admin/header.php';
      }
      $actionName = isset($_REQUEST['action']) ? strtolower($_REQUEST['action']) : 'index';

      require_once "./controllers/" . $controllerName . ".php";
      $controllerObject = new $controllerName;
      $controllerObject->$actionName();
    } else {
      require_once './views/user/header.php';
      echo '<div class="background-container">';
      require_once "./views/user/home.php";
    }
    if ((isset($_GET['controller']) && $_GET['controller'] === 'user') || !isset($_GET['controller'])) {
      require_once './views/user/footer.php';
      echo "</div>";
    }
    ;
    ?>
  </div>


</body>

</html>