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

      // Lựa chọn thống kê
      $_SESSION['chart_option'] = isset($_SESSION['chart_option']) ? $_SESSION['chart_option'] : 'chartReader';
      $_SESSION['chart_option'] = isset($_POST['chart_option']) ? $_POST['chart_option'] : $_SESSION['chart_option'];

      $chartData = null;

      switch ($_SESSION['chart_option']) {
        case 'chartBook':
          // Thống kê tài liệu
          $_SESSION['category_filter'] = isset($_SESSION['category_filter']) ? $_SESSION['category_filter'] : 'Sách khoa học';
          $_SESSION['category_filter'] = isset($_POST['category_filter']) ? $_POST['category_filter'] : $_SESSION['category_filter'];
          $chartData = $this->adminModel->countBookInStock();
          break;
        case 'chartReader':
          // Thống kê số lượng độc giả
          $_SESSION['sex_filter'] = isset($_SESSION['sex_filter']) ? $_SESSION['sex_filter'] : 'male';
          $_SESSION['sex_filter'] = isset($_POST['sex_filter']) ? $_POST['sex_filter'] : $_SESSION['sex_filter'];
          $_SESSION['grade_filter'] = isset($_SESSION['grade_filter']) ? $_SESSION['grade_filter'] : '9';
          $_SESSION['grade_filter'] = isset($_POST['grade_filter']) ? $_POST['grade_filter'] : $_SESSION['grade_filter'];
          $chartData = $this->adminModel->countReader();
          break;
        case 'chartRequest':
          // Thống kê số lượt mượn sách
          $_SESSION['years_filter'] = isset($_SESSION['years_filter']) ? $_SESSION['years_filter'] : '2024';
          $_SESSION['years_filter'] = isset($_POST['years_filter']) ? $_POST['years_filter'] : $_SESSION['years_filter'];
          $_SESSION['status_filter'] = isset($_SESSION['status_filter']) ? $_SESSION['status_filter'] : 'all';
          $_SESSION['status_filter'] = isset($_POST['status_filter']) ? $_POST['status_filter'] : $_SESSION['status_filter'];
          $chartData = $this->adminModel->countRequest($_SESSION['years_filter'], $_SESSION['status_filter']);
          break;
      }

      return $this->loadview('admin.home', ['chartData' => $chartData]);
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
      // $this->adminModel->denyRequest();
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

      foreach ($listBorrow as $detail) {
        $this->adminModel->updateRequestStatusIfOverdue($detail[0]);
      }

      if (isset($_POST['add-borrow'])) {
        $user = isset($_POST['user-id']) ? $_POST['user-id'] : ''; // Nhận mã số sinh viên
        $idBooks = isset($_POST['books']) ? json_decode($_POST['books'], true) : []; // Dữ liệu sách
        $time = date('Y/m/d H:i:s');
        $dayReturn = date('Y/m/d H:i:s', strtotime($time . ' + 7 days'));
        $requestedBooks = $this->adminModel->getRequestedBooks($user);

        // Lưu ID sách vào session
        if (!isset($_SESSION['selectedBooks'])) {
          $_SESSION['selectedBooks'] = [];
        }

        if (!is_array($idBooks)) {
          $idBooks = []; // Nếu không, khởi tạo thành mảng rỗng
        }

        // Đảm bảo rằng $_SESSION['selectedBooks'] là một mảng
        if (!isset($_SESSION['selectedBooks']) || !is_array($_SESSION['selectedBooks'])) {
          $_SESSION['selectedBooks'] = []; // Khởi tạo nếu không có
        }

        $_SESSION['selectedBooks'] = array_merge($_SESSION['selectedBooks'], $idBooks);

        $totalBooksToBorrow = count($_SESSION['selectedBooks']) + count($requestedBooks);

        if ($totalBooksToBorrow > 5) {
          unset($_SESSION['selectedBooks']);
          warning('Bạn chỉ có thể mượn tối đa 5 sách.', '');
          return $this->loadview('admin.borrow', ['listBorrow' => $listBorrow, 'listBook' => $listBook, 'listUser' => $listUser, 'current_page' => $current_page, 'limit' => $limit, 'total_page' => $total_page]);
        }

        // Kiểm tra trùng lặp sách
        $duplicates = [];
        foreach ($_SESSION['selectedBooks'] as $item) {
          if (in_array($item, $requestedBooks)) {
            $duplicates[] = $item;
          }
        }

        if (!empty($duplicates)) {
          // Nếu có sách trùng, không thực hiện yêu cầu
          unset($_SESSION['selectedBooks']);
          warning('Tồn tại sách đã mượn trước đó.', '');
          return $this->loadview('admin.borrow', ['listBorrow' => $listBorrow, 'listBook' => $listBook, 'listUser' => $listUser, 'current_page' => $current_page, 'limit' => $limit, 'total_page' => $total_page]);
        }

        // Không có sách trùng, thực hiện yêu cầu mượn
        $requestId = $this->adminModel->addBorrow($user); // Đảm bảo có ID người dùng

        foreach ($_SESSION['selectedBooks'] as $item) {
          $this->adminModel->addBorrowDetail($item, $requestId, $dayReturn);
          $this->adminModel->decreaseBookStock($item);
        }

        unset($_SESSION['selectedBooks']); // Xóa ID sách khỏi session

        success('Gửi yêu cầu mượn sách thành công', 'http://localhost/library/?controller=admin&action=borrow');
        return $this->loadview('admin.borrow', ['listBorrow' => $listBorrow, 'listBook' => $listBook, 'listUser' => $listUser, 'current_page' => $current_page, 'limit' => $limit, 'total_page' => $total_page]);
      }


      if (isset($_POST['edit-borrow'])) {
        $id = $_POST['id_borrow'];
        $statusBorrow = $_POST['status_borrow'];
        $time = date('Y-m-d H:i:s');
        $dayReturn = date('Y-m-d H:i:s', strtotime($time . ' + 7 days'));

        $updateSuccess = $this->adminModel->updateRequest($id, $statusBorrow);

        // Cập nhật trạng thái yêu cầu
        if ($updateSuccess) {
          if ($statusBorrow === '1') {
            $this->adminModel->updateBorrowDetails($id, 0, $dayReturn, NULL);
            success('Gửi yêu cầu mượn sách thành công', 'http://localhost/library/?controller=admin&action=borrow');
            return $this->loadview('admin.borrow', ['listBorrow' => $listBorrow, 'listBook' => $listBook, 'listUser' => $listUser, 'current_page' => $current_page, 'limit' => $limit, 'total_page' => $total_page]);
          } elseif ($statusBorrow === '0' || $statusBorrow === '4' || $statusBorrow === '5') {

            $this->adminModel->updateBorrowDetails($id, 'NULL', NULL, NULL);
            success('Gửi yêu cầu mượn sách thành công', 'http://localhost/library/?controller=admin&action=borrow');
            return $this->loadview('admin.borrow', ['listBorrow' => $listBorrow, 'listBook' => $listBook, 'listUser' => $listUser, 'current_page' => $current_page, 'limit' => $limit, 'total_page' => $total_page]);
          }
        } else {

          error('Cập nhật yêu cầu không thành công.', 'http://localhost/library/?controller=admin&action=borrow');
          return $this->loadview('admin.borrow', ['listBorrow' => $listBorrow, 'listBook' => $listBook, 'listUser' => $listUser, 'current_page' => $current_page, 'limit' => $limit, 'total_page' => $total_page]);
        }
      }

      return $this->loadview('admin.borrow', ['listBorrow' => $listBorrow, 'listBook' => $listBook, 'listUser' => $listUser, 'current_page' => $current_page, 'limit' => $limit, 'total_page' => $total_page]);

    } else {
      header('Location: http://localhost/library/');
      exit();
    }
  }

  public function borrow_detail()
  {
    $id = $_GET['id'];
    $getBorrowDetailInfo = $this->adminModel->getBorrowDetailInfo($id);
    $getBorrowDetail = $this->adminModel->getBorrowDetail($id);
    $this->adminModel->autoOverdue($id);


    if (isset($_POST['extendBorrow'])) {
      $extend = $this->adminModel->extendBorrowDetail($_POST['extendBorrow']);
      if ($extend === true) {
        success('Gia hạn thời hạn trả sách thêm 5 ngày', 'http://localhost/library/?controller=admin&action=borrow_detail&id=' . $id);
      } else {
        error('Gia hạn thất bại!', 'http://localhost/library/?controller=admin&action=borrow_detail&id=' . $id);
      }
      return $this->loadview('admin.borrowdetail', ['borrowDetail' => $getBorrowDetail, 'borrowDetailInfo' => $getBorrowDetailInfo]);
    }

    if (isset($_POST['update-statusBorrowDetail'])) {
      $newStatus = $_POST['status_borrow']; // Trạng thái mới từ form
      $returnDate = $_POST['returnDate'];
      $idRequestDetail = $_POST['idRequestDetail'];
      $idBook = $_POST['idBook'];

      // Cập nhật trạng thái và due_Date
      $dueDate = $newStatus === '1' ? date('Y-m-d H:i:s') : null;
      $updateSuccess = $this->adminModel->updateBorrowDetail($idRequestDetail, $newStatus, $returnDate, $dueDate);

      if ($updateSuccess) {
        if ($newStatus === '1') { // Giả sử '1' là trạng thái "đã trả"
          $this->adminModel->increaseBookStock($idBook); // Tăng số lượng sách trong kho
        } elseif ($newStatus === '0') { // Giả sử '0' là trạng thái "chưa trả"
          $this->adminModel->decreaseBookStock($idBook); // Giảm số lượng sách trong kho
        }

        // Lấy lại thông tin chi tiết để kiểm tra trạng thái mới
        $getBorrowDetail = $this->adminModel->getBorrowDetail($id);

        // Kiểm tra lại trạng thái tổng thể
        $hasNotReturnedBook = false; // Reset flag
        foreach ($getBorrowDetail as $detail) {
          if ($detail['statusRD'] === '0') { // Nếu có quyển chưa trả
            $hasNotReturnedBook = true;
            break;
          }
        }
        // Cập nhật lại trạng thái tổng thể
        $overallStatus = $hasNotReturnedBook ? '1' : '2'; // '1' là Đã duyệt, '2' là Hoàn thành
        $this->adminModel->updateRequest($id, $overallStatus);

        success('Cập nhật trạng thái thành công!', 'http://localhost/library/?controller=admin&action=borrow_detail&id=' . $id);
      } else {
        error('Cập nhật trạng thái thất bại!', 'http://localhost/library/?controller=admin&action=borrow_detail&id=' . $id);
      }

    }
    $this->loadview('admin.borrowdetail', ['borrowDetail' => $getBorrowDetail, 'borrowDetailInfo' => $getBorrowDetailInfo]);
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
    if (isset($_SESSION['user']) && ($_SESSION['user']['roleAccess'] === '2' || $_SESSION['user']['roleAccess'] === '3')) {
      $limit = 5;
      $_SESSION['sort-report'] = isset($_SESSION['sort-report']) ? $_SESSION['sort-report'] : 'desc';
      $_SESSION['search-report'] = isset($_SESSION['search-report']) ? $_SESSION['search-report'] : '';
      if (isset($_POST['sort-report'])) {
        $_SESSION['sort-report'] = $_POST['sort-report'];
      }
      if (isset($_POST['search-report'])) {
        $_SESSION['search-report'] = $_POST['search-report'];
      }
      $total = $this->adminModel->getAllReport($_SESSION['search-report']);


      $current_page = isset($_GET['page']) ? $_GET['page'] : 1;
      $total_page = ceil(mysqli_num_rows($total) / $limit);
      if ($current_page > $total_page) {
        $current_page = $total_page;
      }
      if ($current_page < 1) {
        $current_page = 1;
      }
      $start = ($current_page - 1) * $limit;
      $listReport = mysqli_fetch_all($this->adminModel->getListReport($start, $limit, $_SESSION['sort-report'], $_SESSION['search-report']));
      return $this->loadview('admin.contact', ['listReport' => $listReport, 'current_page' => $current_page, 'limit' => $limit, 'total_page' => $total_page]);
    } else {
      header('Location: http://localhost/library/');
      exit();
    }
  }
  // public function fecthgetreport() {
  //   header('Content-Type: application/json');
  //   $id = $_POST['id']; // Giả sử bạn lấy id từ POST
  //   $result = $this->adminModel->getReport($id);

  //   if ($result) {
  //       echo json_encode($result);
  //   } else {
  //       echo json_encode(['error' => 'Không tìm thấy báo cáo']);
  //   }
  // }
  public function news()
  {
    if (isset($_SESSION['user']) && ($_SESSION['user']['roleAccess'] === '2' || $_SESSION['user']['roleAccess'] === '3')) {
      $limit = 5;
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

  public function fine()
  {
    if (isset($_SESSION['user']) && ($_SESSION['user']['roleAccess'] === '2' || $_SESSION['user']['roleAccess'] === '3')) {
      $limit = 15;
      $_SESSION['sort-fine'] = isset($_SESSION['sort-fine']) ? $_SESSION['sort-fine'] : 'desc';
      $_SESSION['search-fine'] = isset($_SESSION['search-fine']) ? $_SESSION['search-fine'] : '';
      if (isset($_POST['sort-fine'])) {
        $_SESSION['sort-fine'] = $_POST['sort-fine'];
      }
      if (isset($_POST['search-fine'])) {
        $_SESSION['search-fine'] = $_POST['search-fine'];

      }
      $total = $this->adminModel->getAllFine($_SESSION['search-fine']);
      $current_page = isset($_GET['page']) ? $_GET['page'] : 1;
      $total_page = ceil(mysqli_num_rows($total) / $limit);
      if ($current_page > $total_page) {
        $current_page = $total_page;
      }
      if ($current_page < 1) {
        $current_page = 1;
      }
      $start = ($current_page - 1) * $limit;
      $listFine = $this->adminModel->getListFine($start, $limit, $_SESSION['sort-fine'], $_SESSION['search-fine']);
      $listUser = $this->adminModel->getListFineOfUser();
      $listRequest = $this->adminModel->getListRequest();
      return $this->loadview('admin.fine', ['listFine' => $listFine, 'listUser' => $listUser, 'listRequest' => $listRequest, 'current_page' => $current_page, 'limit' => $limit, 'total_page' => $total_page]);
    } else {
      header('Location: http://localhost/library/');
      exit();
    }
  }
}

