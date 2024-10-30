<?php

class adminModel extends baseModel
{

  public function countBookInStock()
  {
    $sql = 'SELECT SUM(quantityBook) AS "count", category.nameCategory AS "nameCategory"
    FROM book
    JOIN category ON book.id_Category = category.idCategory
    GROUP BY book.id_Category, category.nameCategory;
    ';
    $query = $this->_query($sql);
    return $query;
  }

  public function countReader()
  {
    $sql = 'SELECT COUNT(*) AS "countReader", user.sex AS "gender" FROM user GROUP BY user.sex';
    $query = $this->_query($sql);
    return $query;
  }

  public function countRequest($yearChart = 2024, $statusRequest = null)
  {
    $sql = "SELECT COUNT(*) AS 'countRequest', MONTH(request.created_at) AS 'month', YEAR(request.created_at) AS 'year'
    FROM `request`
    WHERE YEAR(request.created_at) = $yearChart";
    $sql .= !isset($statusRequest) || $statusRequest === "all" ? "" : " AND request.statusRequest = $statusRequest";

    $sql .= "  GROUP BY MONTH(request.created_at)";

    $query = $this->_query($sql);
    return $query;
  }

  // User
  public function getAllUser($search)
  {
    if ($search != '') {
      $sql = "SELECT * FROM user WHERE (studentCode = '$search' OR fullName like '%$search%') AND roleAccess IN (0,1)";
    } else {
      $sql = "SELECT * FROM user WHERE roleAccess IN (0,1)";
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

  //borrow

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

  public function denyRequest()
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

  public function getAllFine($search)
  {
    $sql = "SELECT rd.*, u.studentCode, u.fullName, f.* FROM request_detail AS rd
    LEFT JOIN request AS r ON r.idRequest = rd.id_Request LEFT JOIN user AS u ON r.id_User = u.id
    JOIN fine as f On f.id_RequestDetail  = rd.idRequestDetail WHERE u.studentCode like '%$search%'";
    $query = $this->_query($sql);
    return $query;
  }

  public function getListFine($start, $limit, $sort, $search)
  {
    $sql = "SELECT rd.*, u.studentCode, u.fullName, f.*, b.nameBook FROM request_detail AS rd
    LEFT JOIN book AS b ON rd.id_book = b.idBook LEFT JOIN request AS r ON r.idRequest = rd.id_Request LEFT JOIN user AS u ON r.id_User = u.id
    JOIN fine as f On f.id_RequestDetail  = rd.idRequestDetail WHERE u.studentCode like '%$search%' ORDER BY f.idFine DESC LIMIT $start, $limit";
    $query = $this->_query($sql);
    return $query;
  }

  public function getListRequest()
  {
    $sql = "SELECT r.id_User, b.idBook, b.nameBook, rd.idRequestDetail, DATEDIFF(NOW(), rd.due_date) AS totalDay FROM request_detail AS rd
    LEFT JOIN book AS b ON rd.id_book = b.idBook LEFT JOIN request AS r ON r.idRequest = rd.id_Request LEFT JOIN user AS u ON r.id_User = u.id
    LEFT JOIN fine as f On f.id_RequestDetail  = rd.idRequestDetail WHERE rd.status IN (1,3)";
    $query = $this->_query($sql);
    return $query;
  }

  public function getListFineOfUser()
  {
    $sql = "SELECT u.id, u.studentCode, u.fullName FROM request_detail AS rd
    LEFT JOIN request AS r ON r.idRequest = rd.id_Request LEFT JOIN user AS u ON u.id = r.id_User WHERE rd.status IN (1,3) GROUP BY u.id;";
    $query = $this->_query($sql);
    return $query;
  }

  public function getAllReport()
  {
    $sql = "SELECT * FROM report";
    $query = $this->_query($sql);
    return $query;
  }

  public function getReport($id)
  {
    $sql = "SELECT * FROM report WHERE id = $id"; // Truy vấn
    $query = $this->_query($sql); // Thực hiện truy vấn

    // Kiểm tra xem có kết quả không
    if ($query) {
      $data = []; // Khởi tạo mảng để chứa kết quả
      while ($row = mysqli_fetch_assoc($query)) {
        $data[] = $row; // Thêm từng dòng vào mảng
      }
      return $data; // Trả về mảng kết quả
    }

    return null; // Nếu không có kết quả nào, trả về null
  }
  public function getListReport($start, $limit, $sort, $search)
  {
    $sql = "SELECT * FROM report AS r WHERE r.name LIKE '%$search%' OR r.email like '%$search%' OR r.tel like '%$search%' OR r.description like '%$search%' OR timeReport = '$search' ORDER BY r.id $sort LIMIT $start, $limit;";
    $query = $this->_query($sql);
    return $query;
  }
  public function getAllNews($search)
  {
    $sql = "SELECT * FROM news WHERE title like '%$search%'";
    $query = $this->_query($sql);
    return $query;
  }
  public function getListNews($start, $limit, $sort, $search)
  {
    $sql = "SELECT * FROM news WHERE title like '%$search%' ORDER BY id $sort LIMIT $start,$limit ";
    $query = $this->_query($sql);
    return $query;
  }
}
