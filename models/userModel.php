<?php

class userModel extends baseModel
{
  public function getAccount($taiKhoan)
  {
    $sql = "SELECT * FROM user WHERE studentCode = '$taiKhoan';";
    $query = $this->_query($sql);
    return $query;
  }

  public function changePassword($id, $newPassword)
  {
    $sql = "UPDATE `user` SET `password` = '$newPassword' WHERE `user`.`id` = $id;";
    $query = $this->_query($sql);
    return $query;
  }

  public function uploadFile($upload_url, $tacGia, $nhanDe, $email, $loaiTaiLieu, $idUser)
  {
    $sql = "INSERT INTO upload(uploadURL, timeUpload, creatorUpload, titleUpload, EmailUpload, typeUpload, idUser, idBook) VALUES ('$upload_url', NOW(), '$tacGia', '$nhanDe', '$email', '$loaiTaiLieu', '$idUser', Null)";
    $query = $this->_query($sql);
    return $query;
  }

  public function uploadData($idUser)
  {
    $sql = "SELECT * FROM upload WHERE idUser = '$idUser'";
    $query = $this->_query($sql);
    return $query;
  }

  public function getOneBook($id)
  {
    $sql = "SELECT * FROM book LEFT JOIN upload ON book.idBook = upload.idBook WHERE book.idBook = '$id'";
    $query = $this->_query($sql);
    return $query;
  }
}
;
?>