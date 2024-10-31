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

  public function getAllBook($limit = null)
  {
    $sql = "SELECT * FROM book LEFT JOIN upload ON book.idBook = upload.id_Book";

    if (isset($limit)) {
      $sql .= " LIMIT " . $limit;
    }

    $query = $this->_query($sql);
    return $query;
  }

  public function getAllNews($limit = null)
  {
    $sql = "SELECT * FROM news ORDER BY date desc";

    if (isset($limit)) {
      $sql .= " LIMIT " . $limit;
    }
    $query = $this->_query($sql);
    return $query;
  }
  public function getNews($id)
  {
    $sql = "SELECT * FROM news WHERE id = '$id'";
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
  public function newsSearch($contentSearch, $sortSearch, $dateSearch)
  {
    if ($contentSearch != '') {
      $sql = "SELECT *
        FROM news
        WHERE 
            title LIKE '%$contentSearch%'
            OR date = '$dateSearch'
        ORDER BY
            date $sortSearch
        ";
    } elseif ($dateSearch == '') {
      $sql = "SELECT *
        FROM news
        ORDER BY
            date $sortSearch
        ";
    } else {
      $sql = "SELECT *
        FROM news
        WHERE 
          date = '$dateSearch'
        ORDER BY
            date $sortSearch
        ";
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

  // public function denyRequest($id)
  // {
  //   $sql = "UPDATE request, user
  //   SET request.statusRequest = 4
  //   WHERE (DATE(dateRequest) < DATE(NOW())) 
  //   AND (TIME(NOW()) > TIME(dateRequest))
  //   AND user.id = $id
  //   AND request.statusRequest = 0";
  //   $query = $this->_query($sql);
  //   return $query;
  // }

  public function requestBooks($idUser, $status)
  {
    // Thực hiện câu lệnh INSERT
    $sql = "INSERT INTO request(created_at, id_User, statusRequest) VALUES (NOW(), '$idUser', '$status')";
    $this->_query($sql);

    // Lấy ID của bản ghi vừa được thêm
    $result = $this->_query("SELECT LAST_INSERT_ID() AS id");
    $row = $result->fetch_assoc(); // Dùng fetch_assoc() để lấy kết quả
    $lastId = $row['id']; // Lấy giá trị ID

    return $lastId; // Trả về ID
  }


  public function requestBookDetail($idBook, $idRequest)
  {
    // $currentDateTime = date('Y-m-d H:i:s');
    $sql = "INSERT INTO request_detail(created_at, id_Book, id_Request, quantity, statusRD) VALUES (NOW(), '$idBook', '$idRequest', 1, '')";
    $query = $this->_query($sql);
    return $query;
  }

  public function getRequestedBooks($idUser)
  {
    $sql = "SELECT rd.id_Book FROM request r 
            JOIN request_detail rd ON r.idRequest = rd.id_Request 
            WHERE r.id_User = '$idUser' AND r.statusRequest IN (0,1,3)";
    $result = $this->_query($sql);

    $books = [];
    while ($row = $result->fetch_assoc()) {
      $books[] = $row['id_Book'];
    }
    return $books;
  }

  public function decreaseBookStock($bookId)
  {
    $sql = "UPDATE book SET quantityBook = quantityBook - 1 WHERE idBook = '$bookId' AND quantityBook > 0";
    return $this->_query($sql);
  }

  public function increaseBookStock($bookId)
  {
    $sql = "UPDATE book SET quantityBook = quantityBook + 1 WHERE idBook = '$bookId'";
    return $this->_query($sql);
  }

  public function listAllRentBook($idUser, $sortListRentBook, $searchListRentBook, $statusRent)
  {
    $sql = "SELECT 
    request.idRequest,
    request_detail.id_Book,
    book.nameBook,
    book.creatorBook,
    request.statusRequest,
    request.id_User,
    request.created_at,
    request_detail.return_date
    FROM 
        request
    LEFT JOIN 
        request_detail ON request.idRequest = request_detail.id_Request
    LEFT JOIN
        book ON request_detail.id_Book = book.idBook
    LEFT JOIN
        user ON request.id_User = user.id
    WHERE 
        request.id_User = $idUser
    ";

    $sql .= $statusRent === "all" ? "" : " AND request.statusRequest = $statusRent";

    $sql .= $searchListRentBook
      ? " AND book.nameBook like '%$searchListRentBook%' ORDER BY request.created_at $sortListRentBook"
      : " ORDER BY request.created_at $sortListRentBook";

    $query = $this->_query($sql);
    return $query;
  }

  public function listRentBook($idUser, $sortListRentBook, $searchListRentBook, $statusRent, $start, $limit)
  {
    $sql = "SELECT 
    request.idRequest,
    request_detail.id_Book,
    book.nameBook,
    book.creatorBook,
    request.statusRequest,
    request.id_User,
    request.created_at,
    request_detail.return_date
    FROM 
        request
    LEFT JOIN 
        request_detail ON request.idRequest = request_detail.id_Request
    LEFT JOIN
        book ON request_detail.id_Book = book.idBook
    LEFT JOIN
        user ON request.id_User = user.id
    WHERE 
        request.id_User = $idUser
    ";

    $sql .= $statusRent === "all" ? "" : " AND request.statusRequest = $statusRent";


    $sql .= $searchListRentBook
      ? " AND book.nameBook like '%$searchListRentBook%' ORDER BY request.created_at $sortListRentBook LIMIT $start, $limit"
      : " ORDER BY request.created_at $sortListRentBook LIMIT $start, $limit";

    $query = $this->_query($sql);
    return $query;
  }

  public function addReport($name, $email, $tel, $des)
  {
    $sql = "INSERT INTO report( name, email, tel, description, timeReport ) VALUES ('$name', '$email', '$tel', '$des',NOW())";
    $query = $this->_query($sql);
    return $query;
  }
}
?>