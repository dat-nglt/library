<?php

require_once '../../databaseUsingAjax.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $idFine = $_POST['idFine'];
  $price = $_POST['price'];
  $des = $_POST['des'];

  $sql = "UPDATE fine SET amount = '$price', reason = '$des' WHERE idFine = '$idFine'";
  $result = mysqli_query($conn, $sql);
  if ($result) {
      $response = array(
        'status' => 'success',
        'msg' => 'Cập nhật phiếu phạt thành công',
        'path' => "?controller=admin&action=fine"
      );
      echo json_encode($response);
  } else {
    $response = array(
      'status' => 'error',
      'msg' => 'Cập nhật phiếu phạt không thành công!',
      'path' => "?controller=admin&action=fine"
    );
    echo json_encode($response);
  }
} else {
  $response = array(
    'status' => 'error',
    'msg' => 'Lỗi không thể cập nhật phiếu phạt!',
    'path' => "?controller=admin&action=fine"
  );
  echo json_encode($response);
}

$conn = null;