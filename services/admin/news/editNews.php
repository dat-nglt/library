<?php

require_once '../../databaseUsingAjax.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $id = $_POST['id'];
  $title = $_POST['title'];
  $content = $_POST['content'];
  $image = $_POST['image'];


  $sql = "select * from news where id= '$id'";
  $result = mysqli_query($conn, $sql);

  if (mysqli_fetch_assoc($result)['title'] === $title) {
    $sql = "UPDATE news SET title = '$title', image = '$image', content = '$content' WHERE id = '$id'";
    $result = mysqli_query($conn, $sql);
    if ($result) {
      $response = array(
        'status' => 'success',
        'msg' => 'Chỉnh sửa thành công',
        'path' => "?controller=admin&action=news"
      );
      echo json_encode($response);
    } else {
      $response = array(
        'status' => 'error',
        'msg' => 'Chỉnh sửa không thành công.',
        'path' => "?controller=admin&action=news"
      );
      echo json_encode($response);
    }
  } else {
    $sql = "select * from news where title = '$title'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
      $response = array(
        'status' => 'error',
        'msg' => 'Tiêu đề đã tồn tại.',
        'path' => "?controller=admin&action=news"
      );
      echo json_encode($response);
    } else {
      $sql = "UPDATE news SET title = '$title', image = '$image',content = '$content' WHERE id = '$id'";
      $result = mysqli_query($conn, $sql);
      if ($result) {
        $response = array(
          'status' => 'success',
          'msg' => 'Chỉnh sửa thành công',
          'path' => "?controller=admin&action=news"
        );
        echo json_encode($response);
      } else {
        $response = array(
          'status' => 'error',
          'msg' => 'Chỉnh sửa không thành công',
          'path' => "?controller=admin&action=news"
        );
        echo json_encode($response);
      }
    }
  }



} else {
  $response = array(
    'status' => 'success',
    'msg' => 'Lỗi không thể thêm .',
    'path' => "?controller=admin&action=book"
  );
  echo json_encode($response);
}

$conn = null;