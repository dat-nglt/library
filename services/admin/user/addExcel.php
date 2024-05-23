<?php

require_once '../../databaseUsingAjax.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fileData = $_POST['file_data'];
    $part1 = array_shift($fileData);
    $part2 = $fileData;
    $columns = implode(", ", $part1);
    foreach ($part2 as $key => $data) {
        $values = "'" . implode("', '", $data) . "'";
        $sql = "INSERT INTO user ($columns) VALUES ($values)";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            $response = array(
                'status' => 'success',
                'msg' => "Nhập dữ liệu thành công",
                'path' => "?controller=admin&action=account"
            );
            echo json_encode($response);
        } else {
            $response = array(
                'status' => 'error',
                'msg' => "Nhập dữ liệu từ dòng $key của không thành công.",
                'path' => "?controller=admin&action=account"
            );
            echo json_encode($response);
        }
    }

} else {
    echo "Phương thức không được hỗ trợ.";
}

$conn = null;