<?php

require_once '../../databaseUsingAjax.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idUser = $_SESSION['user']['id'];
    $name = $_POST['name'];
    $book = $_POST['book'];
    $category = $_POST['category'];
    $uploadURL = $_POST['uploadURL'];

    $sql = "INSERT INTO upload(uploadURL, timeUpload, titleUpload, id_User, id_Book, id_Category) VALUES ('$uploadURL', NOW(), '$name', '$idUser', '$book', '$category')";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        $response = array(
            'status' => 'success',
            'msg' => 'Tải lên thành công.',
            'path' => "?controller=admin&action=upload"
        );
        echo json_encode($response);
    } else {
        $response = array(
            'status' => 'error',
            'msg' => 'Tải lên không thành công.',
            'path' => "?controller=admin&action=upload"
        );
        echo json_encode($response);
    }
}

$conn = null;