<?php
require './core/database.php';
require './controllers/baseController.php';
require './models/baseModel.php';
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
  <script src="https://accounts.google.com/gsi/client" async></script>
  <script>
// Credential response handler function
function handleCredentialResponse(response){
    // Post JWT token to server-side
    fetch("auth_init.php", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ request_type:'user_auth', credential: response.credential }),
    })
    .then(response => response.json())
    .then(data => {
        if(data.status == 1){
            let responsePayload = data.pdata;

            // Display the user account data
            let profileHTML = '<h3>Welcome '+responsePayload.given_name+'! <a href="javascript:void(0);" onclick="signOut('+responsePayload.sub+');">Sign out</a></h3>';
            profileHTML += '<img src="'+responsePayload.picture+'"/><p><b>Auth ID: </b>'+responsePayload.sub+'</p><p><b>Name: </b>'+responsePayload.name+'</p><p><b>Email: </b>'+responsePayload.email+'</p>';
            document.getElementsByClassName("pro-data")[0].innerHTML = profileHTML;
            
            document.querySelector("#btnWrap").classList.add("hidden");
            document.querySelector(".pro-data").classList.remove("hidden");
        }
    })
    .catch(console.error);
}

// Sign out the user
function signOut(authID) {
    document.getElementsByClassName("pro-data")[0].innerHTML = '';
    document.querySelector("#btnWrap").classList.remove("hidden");
    document.querySelector(".pro-data").classList.add("hidden");
}    
</script>

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