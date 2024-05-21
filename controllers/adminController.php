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
      ;
      if ($infoUserPrev = mysqli_fetch_assoc($this->adminModel->checkUserWithId($id))) {
        if($infoUserPrev['studentCode'] === $studentCode){
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
            if(mysqli_num_rows($this->adminModel->checkUserWithIdentificationNumber($identificationNumber)) > 0){
              $this->loadview('admin.account', ['listAccount' => $listAccount, 'current_page' => $current_page, 'limit' => $limit, 'total_page' => $total_page]);
              warning('Số căn cước công dân đã tồn tại!', '?controller=admin&action=account&page=' . $current_page);
          }else{
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
        }else {
          if(mysqli_num_rows($this->adminModel->checkUserWithStudentCode($studentCode)) > 0){
            $this->loadview('admin.account', ['listAccount' => $listAccount, 'current_page' => $current_page, 'limit' => $limit, 'total_page' => $total_page]);
            warning('Mã số sinh viên đã tồn tại!', '?controller=admin&action=account&page=' . $current_page);
          }else{
            if (($infoUserPrev['identificationNumber'] === $identificationNumber)) {
              $update = $this->adminModel->updateUser($id, $studentCode, $password, $fullName, $dateOfBirth, $address, $phoneNumber, $email, $identificationNumber, $class);
              if ($update) {
                $this->loadview('admin.account', ['listAccount' => $listAccount, 'current_page' => $current_page, 'limit' => $limit, 'total_page' => $total_page]);
                success('Cập nhật tài khoản thành công!', '?controller=admin&action=account&page=' . $current_page);
              } else {
                $this->loadview('admin.account', ['listAccount' => $listAccount, 'current_page' => $current_page, 'limit' => $limit, 'total_page' => $total_page]);
                error('Cập nhật tài khoản thất bại!', '?controller=admin&action=account&page=' . $current_page);
              }
            }else{
              if(mysqli_num_rows($this->adminModel->checkUserWithIdentificationNumber($identificationNumber)) > 0){
                $this->loadview('admin.account', ['listAccount' => $listAccount, 'current_page' => $current_page, 'limit' => $limit, 'total_page' => $total_page]);
                warning('Số căn cước công dân đã tồn tại!', '?controller=admin&action=account&page=' . $current_page);
              }else{
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
      }else {
        $this->loadview('admin.account', ['listAccount' => $listAccount, 'current_page' => $current_page, 'limit' => $limit, 'total_page' => $total_page]);
        error('Không thể cập nhật người dùng!', '?controller=admin&action=account&page=' . $current_page);
      } 
      exit();
    }
    return $this->loadview('admin.account', ['listAccount' => $listAccount, 'current_page' => $current_page, 'limit' => $limit, 'total_page' => $total_page]);
  }

  public function category()
  {
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
  }

  public function book()
  {
    $limit = 15;
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
  }

  public function borrow()
  {
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
    $total = $this->adminModel->getAllBorrow($_SESSION['search-borrow'],$_SESSION['status-borrow']);
    $current_page = isset($_GET['page']) ? $_GET['page'] : 1;
    $total_page = ceil(mysqli_num_rows($total) / $limit);
    if ($current_page > $total_page) {
      $current_page = $total_page;
    }
    if ($current_page < 1) {
      $current_page = 1;
    }
    $start = ($current_page - 1) * $limit;
    $listBorrow = mysqli_fetch_all($this->adminModel->getListBorrow($start, $limit, $_SESSION['sort-borrow'], $_SESSION['search-borrow'],$_SESSION['status-borrow']));
    $listBook = $this->adminModel->getAllBook('', 'all');
    // if (isset($_POST['add_Borrow-handmade'])) {
    //   $BorrowName = $_POST['Borrow_name'];
    //   if (mysqli_num_rows($this->adminModel->checkBorrowWithName($BorrowName)) < 1) {
    //       $add = $this->adminModel->addBorrow($BorrowName);
    //       if ($add) {
    //         $this->loadview('admin.Borrow', ['listBorrow' => $listBorrow, 'current_page' => $current_page, 'limit' => $limit, 'total_page' => $total_page]);
    //         success('Thêm thể loại thành công!', '?controller=admin&action=Borrow&page=' . $current_page);
    //       } else {
    //         $this->loadview('admin.Borrow', ['listBorrow' => $listBorrow, 'current_page' => $current_page, 'limit' => $limit, 'total_page' => $total_page]);
    //         error('Thêm thể loại thất bại!', '?controller=admin&action=Borrow&page=' . $current_page);
    //       }
    //   } else {
    //     $this->loadview('admin.Borrow', ['listBorrow' => $listBorrow, 'current_page' => $current_page, 'limit' => $limit, 'total_page' => $total_page]);
    //     warning('Tên thể loại đã tồn tại!', '?controller=admin&action=Borrow&page=' . $current_page);
    //   }
    //   exit();
    // }
    // if (isset($_POST['edit_Borrow-handmade'])) {
    //   $id = $_POST['Borrow_id'];
    //   $name = $_POST['Borrow_name'];
    //  if ($checkName = mysqli_fetch_assoc($this->adminModel->checkBorrowWithId($id))) {
    //   if ($checkName['nameBorrow'] === $name) {
    //     $edit = $this->adminModel->updateBorrow($id, $name);
    //     if ($edit) {
    //       $this->loadview('admin.Borrow', ['listBorrow' => $listBorrow, 'current_page' => $current_page, 'limit' => $limit, 'total_page' => $total_page]);
    //       success('Chỉnh sửa thể loại thành công!', '?controller=admin&action=Borrow&page=' . $current_page);
    //     } else {
    //       $this->loadview('admin.Borrow', ['listBorrow' => $listBorrow, 'current_page' => $current_page, 'limit' => $limit, 'total_page' => $total_page]);
    //       error('Chỉnh sửa thể loại thất bại!', '?controller=admin&action=Borrow&page=' . $current_page);
    //     }
    //   } else {
    //     if (mysqli_num_rows($this->adminModel->checkBorrowWithName($name)) > 0) {
    //       $this->loadview('admin.Borrow', ['listBorrow' => $listBorrow, 'current_page' => $current_page, 'limit' => $limit, 'total_page' => $total_page]);
    //       warning('Tên thể loại đã tồn tại!', '?controller=admin&action=Borrow&page=' . $current_page);
    //     } else {
    //       $edit = $this->adminModel->updateBorrow($id, $name);
    //       if ($edit) {
    //         $this->loadview('admin.Borrow', ['listBorrow' => $listBorrow, 'current_page' => $current_page, 'limit' => $limit, 'total_page' => $total_page]);
    //         success('Chỉnh sửa thể loại thành công!', '?controller=admin&action=Borrow&page=' . $current_page);
    //       } else {
    //         $this->loadview('admin.Borrow', ['listBorrow' => $listBorrow, 'current_page' => $current_page, 'limit' => $limit, 'total_page' => $total_page]);
    //         error('Chỉnh sửa thể loại thất bại!', '?controller=admin&action=Borrow&page=' . $current_page);
    //       }
    //     }
    //   }
    // }
    //   exit();
    // }
    return $this->loadview('admin.borrow', ['listBorrow' => $listBorrow, 'listBook' => $listBook, 'current_page' => $current_page, 'limit' => $limit, 'total_page' => $total_page]);
  }

}

