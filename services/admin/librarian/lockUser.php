<?php

require_once '../../databaseUsingAjax.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $sql = "select * from user where id = $id";
    $result = mysqli_query($conn, $sql);
    if($result){
        $roleAccess = mysqli_fetch_assoc($result)['roleAccess'];
        if($roleAccess === '2'){
            $lock = '4';
        }else{
            $lock = '2';
        }
        $sql = "update user set roleAccess = $lock where id = $id";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            if($lock === '4'){
                $response = array(
                    'status' => 'success',
                    'msg' => 'Khóa tài khoản thành công.',
                    'path' => "?controller=admin&action=librarian"
                );
                echo json_encode($response);
            }else{
                $response = array(
                    'status' => 'success',
                    'msg' => 'Mở khóa tài khoản thành công.',
                    'path' => "?controller=admin&action=librarian"
                );
                echo json_encode($response);
            }
        } else {
        $response = array(
            'status' => 'error',
            'msg' => 'Thay đổi trạng thái không thành công.',
            'path' => "?controller=admin&action=librarian"
        );
        echo json_encode($response);
        }
    }
    

} else {
  echo "Phương thức không được hỗ trợ.";
}

$conn = null;