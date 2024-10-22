<?php

require_once '../../databaseUsingAjax.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $title = $_POST['title'];
  $content = $_POST['content'];
  
  if(isset($_POST['image'])){
    $image = $_POST['image'];
  }else{
    $image = '';
  }

  $sql = "select * from news where title = '$title'";
  $result = mysqli_query($conn, $sql);
  if (mysqli_num_rows($result) < 1) {
    $sql = "INSERT INTO news VALUES ('', '$title', '$image', '$content', Date(Now()))";
    $result = mysqli_query($conn, $sql);
    if ($result) {
      $response = array(
        'status' => 'success',
        'msg' => 'Thêm tin tức thành công.',
        'path' => "?controller=admin&action=news"
      );
      echo json_encode($response);
    } else {
      $response = array(
        'status' => 'error',
        'msg' => 'Thêm tin tức không thành công.',
        'path' => "?controller=admin&action=news"
      );
      echo json_encode($response);
    }
  } else {
    $response = array(
      'status' => 'error',
      'msg' => 'Tiêu đề tin tức đã tồn tại.',
      'path' => "?controller=admin&action=news"
    );
    echo json_encode($response);
  }

} else {
  $response = array(
    'status' => 'error',
    'msg' => 'Lỗi không thể thêm tin tức.',
    'path' => "?controller=admin&action=news"
  );
  echo json_encode($response);
}

$conn = null;