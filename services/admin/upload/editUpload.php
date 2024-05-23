<?php

require_once '../../databaseUsingAjax.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $id_Book = $_POST['id_Book'];
    if ($id_Book == '') {
        $sql = "UPDATE upload SET id_Book = NULL WHERE idUpload = '$id'";
    } else {
        $sql = "UPDATE upload SET id_Book = '$id_Book' WHERE idUpload = '$id'";
    }
    $result = mysqli_query($conn, $sql);
    if ($result) {
        $response = array(
            'status' => 'success',
            'msg' => 'Duyệt thành công',
            'path' => "?controller=admin&action=upload"
        );
        echo json_encode($response);
    } else {
        $response = array(
            'status' => 'error',
            'msg' => 'Duyệt không thành công',
            'path' => "?controller=admin&action=upload"
        );
        echo json_encode($response);
    }
}

$conn = null;