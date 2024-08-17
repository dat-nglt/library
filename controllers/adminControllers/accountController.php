<?php
class accountController extends baseController{

    private $accountModel;
    public function __construct()
    {
        $this->loadModel('accountModel');
        $this->accountModel = new accountModel;
    }
    public function index()
  {
    if (isset($_SESSION['user']) && ($_SESSION['user']['roleAccess'] === '2' || $_SESSION['user']['roleAccess'] === '3')) {
      $limit = 15;
      $_SESSION['sort-account'] = isset($_SESSION['sort-account']) ? $_SESSION['sort-account'] : 'desc';
      $_SESSION['search-account'] = isset($_SESSION['search-account']) ? $_SESSION['search-account'] : '';
      if (isset($_POST['sort-account'])) {
        $_SESSION['sort-account'] = $_POST['sort-account'];
      }
      if (isset($_POST['search-account'])) {
        $_SESSION['search-account'] = $_POST['search-account'];
      }
      $total = $this->accountModel->getAllUser($_SESSION['search-account']);
      $current_page = isset($_GET['page']) ? $_GET['page'] : 1;
      $total_page = ceil(mysqli_num_rows($total) / $limit);
      if ($current_page > $total_page) {
        $current_page = $total_page;
      }
      if ($current_page < 1) {
        $current_page = 1;
      }
      $start = ($current_page - 1) * $limit;
      $listAccount = mysqli_fetch_all($this->accountModel->getListUser($start, $limit, $_SESSION['sort-account'], $_SESSION['search-account']));
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
        if (mysqli_num_rows($this->accountModel->checkUserWithStudentCode($studentCode)) < 1) {
          if (mysqli_num_rows($this->accountModel->checkUserWithIdentificationNumber($identificationNumber)) < 1) {
            $add = $this->accountModel->addUser($studentCode, $password, $fullName, $dateOfBirth, $address, $phoneNumber, $email, $identificationNumber, $class);
            if ($add) {
              $this->loadView('admin.account', ['listAccount' => $listAccount, 'current_page' => $current_page, 'limit' => $limit, 'total_page' => $total_page]);
              success('Thêm tài khoản thành công!', '?controller=admin&action=account&page=' . $current_page);
            } else {
              $this->loadView('admin.account', ['listAccount' => $listAccount, 'current_page' => $current_page, 'limit' => $limit, 'total_page' => $total_page]);
              error('Thêm tài khoản thất bại!', '?controller=admin&action=account&page=' . $current_page);
            }
          } else {
            $this->loadView('admin.account', ['listAccount' => $listAccount, 'current_page' => $current_page, 'limit' => $limit, 'total_page' => $total_page]);
            warning('Số căn cước công dân đã tồn tại!', '?controller=admin&action=account&page=' . $current_page);
          }
        } else {
          $this->loadView('admin.account', ['listAccount' => $listAccount, 'current_page' => $current_page, 'limit' => $limit, 'total_page' => $total_page]);
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
        if ($_POST['password_user'] != '') {
          $password = password_hash($_POST['password_user'], PASSWORD_DEFAULT);
        } else {
          $password = '';
        }
        if ($infoUserPrev = mysqli_fetch_assoc($this->accountModel->checkUserWithId($id))) {
          if ($infoUserPrev['studentCode'] === $studentCode) {
            if (($infoUserPrev['identificationNumber'] === $identificationNumber)) {
              $update = $this->accountModel->updateUser($id, $studentCode, $password, $fullName, $dateOfBirth, $address, $phoneNumber, $email, $identificationNumber, $class);
              if ($update) {
                $this->loadView('admin.account', ['listAccount' => $listAccount, 'current_page' => $current_page, 'limit' => $limit, 'total_page' => $total_page]);
                success('Cập nhật tài khoản thành công!', '?controller=admin&action=account&page=' . $current_page);
              } else {
                $this->loadView('admin.account', ['listAccount' => $listAccount, 'current_page' => $current_page, 'limit' => $limit, 'total_page' => $total_page]);
                error('Cập nhật tài khoản thất bại!', '?controller=admin&action=account&page=' . $current_page);
              }
            } else {
              if (mysqli_num_rows($this->accountModel->checkUserWithIdentificationNumber($identificationNumber)) > 0) {
                $this->loadView('admin.account', ['listAccount' => $listAccount, 'current_page' => $current_page, 'limit' => $limit, 'total_page' => $total_page]);
                warning('Số căn cước công dân đã tồn tại!', '?controller=admin&action=account&page=' . $current_page);
              } else {
                $update = $this->accountModel->updateUser($id, $studentCode, $password, $fullName, $dateOfBirth, $address, $phoneNumber, $email, $identificationNumber, $class);
                if ($update) {
                  $this->loadView('admin.account', ['listAccount' => $listAccount, 'current_page' => $current_page, 'limit' => $limit, 'total_page' => $total_page]);
                  success('Cập nhật tài khoản thành công!', '?controller=admin&action=account&page=' . $current_page);
                } else {
                  $this->loadView('admin.account', ['listAccount' => $listAccount, 'current_page' => $current_page, 'limit' => $limit, 'total_page' => $total_page]);
                  error('Cập nhật tài khoản thất bại!', '?controller=admin&action=account&page=' . $current_page);
                }
              }
            }
          } else {
            if (mysqli_num_rows($this->accountModel->checkUserWithStudentCode($studentCode)) > 0) {
              $this->loadView('admin.account', ['listAccount' => $listAccount, 'current_page' => $current_page, 'limit' => $limit, 'total_page' => $total_page]);
              warning('Mã số sinh viên đã tồn tại!', '?controller=admin&action=account&page=' . $current_page);
            } else {
              if (($infoUserPrev['identificationNumber'] === $identificationNumber)) {
                $update = $this->accountModel->updateUser($id, $studentCode, $password, $fullName, $dateOfBirth, $address, $phoneNumber, $email, $identificationNumber, $class);
                if ($update) {
                  $this->loadView('admin.account', ['listAccount' => $listAccount, 'current_page' => $current_page, 'limit' => $limit, 'total_page' => $total_page]);
                  success('Cập nhật tài khoản thành công!', '?controller=admin&action=account&page=' . $current_page);
                } else {
                  $this->loadView('admin.account', ['listAccount' => $listAccount, 'current_page' => $current_page, 'limit' => $limit, 'total_page' => $total_page]);
                  error('Cập nhật tài khoản thất bại!', '?controller=admin&action=account&page=' . $current_page);
                }
              } else {
                if (mysqli_num_rows($this->accountModel->checkUserWithIdentificationNumber($identificationNumber)) > 0) {
                  $this->loadView('admin.account', ['listAccount' => $listAccount, 'current_page' => $current_page, 'limit' => $limit, 'total_page' => $total_page]);
                  warning('Số căn cước công dân đã tồn tại!', '?controller=admin&action=account&page=' . $current_page);
                } else {
                  $update = $this->accountModel->updateUser($id, $studentCode, $password, $fullName, $dateOfBirth, $address, $phoneNumber, $email, $identificationNumber, $class);
                  if ($update) {
                    $this->loadView('admin.account', ['listAccount' => $listAccount, 'current_page' => $current_page, 'limit' => $limit, 'total_page' => $total_page]);
                    success('Cập nhật tài khoản thành công!', '?controller=admin&action=account&page=' . $current_page);
                  } else {
                    $this->loadView('admin.account', ['listAccount' => $listAccount, 'current_page' => $current_page, 'limit' => $limit, 'total_page' => $total_page]);
                    error('Cập nhật tài khoản thất bại!', '?controller=admin&action=account&page=' . $current_page);
                  }
                }
              }
            }
          }
        } else {
          $this->loadView('admin.account', ['listAccount' => $listAccount, 'current_page' => $current_page, 'limit' => $limit, 'total_page' => $total_page]);
          error('Không thể cập nhật người dùng!', '?controller=admin&action=account&page=' . $current_page);
        }
        exit();
      }
      return $this->loadView('admin.account', ['listAccount' => $listAccount, 'current_page' => $current_page, 'limit' => $limit, 'total_page' => $total_page]);
    } else {
      header('Location: http://localhost/library/');
      exit();
    }
  }

