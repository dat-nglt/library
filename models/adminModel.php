<?php

class adminModel extends baseModel
{

  // User
  public function getAllUser($search)
  {
    if ($search != '') {
      $sql = "SELECT * FROM user WHERE (studentCode = '$search' OR fullName like '%$search%')";
    } else {
      $sql = "SELECT * FROM user";
    }
    $query = $this->_query($sql);
    return $query;
  }

  public function getListUser($start, $limit, $sort, $search)
  {
    if ($search != '') {
      $sql = "SELECT * FROM user WHERE (studentCode = '$search' OR fullName like '%$search%') ORDER BY id $sort LIMIT $start,$limit";
    } else {
      $sql = "SELECT * FROM user ORDER BY id $sort LIMIT $start,$limit";
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
    $sql = "INSERT INTO user VALUES ('', '$studentCode', '$password', '$fullName', '$dateOfBirth', '$address', '$phoneNumber', '$email', '$identificationNumber' , '', '$class')";
    $query = $this->_query($sql);
    return $query;
  }

  public function updateUser($id, $studentCode, $password, $fullName, $dateOfBirth, $address, $phoneNumber, $email, $identificationNumber, $class)
  {
    $sql = "UPDATE user SET studentCode = '$studentCode', password = '$password', fullName = '$fullName', dateOfBirth = '$dateOfBirth', address = '$address', phoneNumber = '$phoneNumber', email = '$email', identificationNumber = '$identificationNumber' , className = '$class' WHERE id = $id";
    $query = $this->_query($sql);
    return $query;
  }

  //Category

  public function getAllCategory($search)
  {
    $sql = "SELECT * FROM category WHERE nameCategory like '%$search%'";
    $query = $this->_query($sql);
    return $query;
  }

  public function getListCategory($start, $limit, $sort, $search)
  {
    $sql = "SELECT * FROM category WHERE nameCategory like '%$search%' ORDER BY idCategory $sort LIMIT $start,$limit";
    $query = $this->_query($sql);
    return $query;
  }

  public function checkCategoryWithName($categoryName)
  {
    $sql = "SELECT * FROM category WHERE nameCategory = '$categoryName'";
    $query = $this->_query($sql);
    return $query;
  }

  public function addCategory($name)
  {
    $sql = "INSERT INTO category VALUES ('','$name')";
    $query = $this->_query($sql);
    return $query;
  }

  public function checkCategoryWithId($categoryId)
  {
    $sql = "SELECT * FROM category WHERE idCategory = '$categoryId'";
    $query = $this->_query($sql);
    return $query;
  }

  public function updateCategory($id, $name)
  {
    $sql = "UPDATE category SET nameCategory = '$name' WHERE idCategory = $id";
    $query = $this->_query($sql);
    return $query;
  }

  // Book

  public function getAllBook($search, $category)
  {
    if ($category === 'all') {
      $sql = "SELECT * FROM book WHERE (nameBook LIKE '%$search%' or creatorBook like '%$search%' OR dateBook = '$search')";
    } else {
      $sql = "SELECT * FROM book WHERE (nameBook LIKE '%$search%' or creatorBook like '%$search%' OR dateBook = '$search') AND id_Category = '$category'";
    }
    $query = $this->_query($sql);
    return $query;
  }


  public function getListBook($start, $limit, $sort, $search, $category)
  {
    if ($category === 'all') {
      $sql = "SELECT b.*, c.nameCategory AS category FROM book AS b JOIN category AS c ON b.id_Category = c.idCategory WHERE b.nameBook LIKE '%$search%' or b.creatorBook like '%$search%' OR dateBook = '$search' ORDER BY b.idBook $sort LIMIT $start, $limit;";
    } else {
      $sql = "SELECT b.*, c.nameCategory AS category FROM book AS b JOIN category AS c ON b.id_Category = c.idCategory WHERE (b.nameBook LIKE '%$search%' OR b.creatorBook LIKE '%$search%' OR dateBook = '$search') AND b.id_Category = $category ORDER BY b.idBook $sort LIMIT $start, $limit;";
    }
    $query = $this->_query($sql);
    return $query;
  }

  //borrow

  public function getAllBorrow($search, $status)
  {
    if ($status === 'all') {
      $sql = "SELECT r.*, u.studentCode, u.identificationNumber, b.nameBook FROM request AS r 
        JOIN book AS b ON r.id_book = b.idBook JOIN user AS u ON r.id_User = u.id
        WHERE b.nameBook LIKE '%$search%' OR u.studentCode = '$search' OR u.identificationNumber = '$search'";
    }else{
      $sql = "SELECT r.*, u.studentCode, u.identificationNumber, b.nameBook FROM request AS r 
      JOIN book AS b ON r.id_book = b.idBook JOIN user AS u ON r.id_User = u.id
      WHERE (b.nameBook LIKE '%$search%' OR u.studentCode = '$search' OR u.identificationNumber = '$search') 
      AND r.statusRequest = '$status'";
    }
    $query = $this->_query($sql);
    return $query;
  }

  public function getListBorrow($start, $limit, $sort, $search, $status)
  {
    if ($status === 'all') {
      $sql = "SELECT r.*, u.studentCode, u.identificationNumber, b.nameBook FROM request AS r 
      JOIN book AS b ON r.id_book = b.idBook JOIN user AS u ON r.id_User = u.id
      WHERE b.nameBook LIKE '%$search%' OR u.studentCode = '$search' OR u.identificationNumber = '$search'
      ORDER BY r.idRequest $sort LIMIT $start, $limit;";
    } else {
      $sql = "SELECT r.*, u.studentCode, u.identificationNumber, b.nameBook FROM request AS r 
      JOIN book AS b ON r.id_book = b.idBook JOIN user AS u ON r.id_User = u.id
      WHERE (b.nameBook LIKE '%$search%' OR u.studentCode = '$search' OR u.identificationNumber = '$search') 
      AND r.statusRequest = '$status' ORDER BY r.idRequest $sort LIMIT $start, $limit;";
    }
    $query = $this->_query($sql);
    return $query;
  }

}
