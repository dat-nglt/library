<?php

class adminController extends baseController
{
  private $adminModel;

  public function __construct()
  {
    $this->loadModel('adminModel');
    $this->adminModel = new adminModel;

  }
  public function index()
  {
    return $this->loadview('admin.home', []);
  }

  public function account()
  {
    $limit = 15;
    $_SESSION['sort-account'] = isset($_SESSION['sort-account']) ? $_SESSION['sort-account'] : 'desc';
    $_SESSION['search-account'] = isset($_SESSION['search-account']) ? $_SESSION['search-account'] : '';
    if (isset($_POST['sort-account'])) {
      $_SESSION['sort-account'] = $_POST['sort-account'];
    }
    if (isset($_POST['search-account'])) {
      $_SESSION['search-account'] = $_POST['search-account'];
    }
    $total = $this->adminModel->getAllUser($_SESSION['search-account']);
    $current_page = isset($_GET['page']) ? $_GET['page'] : 1;
    $total_page = ceil(mysqli_num_rows($total) / $limit);
    if ($current_page > $total_page) {
      $current_page = $total_page;
    }
    if ($current_page < 1) {
      $current_page = 1;
    }
    $start = ($current_page - 1) * $limit;
    $listAccount = mysqli_fetch_all($this->adminModel->getListUser($start, $limit, $_SESSION['sort-account'], $_SESSION['search-account']));
    if (isset($_POST['add_account-handmade'])) {
      $studentCode = $_POST['student-code_user'];
      $fullName = $_POST['name_user'];
      $dateOfBirth = $_POST['date-of-birth_user'];
      $address = $_POST['address_user'];
      $phoneNumber = $_POST['phone-number_user'];
      $email = $_POST['email_user'];
      $identificationNumber = $_POST['identification-number_user'];
      $class = $_POST['class_user'];
      $password = password_hash($_POST['password_user'], PASSWORD_DEFAULT);
      if (mysqli_num_rows($this->adminModel->checkUserWithStudentCode($studentCode)) < 1) {
        if (mysqli_num_rows($this->adminModel->checkUserWithIdentificationNumber($identificationNumber)) < 1) {
          $add = $this->adminModel->addUser($studentCode, $password, $fullName, $dateOfBirth, $address, $phoneNumber, $email, $identificationNumber, $class);
          if ($add) {
            $this->loadview('admin.account', ['listAccount' => $listAccount, 'current_page' => $current_page, 'limit' => $limit, 'total_page' => $total_page]);
            success('Thêm tài khoản thành công!', '?controller=admin&action=account&page=' . $current_page);
          } else {
            $this->loadview('admin.account', ['listAccount' => $listAccount, 'current_page' => $current_page, 'limit' => $limit, 'total_page' => $total_page]);
            error('Thêm tài khoản thất bại!', '?controller=admin&action=account&page=' . $current_page);
          }
        } else {
          $this->loadview('admin.account', ['listAccount' => $listAccount, 'current_page' => $current_page, 'limit' => $limit, 'total_page' => $total_page]);
          warning('Số căn cước công dân đã tồn tại!', '?controller=admin&action=account&page=' . $current_page);
        }
      } else {
        $this->loadview('admin.account', ['listAccount' => $listAccount, 'current_page' => $current_page, 'limit' => $limit, 'total_page' => $total_page]);
        warning('Mã số sinh viên đã tồn tại!', '?controller=admin&action=account&page=' . $current_page);
      }
      exit();
    }
    if (isset($_POST['edit_account-handmade'])) {
      $id = $_POST['id_user'];
      $studentCode = $_POST['student-code_user'];
      $fullName = $_POST['name_user'];
      $dateOfBirth = $_POST['date-of-birth_user'];
      $address = $_POST['address_user'];
      $phoneNumber = $_POST['phone-number_user'];
      $email = $_POST['email_user'];
      $identificationNumber = $_POST['identification-number_user'];
      $class = $_POST['class_user'];
      $password = password_hash($_POST['password_user'], PASSWORD_DEFAULT);
      $infoUserPrev = mysqli_fetch_assoc($this->adminModel->checkUserWithId($id));
      if ((mysqli_num_rows($this->adminModel->checkUserWithStudentCode($studentCode))) > 0 && ($infoUserPrev['studentCode'] != $studentCode)) {
        if ((mysqli_num_rows($this->adminModel->checkUserWithIdentificationNumber($identificationNumber)) > 0) && ($infoUserPrev['identificationNumber'] != $studentCode)) {
          // $add = $this->adminModel->addUser($studentCode, $password, $fullName, $dateOfBirth, $address, $phoneNumber, $email, $identificationNumber, $class);
          $add = true;
          if ($add) {
            $this->loadview('admin.account', ['listAccount' => $listAccount, 'current_page' => $current_page, 'limit' => $limit, 'total_page' => $total_page]);
            success('Thêm tài khoản thành công!', '?controller=admin&action=account&page=' . $current_page);
          } else {
            $this->loadview('admin.account', ['listAccount' => $listAccount, 'current_page' => $current_page, 'limit' => $limit, 'total_page' => $total_page]);
            error('Thêm tài khoản thất bại!', '?controller=admin&action=account&page=' . $current_page);
          }
        } else {
          $this->loadview('admin.account', ['listAccount' => $listAccount, 'current_page' => $current_page, 'limit' => $limit, 'total_page' => $total_page]);
          warning('Số căn cước công dân đã tồn tại!', '?controller=admin&action=account&page=' . $current_page);
        }
      } else {
        $this->loadview('admin.account', ['listAccount' => $listAccount, 'current_page' => $current_page, 'limit' => $limit, 'total_page' => $total_page]);
        warning('Mã số sinh viên đã tồn tại!', '?controller=admin&action=account&page=' . $current_page);
      }
      exit();
    }
    return $this->loadview('admin.account', ['listAccount' => $listAccount, 'current_page' => $current_page, 'limit' => $limit, 'total_page' => $total_page]);
  }

}

?>