  public function librarian()
  {
    if (isset($_SESSION['user']) && $_SESSION['user']['roleAccess'] === '3') {
      $limit = 15;
      $_SESSION['sort-librarian'] = isset($_SESSION['sort-librarian']) ? $_SESSION['sort-librarian'] : 'desc';
      $_SESSION['search-librarian'] = isset($_SESSION['search-librarian']) ? $_SESSION['search-librarian'] : '';
      if (isset($_POST['sort-librarian'])) {
        $_SESSION['sort-librarian'] = $_POST['sort-librarian'];
      }
      if (isset($_POST['search-librarian'])) {
        $_SESSION['search-librarian'] = $_POST['search-librarian'];
      }
      $total = $this->accountModel->getAllLibrarian($_SESSION['search-librarian']);
      $current_page = isset($_GET['page']) ? $_GET['page'] : 1;
      $total_page = ceil(mysqli_num_rows($total) / $limit);
      if ($current_page > $total_page) {
        $current_page = $total_page;
      }
      if ($current_page < 1) {
        $current_page = 1;
      }
      $start = ($current_page - 1) * $limit;
      $listLibrarian = mysqli_fetch_all($this->accountModel->getListLibrarian($start, $limit, $_SESSION['sort-librarian'], $_SESSION['search-librarian']));
      if (isset($_POST['add_librarian-handmade'])) {
        $username = $_POST['username_user'];
        $fullName = $_POST['name_user'];
        $phoneNumber = $_POST['phone-number_user'];
        $email = $_POST['email_user'];
        $class = $_POST['class_user'];
        $password = password_hash($_POST['password_user'], PASSWORD_DEFAULT);
        if (mysqli_num_rows($this->accountModel->checkLibrarianWithUsername($username)) < 1) {
          $add = $this->accountModel->addLibrarian($username, $password, $fullName, $phoneNumber, $email, $class);
          if ($add) {
            $this->loadView('admin.librarian', ['listLibrarian' => $listLibrarian, 'current_page' => $current_page, 'limit' => $limit, 'total_page' => $total_page]);
            success('Thêm thủ thư thành công!', '?controller=admin&action=librarian&page=' . $current_page);
          } else {
            $this->loadView('admin.librarian', ['listLibrarian' => $listLibrarian, 'current_page' => $current_page, 'limit' => $limit, 'total_page' => $total_page]);
            error('Thêm thủ thư thất bại!', '?controller=admin&action=librarian&page=' . $current_page);
          }
        } else {
          $this->loadView('admin.librarian', ['listLibrarian' => $listLibrarian, 'current_page' => $current_page, 'limit' => $limit, 'total_page' => $total_page]);
          warning('Tên đăng nhập đã tồn tại!', '?controller=admin&action=librarian&page=' . $current_page);
        }
        exit();
      }
      if (isset($_POST['edit_librarian-handmade'])) {
        $id = $_POST['id_user'];
        $username = $_POST['username_user'];
        $fullName = $_POST['name_user'];
        $phoneNumber = $_POST['phone-number_user'];
        $email = $_POST['email_user'];
        $class = $_POST['class_user'];
        if ($_POST['password_user'] != '') {
          $password = password_hash($_POST['password_user'], PASSWORD_DEFAULT);
        } else {
          $password = '';
        }
        if ($infoUserPrev = mysqli_fetch_assoc($this->accountModel->checkLibrarianWithId($id))) {
          if ($infoUserPrev['studentCode'] === $username) {
            $update = $this->accountModel->updateLibrarian($id, $username, $password, $fullName, $phoneNumber, $email, $class);
            if ($update) {
              $this->loadView('admin.librarian', ['listLibrarian' => $listLibrarian, 'current_page' => $current_page, 'limit' => $limit, 'total_page' => $total_page]);
              success('Cập nhật thủ thư thành công!', '?controller=admin&action=librarian&page=' . $current_page);
            } else {
              $this->loadView('admin.librarian', ['listLibrarian' => $listLibrarian, 'current_page' => $current_page, 'limit' => $limit, 'total_page' => $total_page]);
              error('Cập nhật thủ thư thất bại!', '?controller=admin&action=librarian&page=' . $current_page);
            }
          } else {
            if (mysqli_num_rows($this->accountModel->checkLibrarianWithUsername($username)) > 0) {
              $this->loadView('admin.librarian', ['listLibrarian' => $listLibrarian, 'current_page' => $current_page, 'limit' => $limit, 'total_page' => $total_page]);
              warning('Tên đăng nhập đã tồn tại!', '?controller=admin&action=librarian&page=' . $current_page);
            } else {
              $update = $this->accountModel->updateLibrarian($id, $username, $password, $fullName, $phoneNumber, $email, $class);
              if ($update) {
                $this->loadView('admin.librarian', ['listLibrarian' => $listLibrarian, 'current_page' => $current_page, 'limit' => $limit, 'total_page' => $total_page]);
                success('Cập nhật thủ thư thành công!', '?controller=admin&action=librarian&page=' . $current_page);
              } else {
                $this->loadView('admin.librarian', ['listLibrarian' => $listLibrarian, 'current_page' => $current_page, 'limit' => $limit, 'total_page' => $total_page]);
                error('Cập nhật thủ thư thất bại!', '?controller=admin&action=librarian&page=' . $current_page);
              }
            }
          }
        } else {
          $this->loadView('admin.librarian', ['listLibrarian' => $listLibrarian, 'current_page' => $current_page, 'limit' => $limit, 'total_page' => $total_page]);
          error('Không thể cập nhật người dùng!', '?controller=admin&action=account&page=' . $current_page);
        }
        exit();
      }
      return $this->loadView('admin.librarian', ['listLibrarian' => $listLibrarian, 'current_page' => $current_page, 'limit' => $limit, 'total_page' => $total_page]);
    } else {
      header('Location: http://localhost/library/');
      exit();
    }
  }
}
