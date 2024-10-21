<div class="profile">
  <div class="profile-box">
    <div class="profile__container">
      <div class="profile__menu">
        <div id="profile__title"> Hồ sơ bạn đọc</div>
        <a href="?controller=user&action=profile&profilePage=infoUser" class="profile__menu-option <?php if ((isset($_GET['profilePage']) && $_GET['profilePage'] == 'infoUser')) {
          echo 'profile__menu-option--active';
        } ?>">
          Thông tin cá nhân
        </a>
        <a href="?controller=user&action=profile&profilePage=rentHistory" class="profile__menu-option <?php if ((isset($_GET['profilePage']) && $_GET['profilePage'] == 'rentHistory')) {
          echo 'profile__menu-option--active';
        } ?>">
          Lịch sử mượn sách
        </a>
        <a href="?controller=user&action=profile&profilePage=changePassword" class="profile__menu-option <?php if ((isset($_GET['profilePage']) && $_GET['profilePage'] == 'changePassword')) {
          echo 'profile__menu-option--active';
        } ?>">
          Đổi mật khẩu
        </a>

        <?php
        if ($_SESSION['user']['roleAccess'] == 2) {
          echo '<a href="?controller=admin" class="profile__menu-option">
            Quản trị viên
          </a>';
        }
        ?>
        <a href="?controller=user&action=logout" class="profile__menu-option">
          Đăng xuất
        </a>
      </div>
      <?php
      if (isset($_GET['profilePage'])) {
        $profilePage = $_GET['profilePage'];
        require './views/user/profile/' . $profilePage . '.php';
      } else {
        require './views/user/profile/infoUser.php';
      }
      ?>
    </div>
  </div>
</div>

<script src="./js/user/profile.js"></script>

<style>
  .profile-box {
    padding: 20px;
    overflow: hidden;
    width: 90%;
    margin: 0 auto;
    background-color: #fff;
    box-shadow: 0px 0px 20px 10px rgba(0, 0, 0, 0.3);
  }

  #profile__title {
    padding: 15px;
    font-weight: 600;
    color: #ffffff;
    font-size: 16px;
    background: var(--green-color);
    text-transform: uppercase;
  }

  .profile__container {
    display: flex;
    gap: 30px;
  }

  .profile__menu {
    display: flex;
    min-width: 200px;
    flex-direction: column;
    border: 1px solid var(--gray-white-cl);
    font-size: 18px;
  }

  .profile .content {
    border: 1px solid var(--gray-white-cl);
    width: 1000px;
    height: fit-content;
    min-height: 515px;
  }

  .profile__menu-option {
    padding: 15px 10px;
    font-size: 17px;
  }

  .profile__menu>a {
    color: var(--black-cl);
  }

  .profile__menu-option:hover {
    cursor: pointer;
    background: #4ea25e;
  }

  .profile__menu a:hover {
    color: #fff;
  }

  .profile__menu-option--active {
    background: #4ea25e;
  }

  .profile__menu-option--active {
    color: #fff !important;
    /* Màu chữ xanh lá cây */
  }
</style>