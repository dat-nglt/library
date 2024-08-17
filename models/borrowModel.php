<?php

class borrowModel extends baseModel
{
//user đem qua

public function denyRequest($id)
{
  $sql = "UPDATE request, user
  SET request.statusRequest = 4
  WHERE (DATE(dateRequest) < DATE(NOW())) 
  AND (TIME(NOW()) > TIME(dateRequest))
  AND user.id = $id
  AND request.statusRequest = 0";
  $query = $this->_query($sql);
  return $query;
}

public function requestBook($idUser, $idBook)
{
  // $currentDateTime = date('Y-m-d H:i:s');
  $sql = "INSERT INTO request(dateRequest, id_User, id_Book) VALUES (NOW(), '$idUser', '$idBook')";
  $query = $this->_query($sql);
  return $query;
}

  //admin đem qua

  public function getAllBorrow($search, $status)
  {
    if ($status === 'all') {
      $sql = "SELECT r.*, u.studentCode, u.identificationNumber, b.nameBook FROM request AS r 
        JOIN book AS b ON r.id_book = b.idBook JOIN user AS u ON r.id_User = u.id
        WHERE b.nameBook LIKE '%$search%' OR u.studentCode = '$search' OR u.identificationNumber = '$search'";
    } else {
      $sql = "SELECT r.*, u.studentCode, u.identificationNumber, b.nameBook FROM request AS r 
      JOIN book AS b ON r.id_book = b.idBook JOIN user AS u ON r.id_User = u.id
      WHERE (b.nameBook LIKE '%$search%' OR u.studentCode = '$search' OR u.identificationNumber = '$search') 
      AND r.statusRequest = '$status'";
    }
    $query = $this->_query($sql);
    return $query;
  }

  public function denyRequests()
  {
    $sql = "UPDATE request
    SET statusRequest = 4
    WHERE (DATE(dateRequest) < DATE(NOW())) 
    AND (TIME(NOW()) > TIME(dateRequest))
    AND statusRequest = 0";
    $query = $this->_query($sql);
    return $query;
  }


  public function getListBorrow($start, $limit, $sort, $search, $status)
  {
    if ($status === 'all') {
      $sql = "SELECT r.*, u.studentCode, b.nameBook FROM request AS r 
      JOIN book AS b ON r.id_book = b.idBook JOIN user AS u ON r.id_User = u.id
      WHERE b.nameBook LIKE '%$search%' OR u.studentCode = '$search'
      ORDER BY r.idRequest $sort LIMIT $start, $limit;";
    } else {
      $sql = "SELECT r.*, u.studentCode, b.nameBook FROM request AS r 
      JOIN book AS b ON r.id_book = b.idBook JOIN user AS u ON r.id_User = u.id
      WHERE (b.nameBook LIKE '%$search%' OR u.studentCode = '$search') 
      AND r.statusRequest = '$status' ORDER BY r.idRequest $sort LIMIT $start, $limit;";
    }
    $query = $this->_query($sql);
    return $query;
  }

  public function checkUserBorrow($id)
  {
    $sql = "select * from request WHERE id_user = $id and statusRequest = '1'";
    $query = $this->_query($sql);
    return $query;
  }

  public function addBorrow($id, $book, $time, $dayReturn)
  {
    $sql = "INSERT INTO request VALUES ('', '$id', '$book', '$time', '1', '$time', '$dayReturn')";
    $query = $this->_query($sql);
    return $query;
  }

  public function editBorrow($idBorrow, $id, $book, $status, $timeBorrow, $timeReturn)
  {
    if ($timeBorrow != '') {
      $sql = "UPDATE request SET id_User = '$id', id_Book = '$book', statusRequest = '$status', dateRental = '$timeBorrow', dateReturn = '$timeReturn' where idRequest = '$idBorrow'";
    } else if ($timeReturn != '') {
      $sql = "UPDATE request SET id_User = '$id', id_Book = '$book', statusRequest = '$status', dateReturn = '$timeReturn' where idRequest = '$idBorrow'";
    } else {
      $sql = "UPDATE request SET id_User = '$id', id_Book = '$book', statusRequest = '$status' where idRequest = '$idBorrow'";
    }
    $query = $this->_query($sql);
    return $query;
  }
}