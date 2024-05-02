<?php

class userModel extends baseModel
{
  public function getAccount($taiKhoan)
  {
    $sql = "SELECT * FROM user WHERE username = '$taiKhoan';";
    $query = $this->_query($sql);
    return $query;
  }

  public function changePassword($taiKhoan, $newPassword)
  {
    $sql = "UPDATE  user SET password = $newPassword WHERE username = '$taiKhoan';";
    $query = $this->_query($sql);
    return $query;
  }

  public function uploadFile($upload_url, $fileName, $tacGia, $nhanDe, $email, $soDienThoai, $idUser)
  {
      $sql = "INSERT INTO upload(uploadURL, fileName, timeUpload, creatorUpload, titleUpload, EmailUpload, phoneNumberUpload, idUser) VALUES ('$upload_url',  '$fileName', NOW(), '$tacGia', '$nhanDe', '$email', '$soDienThoai', '$idUser')";
      $query = $this->_query($sql);
      return $query;
  }
}
;
?>