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
    // $data = $this->userModel->getAll();
    // $row = mysqli_fetch_all($data);
    return $this->loadview('user.home', []);
  }

  public function login()
  {

    if (isset($_POST["login"])) {
      $taiKhoan = $_POST["taiKhoan"];
      $matKhau = $_POST["matKhau"];
      $result = mysqli_fetch_assoc($this->userModel->getAccount($taiKhoan));
      if ($result && password_verify($matKhau, $result['password'])) {
        $_SESSION[$result['id']] = $result;
        return $this->loadView('user.home', ['notification' => ['type' => 'success', 'message' => 'Đăng nhập thành công', 'link' => 'http://localhost/libary']]);
      } else {
        return $this->loadview(
          'general.login',
          [
            'notification' => ['type' => 'success', 'message' => 'Đăng nhập không thành công', 'link' => 'http://localhost/libary/?controller=user&action=login']
          ]
        );

      }
    }
    return $this->loadview('general.login', []);
  }
}

?>