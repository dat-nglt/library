<div class="content">
<div id="profile__title">Thông tin cá nhân</div>

  <div class="avatar-box">
    </main>
  </div>
  <div id="profile-box">
    <div class="sub-profile-box">
      <div class="info-fields">
        <label for="">Mã độc giả</label>
        <input type="text" disabled value="<?= $_SESSION['user']['studentCode'] ?>">
      </div>
      <div class="info-fields">
        <label for="">Họ và tên</label>
        <input type="text" disabled value="<?= $_SESSION['user']['fullName'] ?>">
      </div>
    </div>
    <div class="sub-profile-box">
      <div class="info-fields">
        <label for="">Chi đoàn</label>
        <input type="text" disabled value="<?= $_SESSION['user']['className'] ?>">
      </div>
      <div class="info-fields">
        <label for="">Ngày sinh</label>
        <input type="text" disabled value="<?= $_SESSION['user']['dateOfBirth'] ?>">
      </div>
    </div>
    <div class="sub-profile-box">
      <div class="info-fields">
        <label for="">Số điện thoại</label>
        <input type="text" disabled value="<?= $_SESSION['user']['phoneNumber'] ?>">
      </div>
      <div class="info-fields">
        <label for="">Email</label>
        <input type="text" disabled value="<?= $_SESSION['user']['email'] ?>">
      </div>
    </div>
    <div class="sub-profile-box">
      <div class="info-fields">
        <label for="">Số CCCD</label>
        <input type="text" disabled value="<?= $_SESSION['user']['phoneNumber'] ?>">
      </div>
      <div class="info-fields">
        <label for="">Địa chỉ</label>
        <input type="text" disabled value="<?= $_SESSION['user']['email'] ?>">
      </div>
    </div>
  </div>
</div>