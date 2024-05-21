<?php

require_once '../../databaseUsingAjax.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $name = $_POST['name'];
  $creator = $_POST['creator'];
  $count = $_POST['count'];
  $publisher = $_POST['publisher'];
  $dateBook = $_POST['dateBook'];
  $des = $_POST['des'];
  $category = $_POST['category'];

  if($count < 0){
    $count = 0;
  }

  if(isset($_POST['image'])){
    $image = $_POST['image'];
  }else{
    $image = '';
  }

  $sql = "select * from book where nameBook = '$name'";
  $result = mysqli_query($conn, $sql);
  if (mysqli_num_rows($result) < 1) {
    $sql = "INSERT INTO book VALUES ('', '$name', '$count', '$image', '$creator', '$publisher', '$dateBook', '$des', '$category')";
    $result = mysqli_query($conn, $sql);
    if ($result) {
      $response = array(
        'status' => 'success',
        'msg' => 'Thêm sách thành công.',
        'path' => "?controller=admin&action=book"
      );
      echo json_encode($response);
    } else {
      $response = array(
        'status' => 'error',
        'msg' => 'Thêm sách không thành công.',
        'path' => "?controller=admin&action=book"
      );
      echo json_encode($response);
    }
  } else {
    $response = array(
      'status' => 'error',
      'msg' => 'Tên sách đã tồn tại.',
      'path' => "?controller=admin&action=book"
    );
    echo json_encode($response);
  }

} else {
  $response = array(
    'status' => 'success',
    'msg' => 'Lỗi không thể thêm sách.',
    'path' => "?controller=admin&action=book"
  );
  echo json_encode($response);
}

$conn = null;