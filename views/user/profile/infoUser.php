<div class="content">
  <div class="avatar-box">
    </main>
  </div>
  <div id="profile-box">
    <div class="input-fields">
      <label for="">Mã độc giả</label>
      <input type="text" readonly value="<?= $_SESSION['user']['id'] ?>">
    </div>
    <div class="input-fields">
      <label for="">Họ và tên</label>
      <input type="text" readonly value="<?= $_SESSION['user']['fullName'] ?>">
    </div>
    <div class="input-fields">
      <label for="">Chi đoàn</label>
      <input type="text" readonly value="<?= $_SESSION['user']['className'] ?>">
    </div>
    <div class="input-fields">
      <label for="">Ngày sinh</label>
      <input type="text" readonly value="<?= $_SESSION['user']['dateOfBirth'] ?>">
    </div>
    <div class="input-fields">
      <label for="">Số điện thoại</label>
      <input type="text" readonly value="<?= $_SESSION['user']['phoneNumber'] ?>">
    </div>

    <div class="input-fields">
      <label for="">Email</label>
      <input type="text" readonly value="<?= $_SESSION['user']['email'] ?>">
    </div>
    <div class="input-fields">
      <label for="">Số CCCD</label>
      <input type="text" readonly value="<?= $_SESSION['user']['identificationNumber'] ?>">
    </div>
    <div class="input-fields">
      <label for="">Địa chỉ</label>
      <input type="text" readonly value="<?= $_SESSION['user']['address'] ?>">
    </div>
  </div>
</div>
