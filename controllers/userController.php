<?php

class userController extends baseController
{
  private $userModel;

  public function __construct()
  {
    $this->loadModel('userModel'); //gọi lại model đã tạo
    $this->userModel = new userModel;

  }
  public function index()
  {

    $books = $this->userModel->getAllBook();

    $componentName = 'homeHotBook';
    return $this->loadview('user.home', ['componentName' => $componentName, 'componentDatas' => $books]);


  }

  public function bookHot()
  {
    $books = $this->userModel->getAllBook();

    $componentName = 'homeHotBook';
     $this->loadview('user.home', ['componentName' => $componentName, 'componentDatas' => $books]);
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
      if ($result && password_verify($matKhau, $result['password'])) {
        $_SESSION['user'] = $result;
        return $this->loadView('user.home', ['notification' => ['type' => 'success', 'message' => 'Đăng nhập thành công', 'link' => 'http://localhost/library/']]);
      } else {
        return $this->loadview(
          'general.login',
          [
            'notification' => ['type' => 'error', 'message' => 'Đăng nhập không thành công', 'link' => 'http://localhost/library/?controller=user&action=login']
          ]
        );

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
    if (isset($_SESSION['user'])) {
      if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $oldPassword = $_POST['oldPassword'];
        $newPassword = $_POST['newPassword'];

        if (password_verify($oldPassword, $_SESSION['user']['password'])) {
          $newHashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
          if ($this->userModel->changePassword($_SESSION['user']['id'], $newHashedPassword)) {
            $_SESSION['user']['password'] = $newHashedPassword;
            http_response_code(200);
          } else {
            http_response_code(400);
          }
        } else {
          http_response_code(400);
        }
      }

      return $this->loadview('user.profile.profile', []);
    } else {
      echo "<script>window.location.href = '?controller=user&action=login';</script>";
    }
  }


  public function upload()
  {
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