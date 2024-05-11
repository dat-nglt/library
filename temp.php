<?php
require_once './views/user/header.php';
echo '<div class="background-container">';

if (isset($_GET['controller']) && $_GET['controller'] === 'user') {
  $controllerName = $_GET['controller'] . 'Controller';
  $actionName = isset($_REQUEST['action']) ? strtolower($_REQUEST['action']) : 'index';

  require_once "./controllers/" . $controllerName . ".php";
  $controllerObject = new $controllerName;
  $controllerObject->$actionName();
} else {
  require_once "./views/user/home.php";
}

if ((isset($_GET['controller']) && $_GET['controller'] === 'user') || !isset($_GET['controller'])) {
  require_once './views/user/footer.php';
  echo "</div>";
}
