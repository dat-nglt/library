<?php

class accountModel extends baseModel
{
  //user đem qua

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
  
  

  //admin đem qua 
  public function getAllUser($search)
  {
    if ($search != '') {
      $sql = "SELECT * FROM user WHERE (studentCode = '$search' OR fullName like '%$search%') AND roleAccess IN (0,1)";
    } else {
      $sql = "SELECT * FROM user";
    }
    $query = $this->_query($sql);
    return $query;
  }

  public function getListUser($start, $limit, $sort, $search)
  {
    if ($search != '') {
      $sql = "SELECT * FROM user WHERE (studentCode = '$search' OR fullName like '%$search%') AND roleAccess IN (0,1) ORDER BY id $sort LIMIT $start,$limit ";
    } else {
      $sql = "SELECT * FROM user where roleAccess IN (0,1) ORDER BY id $sort LIMIT $start,$limit";
    }
    $query = $this->_query($sql);
    return $query;
  }

  public function checkUserWithStudentCode($studentCode)
  {
    $sql = "SELECT * FROM user WHERE studentCode = '$studentCode'";
    $query = $this->_query($sql);
    return $query;
  }

  public function checkUserWithIdentificationNumber($identificationNumber)
  {
    $sql = "SELECT * FROM user WHERE identificationNumber = '$identificationNumber'";
    $query = $this->_query($sql);
    return $query;
  }

  public function checkUserWithId($id)
  {
    $sql = "SELECT * FROM user WHERE id = $id";
    $query = $this->_query($sql);
    return $query;
  }

  public function addUser($studentCode, $password, $fullName, $dateOfBirth, $address, $phoneNumber, $email, $identificationNumber, $class)
  {
    $sql = "INSERT INTO user VALUES ('', '$studentCode', '$password', '$fullName', '$dateOfBirth', '$address', '$phoneNumber', '$email', '$identificationNumber' , '1', '$class')";
    $query = $this->_query($sql);
    return $query;
  }

  public function updateUser($id, $studentCode, $password, $fullName, $dateOfBirth, $address, $phoneNumber, $email, $identificationNumber, $class)
  {
    if ($password != '') {
      $sql = "UPDATE user SET studentCode = '$studentCode', password = '$password', fullName = '$fullName', dateOfBirth = '$dateOfBirth', address = '$address', phoneNumber = '$phoneNumber', email = '$email', identificationNumber = '$identificationNumber' , className = '$class' WHERE id = $id";
    } else {
      $sql = "UPDATE user SET studentCode = '$studentCode', fullName = '$fullName', dateOfBirth = '$dateOfBirth', address = '$address', phoneNumber = '$phoneNumber', email = '$email', identificationNumber = '$identificationNumber' , className = '$class' WHERE id = $id";
    }
    $query = $this->_query($sql);
    return $query;
  }

  
  // librarian
  public function getAllLibrarian($search)
  {
    $sql = "SELECT * FROM user WHERE fullName like '%$search%' AND roleAccess IN (2,4)";
    $query = $this->_query($sql);
    return $query;
  }

  public function getListLibrarian($start, $limit, $sort, $search)
  {
    $sql = "SELECT * FROM user WHERE fullName like '%$search%' AND roleAccess IN (2,4) ORDER BY id $sort LIMIT $start,$limit ";
    $query = $this->_query($sql);
    return $query;
  }

  public function checkLibrarianWithUsername($studentCode)
  {
    $sql = "SELECT * FROM user WHERE studentCode = '$studentCode' AND roleAccess IN (2,4)";
    $query = $this->_query($sql);
    return $query;
  }

  public function checkLibrarianWithId($id)
  {
    $sql = "SELECT * FROM user WHERE id = $id AND roleAccess IN (2,4)";
    $query = $this->_query($sql);
    return $query;
  }

  public function addLibrarian($username, $password, $fullName, $phoneNumber, $email, $class)
  {
    $sql = "INSERT INTO user VALUES ('', '$username', '$password', '$fullName', '', '', '$phoneNumber', '$email', '' , '2', '$class')";
    $query = $this->_query($sql);
    return $query;
  }

  public function updateLibrarian($id, $username, $password, $fullName, $phoneNumber, $email, $class)
  {
    if ($password != '') {
      $sql = "UPDATE user SET studentCode = '$username', password = '$password', fullName = '$fullName', phoneNumber = '$phoneNumber', email = '$email', className = '$class' WHERE id = $id";
    } else {
      $sql = "UPDATE user SET studentCode = '$username', fullName = '$fullName', phoneNumber = '$phoneNumber', email = '$email', className = '$class' WHERE id = $id";
    }
    $query = $this->_query($sql);
    return $query;
  }
}
