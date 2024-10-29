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

    $books = $this->userModel->getAllBook(9);

    $componentName = 'homeHotBook';
    if (isset($_SESSION['user'])) {
      $this->userModel->denyRequest($_SESSION['user']['id']); //hủy yêu cầu sau 24h
    }
    return $this->loadview('user.home', ['componentName' => $componentName, 'componentDatas' => $books]);
  }

  public function login()
  {
    if (isset($_POST["login"])) {

      $taiKhoan = $_POST["taiKhoan"];
      $matKhau = $_POST["matKhau"];

      // Xử lí trường hợp thông tin đăng nhập bị trống
      if ($taiKhoan == "" || $matKhau == "") {
        warningNotLoad('Tên tài khoản hoặc mật khẩu không được để trống!');
      }
      // Xử lí trường hợp thông tin đăng nhập đầy đủ
      else {
        // Kiểm tra sự tồn tại của tài khoản trong DB.
        $result = mysqli_fetch_assoc($this->userModel->getAccount($taiKhoan));
        // Kiểm tra mật khẩu có chính xác hay không.
        if ($result && password_verify($matKhau, $result['password'])) {
          // Thiết lập ghi nhớ thông tin đăng nhập
          if (isset($_POST["nhoMatKhau"])) {
            setcookie("matKhau", $matKhau, time() + (86400 * 7), "/");
            setcookie("taiKhoan", $taiKhoan, time() + (86400 * 7), "/");
          }
          // Hủy thiết lập ghi nhớ đăng nhập
          else {
            setcookie("matKhau", "", time() - 3600, "/");
            setcookie("taiKhoan", "", time() - 3600, "/");
          }
          $_SESSION['user'] = $result;
          if ($_SESSION['user']['roleAccess'] == 1) {
            // Trường hợp người dùng thông thường
            success('Đăng nhập thành công', 'http://localhost/library/');
          } else if ($_SESSION['user']['roleAccess'] == 2 || $_SESSION['user']['roleAccess'] == 3) {
            // Trường hợp thủ thư và quản trị viên
            confirm('Đăng nhập thành công', 'Chọn trang bạn cần di chuyển đến!', 'success', 'Trang chủ', 'Admin', 'http://localhost/library/', 'http://localhost/library/?controller=admin');
          } elseif ($_SESSION['user']['roleAccess'] == 0) {
            // Trường hợp tài khoản bị khóa
            unset($_SESSION['user']);
            warningNotLoad('Tài khoản của bạn tạm thời đã bị khóa! Vui lòng đến thư viện và đóng phí 50.000VND để mở khóa!');
          }
        } else {
          errorNotLoad('Tên tài khoản hoặc mật khẩu không chính xác!');
        }
      }
    }
    return $this->loadview('general.login', []);
  }

  public function logout()
  {
    session_unset();
    echo "<script>window.location.href = '?controller=user&action=login';</script>";
  }

  public function allBooks()
  {

    $allBooks = $this->userModel->getAllBook();

    return $this->loadview('user.allBooks', ['componentDatas' => $allBooks]);
  }

  public function allNews()
  {

    $allNews = $this->userModel->getAllNews();

    return $this->loadview('user.allNews', ['componentDatas' => $allNews]);
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
    $books = $this->userModel->getAllBook(6);

    $componentName = 'homeHotBook';
    $this->loadview('user.home', ['componentName' => $componentName, 'componentDatas' => $books]);
  }

  public function rentSticket()
  {
    $this->loadview(viewPath: 'user.rentSticket');
  }

  public function newshot()
  {
    $componentName = 'homeHotNews';
    $news = $this->userModel->getAllNews(3);
    return $this->loadview('user.home', ['componentName' => $componentName, 'componentDatas' => $news]);
  }
  public function newsdetails()
  {
    $id = $_GET["id"];
    $componentName = 'homeNewsDetails';
    $news = $this->userModel->getNews($id);
    return $this->loadview('user.detailsNews', ['componentDatas' => $news]);
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

          $_SESSION['status-rent'] = isset($_SESSION['status-rent']) ? $_SESSION['status-rent'] : 'all';
          $_SESSION['status-rent'] = isset($_POST['status-rent']) ? $_POST['status-rent'] : $_SESSION['status-rent'];
          $limit = 10;
          $listAllRentBook = $this->userModel->listAllRentBook($_SESSION['user']['id'], $_SESSION['sort_list_rent_book'], $searchListRentBook, $_SESSION['status-rent']);
          $currentPage = isset($_GET['page']) ? $_GET['page'] : 1;
          $totalPage = ceil(mysqli_num_rows($listAllRentBook) / $limit);
          if ($currentPage > $totalPage) {
            $currentPage = $totalPage;
          }
          if ($currentPage < 1) {
            $currentPage = 1;
          }
          $start = ($currentPage - 1) * $limit;

          $listRentBook = mysqli_fetch_all($this->userModel->listRentBook($_SESSION['user']['id'], $_SESSION['sort_list_rent_book'], $searchListRentBook, $_SESSION['status-rent'], $start, $limit));

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
  public function searchNews()
  {
    $contentSearch = $_GET['contentSearch'];
    $sortSearch = isset($_GET['sortSearch']) ? $_GET['sortSearch'] : 'desc';
    $dateSearch = $_GET['dateSearch'];
    // var_dump($contentSearch);
    // var_dump($dateSearch);
    // var_dump($sortSearch);
    
    $books = $this->userModel->newsSearch($contentSearch,$sortSearch,$dateSearch);
    $this->loadview('user.searchNews', [
      'componentDatas' => $books,
      'contentSearch' => $contentSearch,
      'dateSearch' => $dateSearch
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