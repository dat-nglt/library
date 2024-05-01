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
            'notification' => ['type' => 'success', 'message' => 'Đăng nhập không thành công', 'link' => 'http://localhost/library/?controller=user&action=login']
          ]
        );

      }
    }
    return $this->loadview('general.login', []);
  }

  public function logout()
  {
    session_unset();
    return $this->loadview('general.login', []);
  }

  public function profile()
  {
    $profilePage = isset($_GET['profilePage']) ? $_GET['profilePage'] : 'info';
    switch ($profilePage) {
      case 'changePassword':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
          $newPassword = $_POST['newPassword'];
          echo $newPassword;
          // $resultChangePassword = $this->userModel->changePassword($_SESSION['user']['newPassword'], $newPassword);
          // if ($resultChangePassword) {
          //   return $this->loadview('user.profile.profile', [
          //     'notification' => ['type' => 'success', 'message' => 'Cập nhật mật khẩu thành công', 'link' => 'http://localhost/library/?controller=user&action=profile&profilePage=changePassword']
          //   ]);
          // }
        }
    }
    return $this->loadview('user.profile.profile', []);
  }

  public function upload()
  {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $file_url = $_POST['uploadURL'];
    }
    return $this->loadview('user.upload', []);
  }
}

?>