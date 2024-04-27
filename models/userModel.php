<?php

class userModel extends baseModel
{
  public function getAll()
  {
    $sql = "SELECT * FROM user;
        ";
    $query = $this->_query($sql);
    return $query;
  }
}
?>