<?php

class bookModel extends baseModel
{
 //user đem qua

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


  //upload user

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


  //admin đem qua

  public function getAllBookAdmin($search, $category)
  {
    if ($category === 'all') {
      $sql = "SELECT * FROM book WHERE (nameBook LIKE '%$search%' or creatorBook like '%$search%' OR dateBook = '$search')";
    } else {
      $sql = "SELECT * FROM book WHERE (nameBook LIKE '%$search%' or creatorBook like '%$search%' OR dateBook = '$search') AND id_Category = '$category'";
    }
    $query = $this->_query($sql);
    return $query;
  }

  public function getNameBook()
  {
    $sql = "SELECT * FROM book";
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

  public function minusCountBook($id)
  {
    $sql = "UPDATE book set quantityBook = quantityBook - 1 where idBook = '$id'";
    $query = $this->_query($sql);
    return $query;
  }

  public function plusCountBook($id)
  {
    $sql = "UPDATE book set quantityBook = quantityBook + 1 where idBook = '$id'";
    $query = $this->_query($sql);
    return $query;
  }


  // upload

  public function getAllUpload($search, $category)
  {
    if ($category === 'all') {
      $sql = "SELECT upload.*, book.nameBook, book.creatorBook, book.dateBook, user.studentCode, user.fullName, category.nameCategory FROM upload 
    LEFT JOIN user ON upload.id_User = user.id
    LEFT JOIN category ON upload.id_Category = category.idCategory
    LEFT JOIN book ON upload.id_Book = book.idBook WHERE (upload.titleUpload LIKE '%$search%' OR user.studentCode LIKE '%$search%' OR  upload.titleUpload  LIKE '%$search%')";
    } else {
      $sql = "SELECT upload.*, book.nameBook, book.creatorBook, book.dateBook, user.studentCode, user.fullName, category.nameCategory FROM upload 
    LEFT JOIN user ON upload.id_User = user.id
    LEFT JOIN category ON upload.id_Category = category.idCategory
    LEFT JOIN book ON upload.id_Book = book.idBook WHERE (upload.titleUpload LIKE '%$search%' OR user.studentCode LIKE '%$search%' OR upload.titleUpload  LIKE '%$search%') AND upload.id_Category = '$category'";
    }
    $query = $this->_query($sql);
    return $query;
  }

  public function getListUpload($start, $limit, $sort, $search, $category)
  {
    if ($category === 'all') {
      $sql = "SELECT upload.*, book.nameBook, book.creatorBook, book.dateBook, user.studentCode, user.fullName, category.nameCategory FROM upload 
    LEFT JOIN user ON upload.id_User = user.id
    LEFT JOIN category ON upload.id_Category = category.idCategory
    LEFT JOIN book  ON upload.id_Book = book.idBook WHERE (upload.titleUpload LIKE '%$search%' OR user.studentCode LIKE '%$search%' OR upload.timeUpload = '$search') ORDER BY idUpload $sort LIMIT $start, $limit;";
    } else {
      $sql = "SELECT upload.*, book.nameBook, book.creatorBook, book.dateBook, user.studentCode, user.fullName, category.nameCategory  FROM upload  
    LEFT JOIN user ON upload.id_User = user.id
    LEFT JOIN category ON upload.id_Category = category.idCategory
    LEFT JOIN book ON upload.id_Book = book.idBook WHERE (upload.titleUpload LIKE '%$search%' OR user.studentCode LIKE '%$search%' OR upload.timeUpload = '$search') AND upload.id_Category = '$category' ORDER BY idUpload $sort LIMIT $start, $limit;";
    }
    $query = $this->_query($sql);
    return $query;
  }

 

}