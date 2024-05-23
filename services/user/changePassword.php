<?php
require_once '../databaseUsingAjax.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  $oldPassword = $_POST['oldPassword'];
  $newPassword = $_POST['newPassword'];
  if (password_verify($oldPassword, $_SESSION['user']['password'])) {
    $id = $_SESSION['user']['id'];
    $newHashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
    $sql = "UPDATE `user` SET `password` = '$newHashedPassword' WHERE `user`.`id` = $id;";
    $changeResult = mysqli_query($conn, $sql);
    if ($changeResult) {
      $_SESSION['user']['password'] = $newHashedPassword;
      $response = array(
        'status' => 'success',
        'msg' => 'Cập nhật mật khẩu thành công',
        'path' => "?controller=user&action=profile&profilePage=changePassword"
      );
      echo json_encode($response);
    } else {
      $response = array(
        'status' => 'warning',
        'msg' => 'Cập nhật mật khẩu không thành công',
        'path' => "?controller=user&action=profile&profilePage=changePassword"
      );
      echo json_encode($response);
    }
  } else {
    $response = array(
      'status' => 'error',
      'msg' => 'Mật khẩu cũ không chính xác',
      'path' => "?controller=user&action=profile&profilePage=changePassword"
    );
    echo json_encode($response);
  }
} else {
  $response = array(
    'status' => 'error',
    'msg' => 'Tên tài khoản hoặc mật khẩu không chính xác',
    'path' => "?controller=admin&action=account"
  );
  echo json_encode($response);
}

$conn = null;