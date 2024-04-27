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
    if (isset($_GET['code'])) {
      echo $_GET['code'];
      return $this->loadview('general.login', []);

    }

    if (isset($_POST["login"])) {
      $taiKhoan = $_POST["taiKhoan"];
      $matKhau = $_POST["matKhau"];
    }

    return $this->loadview('general.login', []);
  }
}

?>