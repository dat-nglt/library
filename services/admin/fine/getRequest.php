<?php
require_once '../../databaseUsingAjax.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $idUser = $_POST['id'];
  $sql = "SELECT sanpham.moTa FROM sanpham WHERE sanpham.maSanPham = $maSanPham";
  $result = mysqli_fetch_row(mysqli_query($conn, $sql));
  $data = $result ? $result : [];
  $response = array(
    'data' => $result,
  );
  echo json_encode($response);
}