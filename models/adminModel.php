<?php

class adminModel extends baseModel
{
  public function getAll()
  {
    $sql = "SELECT * FROM user;
        ";
    $query = $this->_query($sql);
    return $query;
  }

  public function checkAccount($taiKhoan) {
    // $sql = "SELECT * FROM user
  }
}
?>