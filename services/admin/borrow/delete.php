<?php

require_once '../../databaseUsingAjax.php';

if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    parse_str(file_get_contents("php://input"), $_DELETE);
    $id = $_DELETE['id'];
    $sql = "delete from request where idRequest = '$id'";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        $response = array(
            'status' => 'success',
            'msg' => 'Xóa thành công',
            'path' => "?controller=admin&action=borrow"
        );
        echo json_encode($response);
    } else {
        $response = array(
            'status' => 'error',
            'msg' => 'Xóa không thành công',
            'path' => "?controller=admin&action=borrow"
        );
        echo json_encode($response);
    }

} else {
    echo "Phương thức không được hỗ trợ.";
}

$conn = null;