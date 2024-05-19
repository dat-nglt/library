<?php

class adminModel extends baseModel
{

  public function getAllUser($search) {
    if($search != ''){
      $sql = "SELECT * FROM user WHERE (studentCode = '$search' OR fullName like '%$search%')";
    }else{
      $sql = "SELECT * FROM user";
    }
    $query = $this->_query($sql);
    return $query;
  }

  public function getListUser($start,$limit,$sort,$search){
    if($search != ''){
      $sql = "SELECT * FROM user WHERE (studentCode = '$search' OR fullName like '%$search%') ORDER BY id $sort LIMIT $start,$limit";
    }else{
      $sql = "SELECT * FROM user ORDER BY id $sort LIMIT $start,$limit";
    }
   $query = $this->_query($sql);
  return $query;
}

  public function checkUserWithStudentCode($studentCode){
    $sql = "SELECT * FROM user WHERE studentCode = '$studentCode'";
    $query = $this->_query($sql);
    return $query;
  }

  public function checkUserWithIdentificationNumber($identificationNumber){
    $sql = "SELECT * FROM user WHERE identificationNumber = '$identificationNumber'";
    $query = $this->_query($sql);
    return $query;
  }

  public function checkUserWithId($id){
    $sql = "SELECT * FROM user WHERE id = $id";
    $query = $this->_query($sql);
    return $query;
  }

  public function addUser($studentCode, $password, $fullName, $dateOfBirth, $address, $phoneNumber, $email, $identificationNumber, $class){
    $sql = "INSERT INTO user VALUES ('', '$studentCode', '$password', '$fullName', '$dateOfBirth', '$address', '$phoneNumber', '$email', '$identificationNumber' , '', '$class')";
    $query = $this->_query($sql);
    return $query;
  }

}
?>