<div class="content">
  <div id="profile__title">Thông tin cá nhân</div>

  <div id="profile__content">
    <img
      src="https://static-media-cdn.mekongasean.vn/stores/news_dataimages/2024/102024/04/16/in_article/mark-zuckerberg-201920241004160735.jpg?rt=20241004160737"
      alt="">
    <div class="info-box">

      <div class="info-field">
        <h4>Họ và tên: </h4>
        <h4><?= $_SESSION['user']['fullName'] ?> </h4>
      </div>
      <div class="info-field">
        <h4>Mã số sinh viên: </h4>
        <h4><?= $_SESSION['user']['studentCode'] ?></h4>
      </div>
      <div class="info-field">
        <h4>Lớp học: </h4>
        <h4><?= $_SESSION['user']['className'] ?></h4>
      </div>
      <div class="info-field">
        <h4>Ngày sinh: </h4>
        <h4>20/04/2003</h4>
      </div>
    </div>
    <div class="info-box">
      <div class="info-field">
        <h4>Email: </h4>
        <h4>Nguyễn Lê Tấn Đạt</h4>
      </div>
      <div class="info-field">
        <h4>Số điện thoại: </h4>
        <h4>2101364</h4>
      </div>
      <div class="info-field">
        <h4>Số CCCD: </h4>
        <h4>KTPM0121</h4>
      </div>
      <div class="info-field">
        <h4>Địa chỉ: </h4>
        <h4>Óc Eo, Thoại Sơn, An Giang</h4>
      </div>
    </div>
  </div>

  <!-- <div class="avatar-box">
    </main>
  </div>
  <div id="profile-box">
    <div class="sub-profile-box">
      <div class="info-fields">
        <h6 for="">Mã độc giả</h6>
        <input type="text" disabled value="<?= $_SESSION['user']['studentCode'] ?>">
      </div>
      <div class="info-fields">
        <h6 for="">Họ và tên</h6>
        <input type="text" disabled value="<?= $_SESSION['user']['fullName'] ?>">
      </div>
    </div>
    <div class="sub-profile-box">
      <div class="info-fields">
        <h6 for="">Chi đoàn</h6>
        <input type="text" disabled value="<?= $_SESSION['user']['className'] ?>">
      </div>
      <div class="info-fields">
        <h6 for="">Ngày sinh</h6>
        <input type="text" disabled value="<?= $_SESSION['user']['dateOfBirth'] ?>">
      </div>
    </div>
    <div class="sub-profile-box">
      <div class="info-fields">
        <h6 for="">Số điện thoại</h6>
        <input type="text" disabled value="<?= $_SESSION['user']['phoneNumber'] ?>">
      </div>
      <div class="info-fields">
        <h6 for="">Email</h6>
        <input type="text" disabled value="<?= $_SESSION['user']['email'] ?>">
      </div>
    </div>
    <div class="sub-profile-box">
      <div class="info-fields">
        <h6 for="">Số CCCD</h6>
        <input type="text" disabled value="<?= $_SESSION['user']['identificationNumber'] ?>">
      </div>
      <div class="info-fields">
        <h6 for="">Địa chỉ</h6>
        <input type="text" disabled value="<?= $_SESSION['user']['email'] ?>">
      </div>
    </div>
  </div> -->
</div>

<style>
  #profile__content {
    padding: 40px 30px;
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 20px;

    >img {
      width: 200px;
      height: 200px;
      border-radius: 50%;
      object-fit: cover;
    }

    .info-box {
      padding: 10px;
      display: flex;
      flex-direction: column;
      gap: 15px;
      min-width: 290px;

      .info-field {
        display: flex;
        gap: 5px;

        h4:first-of-type {
          font-weight: 500;
          color: #727271;
        }

        h4:last-of-type {
          font-weight: 600;
          color: #727271;
        }

      }
    }
  }

  .sub-profile-box {
    display: flex;
    align-items: center;
    margin: 10px 0px;
    gap: 20px;
  }

  .info-fields {
    flex: 1;
    display: flex;
    align-items: center;
    flex-direction: row;
  }

  .info-fields>input {
    width: 100%;
    padding: 8px 13px;
    margin-bottom: 15px;
    border-radius: 5px;
    outline: none;
    border: 1px #dbdbdb solid;
    margin-top: 8px;
  }

  .eye-info {
    position: absolute;
    right: 10px;
  }
</style>