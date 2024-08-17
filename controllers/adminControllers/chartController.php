<?php
class chartController extends baseController{

    private $chartModel;
    public function __construct()
    {
        $this->loadModel('chartModel');
        $this->chartModel = new chartModel;
    }

    public function index()
    {
      if (isset($_SESSION['user']) && ($_SESSION['user']['roleAccess'] === '2' || $_SESSION['user']['roleAccess'] === '3')) {
        return $this->loadView('admin.home', []);
      } else {
        header('Location: http://localhost/library/');
        exit();
      }
    }
    public function chart()
  {
    if (isset($_SESSION['user']) && ($_SESSION['user']['roleAccess'] === '2' || $_SESSION['user']['roleAccess'] === '3')) {
      $countRequestInMonth = mysqli_fetch_all($this->chartModel->countRequestInMonth());
      $countStatusRequest = mysqli_fetch_all($this->chartModel->countStatusRequest());
      $countUser = mysqli_fetch_all($this->chartModel->countUser());
      $countCategory = mysqli_fetch_all($this->chartModel->countCategory());
      return $this->loadView('admin.home', [
        'countStatusRequest' => $countStatusRequest,
        'countUser' => $countUser,
        'countCategory' => $countCategory,
        'countRequestInMonth' => $countRequestInMonth
      ]);
    } else {
      header('Location: http://localhost/library/');
      exit();
    }
  }

}
