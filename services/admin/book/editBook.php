<?php

require_once '../../databaseUsingAjax.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $id = $_POST['id'];
  $name = $_POST['name'];
  $creator = $_POST['creator'];
  $count = $_POST['count'];
  $publisher = $_POST['publisher'];
  $dateBook = $_POST['dateBook'];
  $des = $_POST['des'];
  $category = $_POST['category'];
  $image = $_POST['image'];

  if ($count < 0) {
    $count = 0;
  }
  $sql = "select * from book where idBook= '$id'";
  $result = mysqli_query($conn, $sql);

  if (mysqli_fetch_assoc($result)['nameBook'] === $name) {
    $sql = "UPDATE book SET nameBook = '$name', quantityBook = '$count', imgBook = '$image', creatorBook = '$creator', publisherBook = '$publisher', dateBook = '$dateBook', desBook = '$des', id_Category = '$category' WHERE idBook = '$id'";
    $result = mysqli_query($conn, $sql);
    if ($result) {
      $response = array(
        'status' => 'success',
        'msg' => 'Chỉnh sửa thành công',
        'path' => "?controller=admin&action=book"
      );
      echo json_encode($response);
    } else {
      $response = array(
        'status' => 'error',
        'msg' => 'Chỉnh sửa không thành công!',
        'path' => "?controller=admin&action=book"
      );
      echo json_encode($response);
    }
  } else {
    $sql = "select * from book where nameBook = '$name'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
      $response = array(
        'status' => 'error',
        'msg' => 'Tên sách đã tồn tại!',
        'path' => "?controller=admin&action=book"
      );
      echo json_encode($response);
    } else {
      $sql = "UPDATE book SET nameBook = '$name', quantityBook = '$count', imgBook = '$image', creatorBook = '$creator', publisherBook = '$publisher', dateBook = '$dateBook', desBook = '$des', id_Category = '$category' WHERE idBook = '$id'";
      $result = mysqli_query($conn, $sql);
      if ($result) {
        $response = array(
          'status' => 'success',
          'msg' => 'Chỉnh sửa thành công',
          'path' => "?controller=admin&action=book"
        );
        echo json_encode($response);
      } else {
        $response = array(
          'status' => 'error',
          'msg' => 'Chỉnh sửa không thành công!',
          'path' => "?controller=admin&action=book"
        );
        echo json_encode($response);
      }
    }
  }



} else {
  $response = array(
    'status' => 'success',
    'msg' => 'Lỗi không thể chỉnh sửa!',
    'path' => "?controller=admin&action=book"
  );
  echo json_encode($response);
}

$conn = null;