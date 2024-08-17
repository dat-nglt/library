<?php

class punishModel extends baseModel
{
  //user đem qua

  public function listAllRentBook($idUser, $sortListRentBook, $searchListRentBook)
  {
    $sql = "SELECT idRequest, id_User, id_Book, dateRequest, dateRental, dateReturn, book.nameBook, book.publisherBook, statusRequest FROM request,
    book, user WHERE request.id_User = user.id AND request.id_Book = book.idBook AND user.id = $idUser";

    $sql .= $searchListRentBook
      ? " AND book.nameBook like '%$searchListRentBook%' ORDER BY book.nameBook $sortListRentBook"
      : " ORDER BY book.nameBook $sortListRentBook";

    $query = $this->_query($sql);
    return $query;
  }

  public function listRentBook($idUser, $sortListRentBook, $searchListRentBook, $start, $limit)
  {
    $sql = "SELECT idRequest, id_User, id_Book, dateRequest, dateRental, dateReturn, book.nameBook, book.publisherBook, statusRequest FROM request,
    book, user WHERE request.id_User = user.id AND request.id_Book = book.idBook AND user.id = $idUser";

    $sql .= $searchListRentBook
      ? " AND book.nameBook like '%$searchListRentBook%' ORDER BY request.dateRequest $sortListRentBook LIMIT $start, $limit"
      : " ORDER BY request.dateRequest $sortListRentBook LIMIT $start, $limit";

    $query = $this->_query($sql);
    return $query;
  }

  //admin đem qua

  public function getAllPunish($start, $limit, $sort)
  {
    if ($sort === 'DESC') {
      $sql = "SELECT r.*, u.studentCode, u.fullName, p.* FROM request AS r 
    LEFT JOIN book AS b ON r.id_book = b.idBook LEFT JOIN user AS u ON r.id_User = u.id
    JOIN punish as p On p.id_Request = r.idRequest ORDER BY idPunish DESC LIMIT $start, $limit";
    } else {
      $sql = "SELECT r.*, u.studentCode, u.fullName, p.* FROM request AS r 
    LEFT JOIN book AS b ON r.id_book = b.idBook LEFT JOIN user AS u ON r.id_User = u.id
    JOIN punish as p On p.id_Request = r.idRequest ORDER BY idPunish LIMIT $start, $limit";
    }
    $query = $this->_query($sql);
    return $query;
  }

  public function getPunish()
  {
    $sql = "SELECT r.*, u.studentCode, u.fullName, p.* FROM request AS r 
    LEFT JOIN book AS b ON r.id_book = b.idBook LEFT JOIN user AS u ON r.id_User = u.id
    JOIN punish as p On p.id_Request = r.idRequest";

    $query = $this->_query($sql);
    return $query;
  }
}
