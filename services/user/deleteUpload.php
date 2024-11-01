<?php

require_once '../databaseUsingAjax.php';

if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    parse_str(file_get_contents("php://input"), $_DELETE);
    $idUpload = $_DELETE['id'];
    $sql = "DELETE FROM upload WHERE idUpload = ?";

    // Prepare and execute the statement
    if ($stmt = mysqli_prepare($conn, $sql)) {
        mysqli_stmt_bind_param($stmt, 'i', $idUpload); // Assuming idUpload is an integer
        $result = mysqli_stmt_execute($stmt);

        // Check if the deletion was successful
        if ($result && mysqli_stmt_affected_rows($stmt) > 0) {
            $response = array(
                'status' => 'success',
                'msg' => 'Xóa thành công',
                'path' => "?controller=user&action=upload"
            );
        } else {
            $response = array(
                'status' => 'error',
                'msg' => 'Xóa không thành công',
                'path' => "?controller=user&action=upload"
            );
        }

        // Close the statement
        mysqli_stmt_close($stmt);
    } else {
        // Handle SQL preparation error
        $response = array(
            'status' => 'error',
            'msg' => 'Lỗi chuẩn bị truy vấn',
            'path' => "?controller=user&action=upload"
        );
    }

    // Output the response in JSON format
    echo json_encode($response);
}

// Close the database connection
mysqli_close($conn);