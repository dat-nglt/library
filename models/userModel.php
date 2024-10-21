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

  public function uploadFile($upload_url, $nhanDe, $loaiTaiLieu, $idUser)
  {
    $sql = "INSERT INTO upload(uploadURL, timeUpload, titleUpload, id_User, id_Book, id_Category) VALUES ('$upload_url', NOW(), '$nhanDe', '$idUser', Null, '$loaiTaiLieu')";
    $query = $this->_query($sql);
    return $query;
  }

  public function uploadData($idUser)
  {
    $sql = "SELECT upload.*, book.nameBook, book.creatorBook, book.dateBook, user.studentCode, user.fullName, category.nameCategory FROM upload 
    LEFT JOIN user ON upload.id_User = user.id
    LEFT JOIN category ON upload.id_Category = category.idCategory
    LEFT JOIN book ON upload.id_Book = book.idBook WHERE id_User = '$idUser'";
    $query = $this->_query($sql);
    return $query;
  }

  public function getDataType()
  {
    $sql = "SELECT * FROM category";
    $query = $this->_query($sql);
    return $query;
  }

  public function getAllBook()
  {
    $sql = "SELECT * FROM book LEFT JOIN upload ON book.idBook = upload.id_Book";
    $query = $this->_query($sql);
    return $query;
  }

  public function searchBooks($contentSearch, $optionSearch)
  {
    if ($optionSearch == 'all') {
      $sql = "SELECT book.*, category.idCategory, category.nameCategory
      FROM book
      INNER JOIN category ON book.id_Category = category.idCategory
      WHERE 
          category.nameCategory LIKE '%$contentSearch%' 
          OR book.nameBook LIKE '%$contentSearch%'
          OR book.creatorBook LIKE '%$contentSearch%'
          OR book.publisherBook LIKE '%$contentSearch%'
          OR book.dateBook LIKE '%$contentSearch%'
      ";
    } else {
      $sql = "SELECT *, category.idCategory, category.nameCategory FROM book, category WHERE book.id_Category = category.idCategory AND $optionSearch LIKE '%$contentSearch%'";
    }
    $query = $this->_query($sql);
    return $query;
  }

  public function getOneBook($id)
  {
    $sql = "SELECT book.*, upload.*, category.*
    FROM book
    LEFT JOIN upload ON book.idBook = upload.id_Book
    LEFT JOIN category ON book.id_Category = category.idCategory
    WHERE book.idBook = '$id';";
    $query = $this->_query($sql);
    return $query;
  }

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
  public function addReport( $name, $email, $tel, $des)
  {
    $sql = "INSERT INTO report( name, email, tel, description, timeReport ) VALUES ('$name', '$email', '$tel', '$des',NOW())";
    $query = $this->_query($sql);
    return $query;
  }
}
?>