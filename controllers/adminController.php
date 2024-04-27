<?php

class adminController extends baseController
{
  private $adminModel;

  public function __construct()
  {
    $this->loadModel('adminModel'); //gọi lại model đã tạo
    $this->adminModel = new adminModel;

  }
  public function index()
  {
    return $this->loadview('admin.home', []);
  }
}

?>