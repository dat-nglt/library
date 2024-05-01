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
}
;
?>