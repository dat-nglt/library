<?php
class punishController extends baseController{

    private $punishModel;
    public function __construct()
    {
        $this->loadModel('punishModel');
        $this->punishModel = new punishModel;
    }
    public function punish()
    {
      if (isset($_SESSION['user']) && ($_SESSION['user']['roleAccess'] === '2' || $_SESSION['user']['roleAccess'] === '3')) {
        $limit = 1;
        if (isset($_POST['sort-upload'])) {
          $_SESSION['sort-upload'] = $_POST['sort-upload'];
        }
        $total = $this->punishModel->getPunish();
        $current_page = isset($_GET['page']) ? $_GET['page'] : 1;
        $total_page = ceil(mysqli_num_rows($total) / $limit);
        if ($current_page > $total_page) {
          $current_page = $total_page;
        }
        if ($current_page < 1) {
          $current_page = 1;
        }
        $start = ($current_page - 1) * $limit;
        $_SESSION['sort-punish'] = isset($_SESSION['sort-punish']) ? $_SESSION['sort-punish'] : 'DESC';
        $listPunish = $this->punishModel->getAllPunish($start, $limit, $_SESSION['sort-upload']);
        return $this->loadView('admin.punish', ['listPunish' => $listPunish, 'current_page' => $current_page, 'limit' => $limit, 'total_page' => $total_page]);
      } else {
        header('Location: http://localhost/library/');
        exit();
      }
    }
}