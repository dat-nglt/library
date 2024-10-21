<header class="header__nav">
    <div>
        <a href="http://localhost/library/"><img src="https://res.cloudinary.com/di37whq60/image/upload/v1716201697/image/wclgegomv1fipqoujanr.png" alt=""><span>
                TRUNG TÂM HỌC LIỆU</span></a>
    </div>
    <ul>
        <a href="?controller=admin&action=dashboard">
            <li><i class="fa-solid fa-house icon"></i>Trang chủ</li>
        </a>
        <a href="?controller=admin&action=account">
            <li><i class="fa-solid fa-user-group icon"></i>Tài khoản</li>
        </a>
        <a href="?controller=admin&action=category">
            <li><i class="fa-solid fa-list icon"></i>Thể loại</li>
        </a>
        <a href="?controller=admin&action=book">
            <li><i class="fa-solid fa-book icon"></i>Sách</li>
        </a>
        <a href="?controller=admin&action=borrow">
            <li><i class="fa-solid fa-file-lines icon"></i>Mượn | Trả</li>
        </a>
        <a href="?controller=admin&action=upload">
            <li><i class="fa-solid fa-file-arrow-up icon"></i>Upload</li>
        </a>
        <a href="?controller=admin&action=punish">
            <li><i class="fa-solid fa-dollar-sign icon"></i>Phí phạt</li>
        </a>
        <a href="?controller=admin&action=contact">
            <li><i class="fa-solid fa-file-contract icon"></i></i>Phản hồi</li>
        </a>
        <?php   if(isset($_SESSION['user']) &&  $_SESSION['user']['roleAccess'] === '3' ){ ?>
            <a href="?controller=admin&action=librarian">
                <li><i class="fa-solid fa-people-roof icon"></i>Thủ thư</li>
            </a>
        <?php }?>
        <a href="?controller=user&action=logout">
            <li><i class="fa-solid fa-right-to-bracket fa-rotate-180 icon"></i> Đăng xuất</li>
        </a>
    </ul>
</header>

<script src="./js/admin/checkCurrentPage.js"></script>