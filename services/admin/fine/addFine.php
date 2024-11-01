<?php

require_once '../../databaseUsingAjax.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $idRequest = $_POST['idRequest'];
  $price = $_POST['price'];
  $des = $_POST['des'];

  $sql = "INSERT INTO fine VALUES ('', '$idRequest', '$price', DATE(NOW()), '$des')";
  $result = mysqli_query($conn, $sql);
  if ($result) {
    $sql = "UPDATE request_detail SET statusRD = '2' WHERE idRequestDetail = '$idRequest'";
    $result = mysqli_query($conn, $sql);
    if($result){
      $response = array(
        'status' => 'success',
        'msg' => 'Thêm phiếu phạt thành công',
        'path' => "?controller=admin&action=fine"
      );
      echo json_encode($response);
    }else{
      $response = array(
        'status' => 'error',
        'msg' => 'Cập nhật trạng thái phiếu mượn không thành công!',
        'path' => "?controller=admin&action=fine"
      );
      echo json_encode($response);
    }
  } else {
    $response = array(
      'status' => 'error',
      'msg' => 'Thêm phiếu phạt không thành công!',
      'path' => "?controller=admin&action=fine"
    );
    echo json_encode($response);
  }
} else {
  $response = array(
    'status' => 'error',
    'msg' => 'Lỗi không thể thêm phiếu phạt!',
    'path' => "?controller=admin&action=fine"
  );
  echo json_encode($response);
}

$conn = null;