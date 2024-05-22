<?php

require_once '../../databaseUsingAjax.php';

if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    parse_str(file_get_contents("php://input"), $_DELETE);
    $id = $_DELETE['id'];
    $sql = "select * from book where id_Category = $id";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        $response = array(
            'status' => 'warning',
            'msg' => 'Vui lòng đảm bảo không còn sách thuộc thể loại này',
            'path' => "?controller=admin&action=category"
        );
        echo json_encode($response);
    } else {
        if (mysqli_num_rows($result) === '') {
            $sql = "delete from category where idCategory  = '$id'";
            $result = mysqli_query($conn, $sql);
            if ($result) {
                $response = array(
                    'status' => 'success',
                    'msg' => 'Xóa thành công',
                    'path' => "?controller=admin&action=category"
                );
                echo json_encode($response);
            } else {
                $response = array(
                    'status' => 'error',
                    'msg' => 'Xóa không thành công',
                    'path' => "?controller=admin&action=category"
                );
                echo json_encode($response);
            }
        } else {
            $sql = "delete from category where idCategory  = '$id'";
            $result = mysqli_query($conn, $sql);
            if ($result) {
                $response = array(
                    'status' => 'success',
                    'msg' => 'Xóa thành công',
                    'path' => "?controller=admin&action=category"
                );
                echo json_encode($response);
            } else {
                $response = array(
                    'status' => 'error',
                    'msg' => 'Xóa không thành công',
                    'path' => "?controller=admin&action=category"
                );
                echo json_encode($response);
            }
        }
    }

} else {
    echo "Phương thức không được hỗ trợ.";
}

$conn = null;