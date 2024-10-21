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
    if (isset($_SESSION['user']) && ($_SESSION['user']['roleAccess'] === '2' || $_SESSION['user']['roleAccess'] === '3')) {
      $countRequestInMonth = mysqli_fetch_all($this->adminModel->countRequestInMonth());
      $countStatusRequest = mysqli_fetch_all($this->adminModel->countStatusRequest());
      $countUser = mysqli_fetch_all($this->adminModel->countUser());
      $countCategory = mysqli_fetch_all($this->adminModel->countCategory());
      return $this->loadview('admin.home', [
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

  public function dashboard()
  {
    if (isset($_SESSION['user']) && ($_SESSION['user']['roleAccess'] === '2' || $_SESSION['user']['roleAccess'] === '3')) {
      return $this->loadview('admin.home', []);
    } else {
      header('Location: http://localhost/library/');
      exit();
    }
  }

  public function account()
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
        if ($_POST['password_user'] != '') {
          $password = password_hash($_POST['password_user'], PASSWORD_DEFAULT);
        } else {
          $password = '';
        }
        if ($infoUserPrev = mysqli_fetch_assoc($this->adminModel->checkUserWithId($id))) {
          if ($infoUserPrev['studentCode'] === $studentCode) {
            if (($infoUserPrev['identificationNumber'] === $identificationNumber)) {
              $update = $this->adminModel->updateUser($id, $studentCode, $password, $fullName, $dateOfBirth, $address, $phoneNumber, $email, $identificationNumber, $class);
              if ($update) {
                $this->loadview('admin.account', ['listAccount' => $listAccount, 'current_page' => $current_page, 'limit' => $limit, 'total_page' => $total_page]);
                success('Cập nhật tài khoản thành công!', '?controller=admin&action=account&page=' . $current_page);
              } else {
                $this->loadview('admin.account', ['listAccount' => $listAccount, 'current_page' => $current_page, 'limit' => $limit, 'total_page' => $total_page]);
                error('Cập nhật tài khoản thất bại!', '?controller=admin&action=account&page=' . $current_page);
              }
            } else {
              if (mysqli_num_rows($this->adminModel->checkUserWithIdentificationNumber($identificationNumber)) > 0) {
                $this->loadview('admin.account', ['listAccount' => $listAccount, 'current_page' => $current_page, 'limit' => $limit, 'total_page' => $total_page]);
                warning('Số căn cước công dân đã tồn tại!', '?controller=admin&action=account&page=' . $current_page);
              } else {
                $update = $this->adminModel->updateUser($id, $studentCode, $password, $fullName, $dateOfBirth, $address, $phoneNumber, $email, $identificationNumber, $class);
                if ($update) {
                  $this->loadview('admin.account', ['listAccount' => $listAccount, 'current_page' => $current_page, 'limit' => $limit, 'total_page' => $total_page]);
                  success('Cập nhật tài khoản thành công!', '?controller=admin&action=account&page=' . $current_page);
                } else {
                  $this->loadview('admin.account', ['listAccount' => $listAccount, 'current_page' => $current_page, 'limit' => $limit, 'total_page' => $total_page]);
                  error('Cập nhật tài khoản thất bại!', '?controller=admin&action=account&page=' . $current_page);
                }
              }
            }
          } else {
            if (mysqli_num_rows($this->adminModel->checkUserWithStudentCode($studentCode)) > 0) {
              $this->loadview('admin.account', ['listAccount' => $listAccount, 'current_page' => $current_page, 'limit' => $limit, 'total_page' => $total_page]);
              warning('Mã số sinh viên đã tồn tại!', '?controller=admin&action=account&page=' . $current_page);
            } else {
              if (($infoUserPrev['identificationNumber'] === $identificationNumber)) {
                $update = $this->adminModel->updateUser($id, $studentCode, $password, $fullName, $dateOfBirth, $address, $phoneNumber, $email, $identificationNumber, $class);
                if ($update) {
                  $this->loadview('admin.account', ['listAccount' => $listAccount, 'current_page' => $current_page, 'limit' => $limit, 'total_page' => $total_page]);
                  success('Cập nhật tài khoản thành công!', '?controller=admin&action=account&page=' . $current_page);
                } else {
                  $this->loadview('admin.account', ['listAccount' => $listAccount, 'current_page' => $current_page, 'limit' => $limit, 'total_page' => $total_page]);
                  error('Cập nhật tài khoản thất bại!', '?controller=admin&action=account&page=' . $current_page);
                }
              } else {
                if (mysqli_num_rows($this->adminModel->checkUserWithIdentificationNumber($identificationNumber)) > 0) {
                  $this->loadview('admin.account', ['listAccount' => $listAccount, 'current_page' => $current_page, 'limit' => $limit, 'total_page' => $total_page]);
                  warning('Số căn cước công dân đã tồn tại!', '?controller=admin&action=account&page=' . $current_page);
                } else {
                  $update = $this->adminModel->updateUser($id, $studentCode, $password, $fullName, $dateOfBirth, $address, $phoneNumber, $email, $identificationNumber, $class);
                  if ($update) {
                    $this->loadview('admin.account', ['listAccount' => $listAccount, 'current_page' => $current_page, 'limit' => $limit, 'total_page' => $total_page]);
                    success('Cập nhật tài khoản thành công!', '?controller=admin&action=account&page=' . $current_page);
                  } else {
                    $this->loadview('admin.account', ['listAccount' => $listAccount, 'current_page' => $current_page, 'limit' => $limit, 'total_page' => $total_page]);
                    error('Cập nhật tài khoản thất bại!', '?controller=admin&action=account&page=' . $current_page);
                  }
                }
              }
            }
          }
        } else {
          $this->loadview('admin.account', ['listAccount' => $listAccount, 'current_page' => $current_page, 'limit' => $limit, 'total_page' => $total_page]);
          error('Không thể cập nhật người dùng!', '?controller=admin&action=account&page=' . $current_page);
        }
        exit();
      }
      return $this->loadview('admin.account', ['listAccount' => $listAccount, 'current_page' => $current_page, 'limit' => $limit, 'total_page' => $total_page]);
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
      $total = $this->adminModel->getAllLibrarian($_SESSION['search-librarian']);
      $current_page = isset($_GET['page']) ? $_GET['page'] : 1;
      $total_page = ceil(mysqli_num_rows($total) / $limit);
      if ($current_page > $total_page) {
        $current_page = $total_page;
      }
      if ($current_page < 1) {
        $current_page = 1;
      }
      $start = ($current_page - 1) * $limit;
      $listLibrarian = mysqli_fetch_all($this->adminModel->getListLibrarian($start, $limit, $_SESSION['sort-librarian'], $_SESSION['search-librarian']));
      if (isset($_POST['add_librarian-handmade'])) {
        $username = $_POST['username_user'];
        $fullName = $_POST['name_user'];
        $phoneNumber = $_POST['phone-number_user'];
        $email = $_POST['email_user'];
        $class = $_POST['class_user'];
        $password = password_hash($_POST['password_user'], PASSWORD_DEFAULT);
        if (mysqli_num_rows($this->adminModel->checkLibrarianWithUsername($username)) < 1) {
          $add = $this->adminModel->addLibrarian($username, $password, $fullName, $phoneNumber, $email, $class);
          if ($add) {
            $this->loadview('admin.librarian', ['listLibrarian' => $listLibrarian, 'current_page' => $current_page, 'limit' => $limit, 'total_page' => $total_page]);
            success('Thêm thủ thư thành công!', '?controller=admin&action=librarian&page=' . $current_page);
          } else {
            $this->loadview('admin.librarian', ['listLibrarian' => $listLibrarian, 'current_page' => $current_page, 'limit' => $limit, 'total_page' => $total_page]);
            error('Thêm thủ thư thất bại!', '?controller=admin&action=librarian&page=' . $current_page);
          }
        } else {
          $this->loadview('admin.librarian', ['listLibrarian' => $listLibrarian, 'current_page' => $current_page, 'limit' => $limit, 'total_page' => $total_page]);
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
        if ($infoUserPrev = mysqli_fetch_assoc($this->adminModel->checkLibrarianWithId($id))) {
          if ($infoUserPrev['studentCode'] === $username) {
            $update = $this->adminModel->updateLibrarian($id, $username, $password, $fullName, $phoneNumber, $email, $class);
            if ($update) {
              $this->loadview('admin.librarian', ['listLibrarian' => $listLibrarian, 'current_page' => $current_page, 'limit' => $limit, 'total_page' => $total_page]);
              success('Cập nhật thủ thư thành công!', '?controller=admin&action=librarian&page=' . $current_page);
            } else {
              $this->loadview('admin.librarian', ['listLibrarian' => $listLibrarian, 'current_page' => $current_page, 'limit' => $limit, 'total_page' => $total_page]);
              error('Cập nhật thủ thư thất bại!', '?controller=admin&action=librarian&page=' . $current_page);
            }
          } else {
            if (mysqli_num_rows($this->adminModel->checkLibrarianWithUsername($username)) > 0) {
              $this->loadview('admin.librarian', ['listLibrarian' => $listLibrarian, 'current_page' => $current_page, 'limit' => $limit, 'total_page' => $total_page]);
              warning('Tên đăng nhập đã tồn tại!', '?controller=admin&action=librarian&page=' . $current_page);
            } else {
              $update = $this->adminModel->updateLibrarian($id, $username, $password, $fullName, $phoneNumber, $email, $class);
              if ($update) {
                $this->loadview('admin.librarian', ['listLibrarian' => $listLibrarian, 'current_page' => $current_page, 'limit' => $limit, 'total_page' => $total_page]);
                success('Cập nhật thủ thư thành công!', '?controller=admin&action=librarian&page=' . $current_page);
              } else {
                $this->loadview('admin.librarian', ['listLibrarian' => $listLibrarian, 'current_page' => $current_page, 'limit' => $limit, 'total_page' => $total_page]);
                error('Cập nhật thủ thư thất bại!', '?controller=admin&action=librarian&page=' . $current_page);
              }
            }
          }
        } else {
          $this->loadview('admin.librarian', ['listLibrarian' => $listLibrarian, 'current_page' => $current_page, 'limit' => $limit, 'total_page' => $total_page]);
          error('Không thể cập nhật người dùng!', '?controller=admin&action=account&page=' . $current_page);
        }
        exit();
      }
      return $this->loadview('admin.librarian', ['listLibrarian' => $listLibrarian, 'current_page' => $current_page, 'limit' => $limit, 'total_page' => $total_page]);
    } else {
      header('Location: http://localhost/library/');
      exit();
    }
  }

  public function category()
  {
    if (isset($_SESSION['user']) && ($_SESSION['user']['roleAccess'] === '2' || $_SESSION['user']['roleAccess'] === '3')) {
      $limit = 15;
      $_SESSION['sort-category'] = isset($_SESSION['sort-category']) ? $_SESSION['sort-category'] : 'desc';
      $_SESSION['search-category'] = isset($_SESSION['search-category']) ? $_SESSION['search-category'] : '';
      if (isset($_POST['sort-category'])) {
        $_SESSION['sort-category'] = $_POST['sort-category'];
      }
      if (isset($_POST['search-category'])) {
        $_SESSION['search-category'] = $_POST['search-category'];
      }
      $total = $this->adminModel->getAllCategory($_SESSION['search-category']);
      $current_page = isset($_GET['page']) ? $_GET['page'] : 1;
      $total_page = ceil(mysqli_num_rows($total) / $limit);
      if ($current_page > $total_page) {
        $current_page = $total_page;
      }
      if ($current_page < 1) {
        $current_page = 1;
      }
      $start = ($current_page - 1) * $limit;
      $listCategory = mysqli_fetch_all($this->adminModel->getListCategory($start, $limit, $_SESSION['sort-category'], $_SESSION['search-category']));
      if (isset($_POST['add_category-handmade'])) {
        $categoryName = $_POST['category_name'];
        if (mysqli_num_rows($this->adminModel->checkCategoryWithName($categoryName)) < 1) {
          $add = $this->adminModel->addCategory($categoryName);
          if ($add) {
            $this->loadview('admin.category', ['listCategory' => $listCategory, 'current_page' => $current_page, 'limit' => $limit, 'total_page' => $total_page]);
            success('Thêm thể loại thành công!', '?controller=admin&action=category&page=' . $current_page);
          } else {
            $this->loadview('admin.category', ['listCategory' => $listCategory, 'current_page' => $current_page, 'limit' => $limit, 'total_page' => $total_page]);
            error('Thêm thể loại thất bại!', '?controller=admin&action=category&page=' . $current_page);
          }
        } else {
          $this->loadview('admin.category', ['listCategory' => $listCategory, 'current_page' => $current_page, 'limit' => $limit, 'total_page' => $total_page]);
          warning('Tên thể loại đã tồn tại!', '?controller=admin&action=category&page=' . $current_page);
        }
        exit();
      }
      if (isset($_POST['edit_category-handmade'])) {
        $id = $_POST['category_id'];
        $name = $_POST['category_name'];
        if ($checkName = mysqli_fetch_assoc($this->adminModel->checkCategoryWithId($id))) {
          if ($checkName['nameCategory'] === $name) {
            $edit = $this->adminModel->updateCategory($id, $name);
            if ($edit) {
              $this->loadview('admin.category', ['listCategory' => $listCategory, 'current_page' => $current_page, 'limit' => $limit, 'total_page' => $total_page]);
              success('Chỉnh sửa thể loại thành công!', '?controller=admin&action=category&page=' . $current_page);
            } else {
              $this->loadview('admin.category', ['listCategory' => $listCategory, 'current_page' => $current_page, 'limit' => $limit, 'total_page' => $total_page]);
              error('Chỉnh sửa thể loại thất bại!', '?controller=admin&action=category&page=' . $current_page);
            }
          } else {
            if (mysqli_num_rows($this->adminModel->checkCategoryWithName($name)) > 0) {
              $this->loadview('admin.category', ['listCategory' => $listCategory, 'current_page' => $current_page, 'limit' => $limit, 'total_page' => $total_page]);
              warning('Tên thể loại đã tồn tại!', '?controller=admin&action=category&page=' . $current_page);
            } else {
              $edit = $this->adminModel->updateCategory($id, $name);
              if ($edit) {
                $this->loadview('admin.category', ['listCategory' => $listCategory, 'current_page' => $current_page, 'limit' => $limit, 'total_page' => $total_page]);
                success('Chỉnh sửa thể loại thành công!', '?controller=admin&action=category&page=' . $current_page);
              } else {
                $this->loadview('admin.category', ['listCategory' => $listCategory, 'current_page' => $current_page, 'limit' => $limit, 'total_page' => $total_page]);
                error('Chỉnh sửa thể loại thất bại!', '?controller=admin&action=category&page=' . $current_page);
              }
            }
          }
        }
        exit();
      }
      return $this->loadview('admin.category', ['listCategory' => $listCategory, 'current_page' => $current_page, 'limit' => $limit, 'total_page' => $total_page]);
    } else {
      header('Location: http://localhost/library/');
      exit();
    }
  }

  public function book()
  {
    if (isset($_SESSION['user']) && ($_SESSION['user']['roleAccess'] === '2' || $_SESSION['user']['roleAccess'] === '3')) {
      $limit = 5;
      $_SESSION['sort-book'] = isset($_SESSION['sort-book']) ? $_SESSION['sort-book'] : 'desc';
      $_SESSION['search-book'] = isset($_SESSION['search-book']) ? $_SESSION['search-book'] : '';
      $_SESSION['category-book'] = isset($_SESSION['category-book']) ? $_SESSION['category-book'] : 'all';
      if (isset($_POST['sort-book'])) {
        $_SESSION['sort-book'] = $_POST['sort-book'];
      }
      if (isset($_POST['search-book'])) {
        $_SESSION['search-book'] = $_POST['search-book'];
        $_SESSION['category-book'] = $_POST['category-book'];
      }
      $total = $this->adminModel->getAllBook($_SESSION['search-book'], $_SESSION['category-book']);
      $current_page = isset($_GET['page']) ? $_GET['page'] : 1;
      $total_page = ceil(mysqli_num_rows($total) / $limit);
      if ($current_page > $total_page) {
        $current_page = $total_page;
      }
      if ($current_page < 1) {
        $current_page = 1;
      }
      $start = ($current_page - 1) * $limit;
      $listBook = mysqli_fetch_all($this->adminModel->getListBook($start, $limit, $_SESSION['sort-book'], $_SESSION['search-book'], $_SESSION['category-book']));
      $listCategory = $this->adminModel->getAllCategory('');
      return $this->loadview('admin.book', ['listBook' => $listBook, 'listCategory' => $listCategory, 'current_page' => $current_page, 'limit' => $limit, 'total_page' => $total_page]);
    } else {
      header('Location: http://localhost/library/');
      exit();
    }
  }

  public function borrow()
  {
    if (isset($_SESSION['user']) && ($_SESSION['user']['roleAccess'] === '2' || $_SESSION['user']['roleAccess'] === '3')) {
      $this->adminModel->denyRequest();
      $limit = 15;
      $_SESSION['sort-borrow'] = isset($_SESSION['sort-borrow']) ? $_SESSION['sort-borrow'] : 'desc';
      $_SESSION['search-borrow'] = isset($_SESSION['search-borrow']) ? $_SESSION['search-borrow'] : '';
      $_SESSION['status-borrow'] = isset($_SESSION['status-borrow']) ? $_SESSION['status-borrow'] : 'all';

      if (isset($_POST['sort-borrow'])) {
        $_SESSION['sort-borrow'] = $_POST['sort-borrow'];
      }

      if (isset($_POST['search-borrow'])) {
        $_SESSION['status-borrow'] = $_POST['status-borrow'];
        $_SESSION['search-borrow'] = $_POST['search-borrow'];
      }

      $total = $this->adminModel->getAllBorrow($_SESSION['search-borrow'], $_SESSION['status-borrow']);
      $current_page = isset($_GET['page']) ? $_GET['page'] : 1;
      $total_page = ceil(mysqli_num_rows($total) / $limit);

      if ($current_page > $total_page) {
        $current_page = $total_page;
      }

      if ($current_page < 1) {
        $current_page = 1;
      }

      $start = ($current_page - 1) * $limit;
      $listBorrow = mysqli_fetch_all($this->adminModel->getListBorrow($start, $limit, $_SESSION['sort-borrow'], $_SESSION['search-borrow'], $_SESSION['status-borrow']));
      $listBook = $this->adminModel->getAllBook('', 'all');
      $listUser = $this->adminModel->getAllUser('');
      if (isset($_POST['add-borrow'])) {
        $idUser = $_POST['user_borrow'];
        $idBook = $_POST['book_borrow'];
        $time = date('Y/m/d');
        $dayReturn = date('Y/m/d', strtotime($time . ' + 7 days'));
        if (mysqli_num_rows($this->adminModel->checkUserBorrow($idUser)) < 10) {
          $add = $this->adminModel->addBorrow($idUser, $idBook, $time, $dayReturn);
          if ($add) {
            $book = $this->adminModel->minusCountBook($idBook);
            if (!$book) {
              $this->loadview('admin.borrow', ['listBorrow' => $listBorrow, 'listBook' => $listBook, 'listUser' => $listUser, 'current_page' => $current_page, 'limit' => $limit, 'total_page' => $total_page]);
              error('Lỗi khi giảm số lượng sách có trong thư viện', '?controller=admin&action=borrow&page=' . $current_page);
            }
            $this->loadview('admin.borrow', ['listBorrow' => $listBorrow, 'listBook' => $listBook, 'listUser' => $listUser, 'current_page' => $current_page, 'limit' => $limit, 'total_page' => $total_page]);
            success('Thêm phiếu mượn thành công!', '?controller=admin&action=borrow&page=' . $current_page);
          } else {
            $this->loadview('admin.borrow', ['listBorrow' => $listBorrow, 'listBook' => $listBook, 'listUser' => $listUser, 'current_page' => $current_page, 'limit' => $limit, 'total_page' => $total_page]);
            error('Thêm phiếu mượn thất bại!', '?controller=admin&action=borrow&page=' . $current_page);
          }
        } else {
          $this->loadview('admin.borrow', ['listBorrow' => $listBorrow, 'listBook' => $listBook, 'listUser' => $listUser, 'current_page' => $current_page, 'limit' => $limit, 'total_page' => $total_page]);
          warning('Người dùng đang mượn 10 quyển sách!', '?controller=admin&action=borrow&page=' . $current_page);
        }
        exit();
      }
      if (isset($_POST['edit-borrow'])) {
        $id = $_POST['id_borrow'];
        $user = $_POST['user_borrow'];
        $book = $_POST['book_borrow'];
        $timeBorrow = $_POST['time_borrow'];
        $statusBorrow = $_POST['status_borrow'];
        if ($timeBorrow === '' && $statusBorrow === '1') {
          $time = date('Y/m/d');
          $dayReturn = date('Y/m/d', strtotime($time . ' + 7 days'));
          $edit = $this->adminModel->editBorrow($id, $user, $book, $statusBorrow, $time, $dayReturn);
          if ($edit) {
            if ($statusBorrow === '1') {
              $book = $this->adminModel->minusCountBook($book);
              if (!$book) {
                $this->loadview('admin.borrow', ['listBorrow' => $listBorrow, 'listBook' => $listBook, 'listUser' => $listUser, 'current_page' => $current_page, 'limit' => $limit, 'total_page' => $total_page]);
                error('Lỗi khi giảm số lượng sách có trong thư viện', '?controller=admin&action=borrow&page=' . $current_page);
              }
            }
            $this->loadview('admin.borrow', ['listBorrow' => $listBorrow, 'listBook' => $listBook, 'listUser' => $listUser, 'current_page' => $current_page, 'limit' => $limit, 'total_page' => $total_page]);
            success('Chỉnh sửa thành công!', '?controller=admin&action=borrow&page=' . $current_page);
          } else {
            $this->loadview('admin.borrow', ['listBorrow' => $listBorrow, 'listBook' => $listBook, 'listUser' => $listUser, 'current_page' => $current_page, 'limit' => $limit, 'total_page' => $total_page]);
            error('Chỉnh sửa thất bại!', '?controller=admin&action=borrow&page=' . $current_page);
          }
        } else {
          $edit = $this->adminModel->editBorrow($id, $user, $book, $statusBorrow, '', '');
          if ($edit) {
            if ($statusBorrow === '2') {
              $book = $this->adminModel->plusCountBook($book);
              if (!$book) {
                $this->loadview('admin.borrow', ['listBorrow' => $listBorrow, 'listBook' => $listBook, 'listUser' => $listUser, 'current_page' => $current_page, 'limit' => $limit, 'total_page' => $total_page]);
                error('Lỗi khi tăng số lượng sách có trong thư viện', '?controller=admin&action=borrow&page=' . $current_page);
              }
            }
            $this->loadview('admin.borrow', ['listBorrow' => $listBorrow, 'listBook' => $listBook, 'listUser' => $listUser, 'current_page' => $current_page, 'limit' => $limit, 'total_page' => $total_page]);
            success('Chỉnh sửa thành công!', '?controller=admin&action=borrow&page=' . $current_page);
          } else {
            $this->loadview('admin.borrow', ['listBorrow' => $listBorrow, 'listBook' => $listBook, 'listUser' => $listUser, 'current_page' => $current_page, 'limit' => $limit, 'total_page' => $total_page]);
            error('Chỉnh sửa thất bại!', '?controller=admin&action=borrow&page=' . $current_page);
          }

        }
        exit();
      }
      if (isset($_POST['new_time'])) {
        $id = $_POST['id_borrow'];
        $user = $_POST['user_borrow'];
        $statusBorrow = $_POST['status_borrow'];
        $book = $_POST['book_borrow'];
        $time = date('Y/m/d');
        $dayReturn = date('Y/m/d', strtotime($time . ' + 7 days'));
        $edit = $this->adminModel->editBorrow($id, $user, $book, $statusBorrow, '', $dayReturn);
        if ($edit) {
          $this->loadview('admin.borrow', ['listBorrow' => $listBorrow, 'listBook' => $listBook, 'listUser' => $listUser, 'current_page' => $current_page, 'limit' => $limit, 'total_page' => $total_page]);
          success('Gia hạn thành công!', '?controller=admin&action=borrow&page=' . $current_page);
        } else {
          $this->loadview('admin.borrow', ['listBorrow' => $listBorrow, 'listBook' => $listBook, 'listUser' => $listUser, 'current_page' => $current_page, 'limit' => $limit, 'total_page' => $total_page]);
          error('Gia hạn thất bại!', '?controller=admin&action=borrow&page=' . $current_page);
        }
        exit();
      }
      return $this->loadview('admin.borrow', ['listBorrow' => $listBorrow, 'listBook' => $listBook, 'listUser' => $listUser, 'current_page' => $current_page, 'limit' => $limit, 'total_page' => $total_page]);
    } else {
      header('Location: http://localhost/library/');
      exit();
    }
  }

  public function upload()
  {
    if (isset($_SESSION['user']) && ($_SESSION['user']['roleAccess'] === '2' || $_SESSION['user']['roleAccess'] === '3')) {
      $limit = 3;
      $_SESSION['sort-upload'] = isset($_SESSION['sort-upload']) ? $_SESSION['sort-upload'] : 'desc';
      $_SESSION['search-upload'] = isset($_SESSION['search-upload']) ? $_SESSION['search-upload'] : '';
      $_SESSION['category-upload'] = isset($_SESSION['category-upload']) ? $_SESSION['category-upload'] : 'all';
      if (isset($_POST['sort-upload'])) {
        $_SESSION['sort-upload'] = $_POST['sort-upload'];
      }
      if (isset($_POST['search-upload'])) {
        $_SESSION['search-upload'] = $_POST['search-upload'];
        $_SESSION['category-upload'] = $_POST['category-upload'];
      }
      $total = $this->adminModel->getAllUpload($_SESSION['search-upload'], $_SESSION['category-upload']);
      $current_page = isset($_GET['page']) ? $_GET['page'] : 1;
      $total_page = ceil(mysqli_num_rows($total) / $limit);
      if ($current_page > $total_page) {
        $current_page = $total_page;
      }
      if ($current_page < 1) {
        $current_page = 1;
      }
      $listBook = mysqli_fetch_all($this->adminModel->getNameBook());
      $start = ($current_page - 1) * $limit;
      $listUpload = $this->adminModel->getListUpload($start, $limit, $_SESSION['sort-upload'], $_SESSION['search-upload'], $_SESSION['category-upload']);
      $listCategory = $this->adminModel->getAllCategory('');
      $getNameCategory = mysqli_fetch_all($this->adminModel->getAllCategory(''));
      return $this->loadview('admin.upload', ['getNameCategory' => $getNameCategory, 'listBook' => $listBook, 'listUpload' => $listUpload, 'listCategory' => $listCategory, 'current_page' => $current_page, 'limit' => $limit, 'total_page' => $total_page]);
    } else {
      header('Location: http://localhost/library/');
      exit();
    }
  }

  public function punish()
  {
    if (isset($_SESSION['user']) && ($_SESSION['user']['roleAccess'] === '2' || $_SESSION['user']['roleAccess'] === '3')) {
      $limit = 1;
      if (isset($_POST['sort-upload'])) {
        $_SESSION['sort-upload'] = $_POST['sort-upload'];
      }
      $total = $this->adminModel->getPunish();
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
      $listPunish = $this->adminModel->getAllPunish($start, $limit, $_SESSION['sort-upload']);
      return $this->loadview('admin.punish', ['listPunish' => $listPunish, 'current_page' => $current_page, 'limit' => $limit, 'total_page' => $total_page]);
    } else {
      header('Location: http://localhost/library/');
      exit();
    }
  }
  public function contact()
  {
      // $limit = 5;
      // $_SESSION['sort-book'] = isset($_SESSION['sort-book']) ? $_SESSION['sort-book'] : 'desc';
      // $_SESSION['search-book'] = isset($_SESSION['search-book']) ? $_SESSION['search-book'] : '';
      // $_SESSION['category-book'] = isset($_SESSION['category-book']) ? $_SESSION['category-book'] : 'all';
      // if (isset($_POST['sort-book'])) {
      //   $_SESSION['sort-book'] = $_POST['sort-book'];
      // }
      // if (isset($_POST['search-book'])) {
      //   $_SESSION['search-book'] = $_POST['search-book'];
      //   $_SESSION['category-book'] = $_POST['category-book'];
      // }
      // $total = $this->adminModel->getAllBook($_SESSION['search-book'], $_SESSION['category-book']);
      // $current_page = isset($_GET['page']) ? $_GET['page'] : 1;
      // $total_page = ceil(mysqli_num_rows($total) / $limit);
      // if ($current_page > $total_page) {
      //   $current_page = $total_page;
      // }
      // if ($current_page < 1) {
      //   $current_page = 1;
      // }
      // $start = ($current_page - 1) * $limit;
      // $listBook = mysqli_fetch_all($this->adminModel->getListBook($start, $limit, $_SESSION['sort-book'], $_SESSION['search-book'], $_SESSION['category-book']));
      // $listCategory = $this->adminModel->getAllCategory('');
      // return $this->loadview('admin.book', ['listBook' => $listBook, 'listCategory' => $listCategory, 'current_page' => $current_page, 'limit' => $limit, 'total_page' => $total_page]);
    if (isset($_SESSION['user']) && ($_SESSION['user']['roleAccess'] === '2' || $_SESSION['user']['roleAccess'] === '3')) {
      $limit = 5;
      $_SESSION['sort-report'] = isset($_SESSION['sort-report']) ? $_SESSION['sort-report'] : 'desc';
      $_SESSION['search-report'] = isset($_SESSION['search-report']) ? $_SESSION['search-report'] : '';
      if (isset($_POST['sort-report'])) {
        $_SESSION['sort-report'] = $_POST['sort-report'];
      }
      return $this->loadview('admin.contact');
    } else {
      header('Location: http://localhost/library/');
      exit();
    }
  }
  public function fecthGetReport($id) {
    $result = $this->adminModel->getReport($id);
    $data = [];
    if ($result) {
        $data = mysqli_fetch_assoc($result);
        header('Content-Type: application/json');
        echo json_encode($data);
    }
  }
  public function news()
  {
    if (isset($_SESSION['user']) && ($_SESSION['user']['roleAccess'] === '2' || $_SESSION['user']['roleAccess'] === '3')) {
      $limit = 15;
      $_SESSION['sort-news'] = isset($_SESSION['sort-news']) ? $_SESSION['sort-news'] : 'desc';
      $_SESSION['search-news'] = isset($_SESSION['search-news']) ? $_SESSION['search-news'] : '';
      if (isset($_POST['sort-news'])) {
        $_SESSION['sort-news'] = $_POST['sort-news'];
      }
      if (isset($_POST['search-news'])) {
        $_SESSION['search-news'] = $_POST['search-news'];
   
      }
      $total = $this->adminModel->getAllNews($_SESSION['search-news']);
      $current_page = isset($_GET['page']) ? $_GET['page'] : 1;
      $total_page = ceil(mysqli_num_rows($total) / $limit);
      if ($current_page > $total_page) {
        $current_page = $total_page;
      }
      if ($current_page < 1) {
        $current_page = 1;
      }
      $start = ($current_page - 1) * $limit;
      $listNews = $this->adminModel->getListNews($start, $limit, $_SESSION['sort-news'], $_SESSION['search-news']);
      return $this->loadview('admin.news', ['listNews' => $listNews, 'current_page' => $current_page, 'limit' => $limit, 'total_page' => $total_page]);
    } else {
      header('Location: http://localhost/library/');
      exit();
    }
  }
}

