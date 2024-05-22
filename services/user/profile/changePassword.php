<?php
require_once '../../databaseUsingAjax.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $oldPassword = $_POST['oldPassword'];
  $newPassword = $_POST['newPassword'];
  if (password_verify($oldPassword, $_SESSION['user']['password'])) {
    $id = $_SESSION['user']['password'];
    $newHashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
    $sql = "UPDATE `user` SET `password` = '$newHashedPassword' WHERE `user`.`id` = $id;";
    $changeResult = mysqli_query($conn, $sql);
    if ($changeResult) {
      $_SESSION['user']['password'] = $newHashedPassword;
      http_response_code(200);
    } else {
      http_response_code(400);
    }
  } else {
    http_response_code(400);
  }
} else {
  echo "Phương thức không được hỗ trợ.";
}

$conn = null;