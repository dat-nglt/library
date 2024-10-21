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
          <i class="fa-solid fa-house-chimney" style="font-size: 15px"></i>
        </a>
        <a class="menu-item" href="">
          Tra cứu tài liệu
        </a>
        <a class="menu-item" href="?controller=user&action=upload">
          Upload tài liệu số
        </a>
        <!-- <a class="menu-item" href="?controller=user&action=profile&profilePage=rentHistory">
          Yêu cầu tài liệu
        </a> -->
        <!-- <a class="menu-item" href="">
          danh sách tài liệu
        </a> -->
        <a class="menu-item" href="?controller=user&action=contact">
          liên hệ
        </a>

      </div>
      <div class="header-login">
        <?php
        if (isset($_SESSION['user'])) {

          echo '
        <div class="rent-sticket">
          <a class="menu-item" href="http://localhost/library/?controller=user&action=rentSticket">
            Giỏ sách
            <div>
            <p>99</p>
            </div>
          </a>
        </div>
          ';
          echo '<a class="menu-item" href="?controller=user&action=profile&profilePage=infoUser">' . $_SESSION['user']['studentCode'] . '</a>';
        } else {
          echo '<a class="menu-item" href="?controller=user&action=login">Đăng nhập</a>';
        }
        ?>
      </div>
    </div>
  </div>
</div>
<style>
  .header.top {
    padding: 12px;
    background-color: var(--white-color);
  }

  .header-top-text {
    color: #264480;
    display: flex;
    flex-direction: column;
    gap: 5px;
    text-transform: uppercase;
  }

  .header-top-text>p {
    font-size: 15px;
    font-weight: 700;
  }

  .header-top-text>strong {
    font-size: 20px;
    font-weight: 800;
  }

  .sub-header-top {
    display: flex;
    align-items: center;
    width: 95%;
    margin: 0 auto;
    gap: 20px;
  }

  .sub-header-top .header-top-img img {
    height: 70px;
    aspect-ratio: 1 /1;
  }

  .header.bottom {
    position: sticky;
    top: -1px;
    background: var(--green-color);
  }

  .sub-header-bottom {
    display: flex;
    align-items: center;
    justify-content: space-between;
    width: 90%;
    margin: 0 auto;

  }

  .menu {
    display: flex;
    justify-content: space-between;
    gap: 30px;
    align-items: center;
  }

  .menu-item {
    padding: 15px 0;
    color: var(--white-color);
    font-size: 13px;
    text-transform: uppercase;
    font-weight: 700;
  }

  .menu-item:hover {
    color: var(--orange-color);
    transition: color 0.2s ease;
  }

  .header-login {
    display: flex;
    align-items: center;
    gap: 60px;
  }

  .rent-sticket {
    display: flex;
    position: relative;

    > a > div {
      display: flex;
      align-items: center;
      justify-content: center;
      font-weight: 500;
      position: absolute;
      background: red;
      min-width: 15px;
      height: 15px;
      border-radius: 50%;
      color: #fff;
      right: -25px;
      top: 5px;
      padding: 10px 5px ;

      >p {
        font-size: 10px;
      }
    }
  }
</style>