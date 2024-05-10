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
    return $this->loadview('user.home', []);
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
      $tacGia = $_POST['creator1'];
      $nhanDe = $_POST['title1'];
      $email = $_POST['email1'];
      $loaiTaiLieu = $_POST['type1'];
      $this->userModel->uploadFile($upload_url, $tacGia, $nhanDe, $email, $loaiTaiLieu, $_SESSION['user']['id']);

    }
    $uploadData = mysqli_fetch_all($this->userModel->uploadData($_SESSION['user']['id']));
    return $this->loadview('user.upload', $uploadData);
  }
}

?>