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
          Lịch sử mượn
        </a>
        <a href="?controller=user&action=profile&profilePage=changePassword" class="profile__menu-option <?php if ((isset($_GET['profilePage']) && $_GET['profilePage'] == 'changePassword')) {
          echo 'profile__menu-option--active';
        } ?>">
          Đổi mật khẩu
        </a>
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