<div id="header-for-all">
  <div class="header top">
    <div class="sub-header-top">
      <div class="header-top-img"><img src="./upload/logo.png" alt=""></div>
      <div class="header-top-text">
        <p>Trung tâm học liệu</p>
        <strong>Trường đại học kỹ thuật - công nghệ cần thơ</strong>
      </div>
    </div>
  </div>
  <div class="header bottom">
    <div class="sub-header-bottom">
      <div class="menu">
        <a class="menu-item" href="/library">
          <i class="fa-solid fa-house-chimney" style="font-size: 20px"></i>
        </a>
        <a class="menu-item" href="">
          Tra cứu tài liệu
        </a>
        <a class="menu-item" href="?controller=user&action=upload">
          Upload tài liệu số
        </a>
        <a class="menu-item" href="?controller=user&action=profile&profilePage=rentHistory">
          Yêu cầu tài liệu
        </a>
        <a class="menu-item" href="">
          danh sách tài liệu
        </a>
        <a class="menu-item" href="">
          liên hệ
        </a>
      </div>
      <div class="header-login">
        <?php
        if (isset($_SESSION['user'])) {
          echo '<a class="menu-item" href="?controller=user&action=profile&profilePage=infoUser">' . $_SESSION['user']['studentCode'] . '</a>';
        } else {
          echo '<a class="menu-item" href="?controller=user&action=login">Đăng nhập</a>';
        }
        ?>
      </div>
    </div>
  </div>
</div>