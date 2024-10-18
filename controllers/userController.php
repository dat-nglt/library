<?php

class userController extends baseController
{
  private $userModel;

  public function __construct()
  {
    $this->loadModel('userModel');
    $this->userModel = new userModel;

  }
  public function index()
  {

    $books = $this->userModel->getAllBook();

    $componentName = 'homeHotBook';
    if (isset($_SESSION['user'])) {
      $this->userModel->denyRequest($_SESSION['user']['id']); //hủy yêu cầu sau 24h
    }
    return $this->loadview('user.home', ['componentName' => $componentName, 'componentDatas' => $books]);
  }

  public function contact()
  {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $name = $_POST['name'];
      $email = $_POST['email'];
      $tel = $_POST['email'];
      $des = $_POST['des'];
      $this->userModel->addReport($name, $email, $tel, $des);
    }
    return $this->loadview('user.contact', []);
  }
  public function bookHot()
  {
    $books = $this->userModel->getAllBook();

    $componentName = 'homeHotBook';
    $this->loadview('user.home', ['componentName' => $componentName, 'componentDatas' => $books]);
  }

  public function rentSticket()
  {
    $this->loadview(viewPath: 'user.rentSticket');
  }

  public function newshot()
  {
    $news = [
      [
        'image' => './upload/check-in.png',
        'title' => 'Hướng Dẫn Check-In Khi Đến Thư Viện',
        'author' => 'Trương Văn Đạt',
        'views' => 2601,
        'date' => '26/01/2024',
        'content' => 'Hướng dẫn sinh viên, viên chức của trường Check-In khi đến sử dụng thư viện'
      ],
      [
        'image' => './upload/check-in.png',
        'title' => 'Hướng Dẫn Check-In Khi Đến Thư Viện',
        'author' => 'Trương Văn Đạt',
        'views' => 2601,
        'date' => '26/01/2024',
        'content' => 'Hướng dẫn sinh viên, viên chức của trường Check-In khi đến sử dụng thư viện'
      ],
      [
        'image' => './upload/check-in.png',
        'title' => 'Hướng Dẫn Check-In Khi Đến Thư Viện',
        'author' => 'Trương Văn Đạt',
        'views' => 2601,
        'date' => '26/01/2024',
        'content' => 'Hướng dẫn sinh viên, viên chức của trường Check-In khi đến sử dụng thư viện'
      ],
      [
        'image' => './upload/check-in.png',
        'title' => 'Hướng Dẫn Check-In Khi Đến Thư Viện',
        'author' => 'Trương Văn Đạt',
        'views' => 2601,
        'date' => '26/01/2024',
        'content' => 'Hướng dẫn sinh viên, viên chức của trường Check-In khi đến sử dụng thư viện'
      ],
    ];
    $componentName = 'homeHotNews';
    return $this->loadview('user.home', ['componentName' => $componentName, 'componentDatas' => $news]);
  }


  public function login()
  {

    if (isset($_POST["login"])) {
      $taiKhoan = $_POST["taiKhoan"];
      $matKhau = $_POST["matKhau"];
      $result = mysqli_fetch_assoc($this->userModel->getAccount($taiKhoan));
      // if ($result && password_verify($matKhau, $result['password'])) {
      if (true) {
        $_SESSION['user'] = $result;
        if ($_SESSION['user']['roleAccess'] == 1) {
          success('Đăng nhập thành công', 'http://localhost/library/');
        } else if ($_SESSION['user']['roleAccess'] == 2 || $_SESSION['user']['roleAccess'] == 3) {
          confirm('Đăng nhập thành công', 'Chọn trang bạn cần di chuyển đến!', 'success', 'Trang chủ', 'Admin', 'http://localhost/library/', 'http://localhost/library/?controller=admin');
        } elseif ($_SESSION['user']['roleAccess'] == 0) {
          unset($_SESSION['user']);
          warningNotLoad('Tài khoản của bạn tạm thời đã bị khóa!  Vui lòng đến thư viện và đóng phí 50.000VND để mở khóa!');
        }
      } else {
        errorNotLoad('Tên tài khoản hoặc mật khẩu không chính xác!');
      }
    }
    return $this->loadview('general.login', []);
  }

  public function logout()
  {
    session_unset();
    echo "<script>window.location.href = '?controller=user&action=login';</script>";
  }

  public function profile()
  {
    if (isset($_SESSION['user']) && ($_SESSION['user']['roleAccess'] == 1 || $_SESSION['user']['roleAccess'] == 2)) {
      $pageOption = $_GET['profilePage'];
      switch ($pageOption) {
        case 'rentHistory':
          $searchListRentBook = isset($_POST['search_list_rent_book']) ? $_POST['search_list_rent_book'] : '';
          $_SESSION['sort_list_rent_book'] = isset($_SESSION['sort_list_rent_book']) ? $_SESSION['sort_list_rent_book'] : 'desc';
          $_SESSION['sort_list_rent_book'] = isset($_POST['sort_list_rent_book']) ? $_POST['sort_list_rent_book'] : $_SESSION['sort_list_rent_book'];
          $limit = 10;
          $listAllRentBook = $this->userModel->listAllRentBook($_SESSION['user']['id'], $_SESSION['sort_list_rent_book'], $searchListRentBook);
          $currentPage = isset($_GET['page']) ? $_GET['page'] : 1;
          $totalPage = ceil(mysqli_num_rows($listAllRentBook) / $limit);
          if ($currentPage > $totalPage) {
            $currentPage = $totalPage;
          }
          if ($currentPage < 1) {
            $currentPage = 1;
          }
          $start = ($currentPage - 1) * $limit;

          $listRentBook = mysqli_fetch_all($this->userModel->listRentBook($_SESSION['user']['id'], $_SESSION['sort_list_rent_book'], $searchListRentBook, $start, $limit));

          return $this->loadview('user.profile.profile', ['listRentBook' => $listRentBook, 'currentPage' => $currentPage, 'limit' => $limit, 'totalPage' => $totalPage, 'searchListRentBook' => $searchListRentBook]);
        case 'infoUser':
          return $this->loadview('user.profile.profile', []);

        case 'changePassword':
          return $this->loadview('user.profile.profile', []);
        default:
          return $this->loadview('user.profile.profile', []);

      }

    } else {
      echo "<script>window.location.href = '?controller=user&action=login';</script>";
    }
  }

  public function searchBook()
  {
    $options = array(
      "nameBook" => "sách",
      "creatorBook" => "tác giả",
      "topicBook" => "chủ đề",
      "publisherBook" => "nhà xuất bản",
      "dateBook" => "năm xuất bản"
    );

    $contentSearch = $_GET['contentSearch'];
    $optionSearch = $_GET['optionSearch'];

    if (array_key_exists($optionSearch, $options)) {
      $optionText = $options[$optionSearch];
    } else {
      $optionText = null;
    }

    $books = $this->userModel->searchBooks($contentSearch, $optionSearch);
    $this->loadview('user.searchBook', [
      'componentDatas' => $books,
      'contentSearch' => $contentSearch,
      'optionText' => $optionText
    ]);
  }

  public function upload()
  {
    if (!isset($_SESSION['user'])) {

      $error_message = "Vui lòng đăng nhập để sử dụng chức năng này.";
      return $this->loadview('user.404', ['error_message' => $error_message]);
    }
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $upload_url = $_POST['uploadURL'];
      $nhanDe = $_POST['title1'];
      $loaiTaiLieu = $_POST['type1'];
      $this->userModel->uploadFile($upload_url, $nhanDe, $loaiTaiLieu, $_SESSION['user']['id']);

    }
    $uploadData = $this->userModel->uploadData($_SESSION['user']['id']);
    $typeData = $this->userModel->getDataType();
    return $this->loadview('user.upload', ['uploadData' => $uploadData, 'typeData' => $typeData]);
  }

  public function book_detail()
  {
    $id = $_GET['id'];
    $getOneBook = $this->userModel->getOneBook($id);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $this->userModel->requestBook($_SESSION['user']['id'], $id);
    }

    return $this->loadview('user.book-detail', ['bookData' => $getOneBook]);
  }
}

?>