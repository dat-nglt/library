<?php

class userModel extends baseModel
{
  public function getAccount($taiKhoan)
  {
    $sql = "SELECT * FROM test WHERE username = '$taiKhoan';";
    $query = $this->_query($sql);
    return $query;
  }
};
?>