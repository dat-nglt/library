<?php
class categoryController extends baseController{

    private $categoryModel;
    public function __construct()
    {
        $this->loadModel('categoryModel');
        $this->categoryModel = new categoryModel;
    }
    public function index()
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
      $total = $this->categoryModel->getAllCategory($_SESSION['search-category']);
      $current_page = isset($_GET['page']) ? $_GET['page'] : 1;
      $total_page = ceil(mysqli_num_rows($total) / $limit);
      if ($current_page > $total_page) {
        $current_page = $total_page;
      }
      if ($current_page < 1) {
        $current_page = 1;
      }
      $start = ($current_page - 1) * $limit;
      $listCategory = mysqli_fetch_all($this->categoryModel->getListCategory($start, $limit, $_SESSION['sort-category'], $_SESSION['search-category']));
      if (isset($_POST['add_category-handmade'])) {
        $categoryName = $_POST['category_name'];
        if (mysqli_num_rows($this->categoryModel->checkCategoryWithName($categoryName)) < 1) {
          $add = $this->categoryModel->addCategory($categoryName);
          if ($add) {
            $this->loadView('admin.category', ['listCategory' => $listCategory, 'current_page' => $current_page, 'limit' => $limit, 'total_page' => $total_page]);
            success('Thêm thể loại thành công!', '?controller=admin&action=category&page=' . $current_page);
          } else {
            $this->loadView('admin.category', ['listCategory' => $listCategory, 'current_page' => $current_page, 'limit' => $limit, 'total_page' => $total_page]);
            error('Thêm thể loại thất bại!', '?controller=admin&action=category&page=' . $current_page);
          }
        } else {
          $this->loadView('admin.category', ['listCategory' => $listCategory, 'current_page' => $current_page, 'limit' => $limit, 'total_page' => $total_page]);
          warning('Tên thể loại đã tồn tại!', '?controller=admin&action=category&page=' . $current_page);
        }
        exit();
      }
      if (isset($_POST['edit_category-handmade'])) {
        $id = $_POST['category_id'];
        $name = $_POST['category_name'];
        if ($checkName = mysqli_fetch_assoc($this->categoryModel->checkCategoryWithId($id))) {
          if ($checkName['nameCategory'] === $name) {
            $edit = $this->categoryModel->updateCategory($id, $name);
            if ($edit) {
              $this->loadView('admin.category', ['listCategory' => $listCategory, 'current_page' => $current_page, 'limit' => $limit, 'total_page' => $total_page]);
              success('Chỉnh sửa thể loại thành công!', '?controller=admin&action=category&page=' . $current_page);
            } else {
              $this->loadView('admin.category', ['listCategory' => $listCategory, 'current_page' => $current_page, 'limit' => $limit, 'total_page' => $total_page]);
              error('Chỉnh sửa thể loại thất bại!', '?controller=admin&action=category&page=' . $current_page);
            }
          } else {
            if (mysqli_num_rows($this->categoryModel->checkCategoryWithName($name)) > 0) {
              $this->loadView('admin.category', ['listCategory' => $listCategory, 'current_page' => $current_page, 'limit' => $limit, 'total_page' => $total_page]);
              warning('Tên thể loại đã tồn tại!', '?controller=admin&action=category&page=' . $current_page);
            } else {
              $edit = $this->categoryModel->updateCategory($id, $name);
              if ($edit) {
                $this->loadView('admin.category', ['listCategory' => $listCategory, 'current_page' => $current_page, 'limit' => $limit, 'total_page' => $total_page]);
                success('Chỉnh sửa thể loại thành công!', '?controller=admin&action=category&page=' . $current_page);
              } else {
                $this->loadView('admin.category', ['listCategory' => $listCategory, 'current_page' => $current_page, 'limit' => $limit, 'total_page' => $total_page]);
                error('Chỉnh sửa thể loại thất bại!', '?controller=admin&action=category&page=' . $current_page);
              }
            }
          }
        }
        exit();
      }
      return $this->loadView('admin.category', ['listCategory' => $listCategory, 'current_page' => $current_page, 'limit' => $limit, 'total_page' => $total_page]);
    } else {
      header('Location: http://localhost/library/');
      exit();
    }
  }
}