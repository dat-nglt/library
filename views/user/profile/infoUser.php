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
        <h4><?= $_SESSION['user']['dateOfBirth'] ?></h4>
      </div>
    </div>
    <div class="info-box">
      <div class="info-field">
        <h4>Email: </h4>
        <h4><?= $_SESSION['user']['email'] ?></h4>
      </div>
      <div class="info-field">
        <h4>Số điện thoại: </h4>
        <h4><?= $_SESSION['user']['phoneNumber'] ?></h4>
      </div>
      <div class="info-field">
        <h4>Số CCCD: </h4>
        <h4><?= $_SESSION['user']['identificationNumber'] ?></h4>
      </div>
      <div class="info-field">
        <h4>Địa chỉ: </h4>
        <h4><?= $_SESSION['user']['address'] ?></h4>
      </div>
    </div>
  </div>
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
      gap: 25px;
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
</style>