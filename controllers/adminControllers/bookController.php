<?php
class bookController extends baseController{

    private $bookModel;
    private $categoryModel;
    public function __construct()
    {
        $this->loadModel('bookModel');
        $this->bookModel = new bookModel;
        $this->loadModel('categoryModel');
        $this->categoryModel = new categoryModel;
    }
    public function index()
    {
      if (isset($_SESSION['user']) && ($_SESSION['user']['roleAccess'] === '2' || $_SESSION['user']['roleAccess'] === '3')) {
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
        $total = $this->bookModel->getAllBookAdmin($_SESSION['search-book'], $_SESSION['category-book']);
        $current_page = isset($_GET['page']) ? $_GET['page'] : 1;
        $total_page = ceil(mysqli_num_rows($total) / $limit);
        if ($current_page > $total_page) {
          $current_page = $total_page;
        }
        if ($current_page < 1) {
          $current_page = 1;
        }
        $start = ($current_page - 1) * $limit;
        $listBook = mysqli_fetch_all($this->bookModel->getListBook($start, $limit, $_SESSION['sort-book'], $_SESSION['search-book'], $_SESSION['category-book']));
        $listCategory = $this->categoryModel->getAllCategory('');
        return $this->loadView('admin.book', ['listBook' => $listBook, 'listCategory' => $listCategory, 'current_page' => $current_page, 'limit' => $limit, 'total_page' => $total_page]);
      } else {
        header('Location: http://localhost/library/');
        exit();
      }
    }
}