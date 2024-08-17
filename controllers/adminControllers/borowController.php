<?php
class borrowController extends baseController{

    private $borrowModel;
    private $bookModel;
    private $accountModel;
    private $categoryModel;

    public function __construct()
    {
        $this->loadModel('borrowModel');
        $this->borrowModel = new borrowModel;
        $this->loadModel('bookModel');
        $this->bookModel = new bookModel;
        $this->loadModel('accountModel');
        $this->accountModel = new accountModel;
        $this->loadModel('categoryModel');
        $this->categoryModel = new categoryModel;
    }
    public function index()
    {
      if (isset($_SESSION['user']) && ($_SESSION['user']['roleAccess'] === '2' || $_SESSION['user']['roleAccess'] === '3')) {
        $this->borrowModel->denyRequests();
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
  
        $total = $this->borrowModel->getAllBorrow($_SESSION['search-borrow'], $_SESSION['status-borrow']);
        $current_page = isset($_GET['page']) ? $_GET['page'] : 1;
        $total_page = ceil(mysqli_num_rows($total) / $limit);
  
        if ($current_page > $total_page) {
          $current_page = $total_page;
        }
  
        if ($current_page < 1) {
          $current_page = 1;
        }
  
        $start = ($current_page - 1) * $limit;
        $listBorrow = mysqli_fetch_all($this->borrowModel->getListBorrow($start, $limit, $_SESSION['sort-borrow'], $_SESSION['search-borrow'], $_SESSION['status-borrow']));
        $listBook = $this->bookModel->getAllBookAdmin('', 'all');
        $listUser = $this->accountModel->getAllUser('');
        if (isset($_POST['add-borrow'])) {
          $idUser = $_POST['user_borrow'];
          $idBook = $_POST['book_borrow'];
          $time = date('Y/m/d');
          $dayReturn = date('Y/m/d', strtotime($time . ' + 7 days'));
          if (mysqli_num_rows($this->borrowModel->checkUserBorrow($idUser)) < 10) {
            $add = $this->borrowModel->addBorrow($idUser, $idBook, $time, $dayReturn);
            if ($add) {
              $book = $this->bookModel->minusCountBook($idBook);
              if (!$book) {
                $this->loadView('admin.borrow', ['listBorrow' => $listBorrow, 'listBook' => $listBook, 'listUser' => $listUser, 'current_page' => $current_page, 'limit' => $limit, 'total_page' => $total_page]);
                error('Lỗi khi giảm số lượng sách có trong thư viện', '?controller=admin&action=borrow&page=' . $current_page);
              }
              $this->loadView('admin.borrow', ['listBorrow' => $listBorrow, 'listBook' => $listBook, 'listUser' => $listUser, 'current_page' => $current_page, 'limit' => $limit, 'total_page' => $total_page]);
              success('Thêm phiếu mượn thành công!', '?controller=admin&action=borrow&page=' . $current_page);
            } else {
              $this->loadView('admin.borrow', ['listBorrow' => $listBorrow, 'listBook' => $listBook, 'listUser' => $listUser, 'current_page' => $current_page, 'limit' => $limit, 'total_page' => $total_page]);
              error('Thêm phiếu mượn thất bại!', '?controller=admin&action=borrow&page=' . $current_page);
            }
          } else {
            $this->loadView('admin.borrow', ['listBorrow' => $listBorrow, 'listBook' => $listBook, 'listUser' => $listUser, 'current_page' => $current_page, 'limit' => $limit, 'total_page' => $total_page]);
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
            $edit = $this->borrowModel->editBorrow($id, $user, $book, $statusBorrow, $time, $dayReturn);
            if ($edit) {
              if ($statusBorrow === '1') {
                $book = $this->bookModel->minusCountBook($book);
                if (!$book) {
                  $this->loadView('admin.borrow', ['listBorrow' => $listBorrow, 'listBook' => $listBook, 'listUser' => $listUser, 'current_page' => $current_page, 'limit' => $limit, 'total_page' => $total_page]);
                  error('Lỗi khi giảm số lượng sách có trong thư viện', '?controller=admin&action=borrow&page=' . $current_page);
                }
              }
              $this->loadView('admin.borrow', ['listBorrow' => $listBorrow, 'listBook' => $listBook, 'listUser' => $listUser, 'current_page' => $current_page, 'limit' => $limit, 'total_page' => $total_page]);
              success('Chỉnh sửa thành công!', '?controller=admin&action=borrow&page=' . $current_page);
            } else {
              $this->loadView('admin.borrow', ['listBorrow' => $listBorrow, 'listBook' => $listBook, 'listUser' => $listUser, 'current_page' => $current_page, 'limit' => $limit, 'total_page' => $total_page]);
              error('Chỉnh sửa thất bại!', '?controller=admin&action=borrow&page=' . $current_page);
            }
          } else {
            $edit = $this->borrowModel->editBorrow($id, $user, $book, $statusBorrow, '', '');
            if ($edit) {
              if ($statusBorrow === '2') {
                $book = $this->bookModel->plusCountBook($book);
                if (!$book) {
                  $this->loadView('admin.borrow', ['listBorrow' => $listBorrow, 'listBook' => $listBook, 'listUser' => $listUser, 'current_page' => $current_page, 'limit' => $limit, 'total_page' => $total_page]);
                  error('Lỗi khi tăng số lượng sách có trong thư viện', '?controller=admin&action=borrow&page=' . $current_page);
                }
              }
              $this->loadView('admin.borrow', ['listBorrow' => $listBorrow, 'listBook' => $listBook, 'listUser' => $listUser, 'current_page' => $current_page, 'limit' => $limit, 'total_page' => $total_page]);
              success('Chỉnh sửa thành công!3523', '?controller=admin&action=borrow&page=' . $current_page);
            } else {
              $this->loadView('admin.borrow', ['listBorrow' => $listBorrow, 'listBook' => $listBook, 'listUser' => $listUser, 'current_page' => $current_page, 'limit' => $limit, 'total_page' => $total_page]);
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
          $edit = $this->borrowModel->editBorrow($id, $user, $book, $statusBorrow, '', $dayReturn);
          if ($edit) {
            $this->loadView('admin.borrow', ['listBorrow' => $listBorrow, 'listBook' => $listBook, 'listUser' => $listUser, 'current_page' => $current_page, 'limit' => $limit, 'total_page' => $total_page]);
            success('Gia hạn thành công!', '?controller=admin&action=borrow&page=' . $current_page);
          } else {
            $this->loadView('admin.borrow', ['listBorrow' => $listBorrow, 'listBook' => $listBook, 'listUser' => $listUser, 'current_page' => $current_page, 'limit' => $limit, 'total_page' => $total_page]);
            error('Gia hạn thất bại!', '?controller=admin&action=borrow&page=' . $current_page);
          }
          exit();
        }
        return $this->loadView('admin.borrow', ['listBorrow' => $listBorrow, 'listBook' => $listBook, 'listUser' => $listUser, 'current_page' => $current_page, 'limit' => $limit, 'total_page' => $total_page]);
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
      $total = $this->bookModel->getAllUpload($_SESSION['search-upload'], $_SESSION['category-upload']);
      $current_page = isset($_GET['page']) ? $_GET['page'] : 1;
      $total_page = ceil(mysqli_num_rows($total) / $limit);
      if ($current_page > $total_page) {
        $current_page = $total_page;
      }
      if ($current_page < 1) {
        $current_page = 1;
      }
      $listBook = mysqli_fetch_all($this->bookModel->getNameBook());
      $start = ($current_page - 1) * $limit;
      $listUpload = $this->bookModel->getListUpload($start, $limit, $_SESSION['sort-upload'], $_SESSION['search-upload'], $_SESSION['category-upload']);
      $listCategory = $this->categoryModel->getAllCategory('');
      $getNameCategory = mysqli_fetch_all($this->categoryModel->getAllCategory(''));
      return $this->loadView('admin.upload', ['getNameCategory' => $getNameCategory, 'listBook' => $listBook, 'listUpload' => $listUpload, 'listCategory' => $listCategory, 'current_page' => $current_page, 'limit' => $limit, 'total_page' => $total_page]);
    } else {
      header('Location: http://localhost/library/');
      exit();
    }
  }

}