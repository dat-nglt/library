<style>
  #change-password-form {
    padding: 15px;
    width: 50%;
    margin: 30px auto 0;
  }

  .info-fields {
    position: relative;
    display: flex;
    flex-direction: column;
    margin-bottom: 10px;
  }

  .info-fields>input {
    width: 100%;
    padding: 8px 13px;
    margin-bottom: 15px;
    border-radius: 5px;
    outline: none;
    border: 1px #dbdbdb solid;
    margin-top: 8px;

    &:focus {
      border-color: #66afe9;
      outline: none;
      box-shadow: 0 0 5px rgba(102, 175, 233, 0.5);
    }
  }

  .info-fields>i {
    position: absolute;
    top: 37px;
    right: 10px;
    cursor: pointer;
  }

  .button-box {
    margin-top: 20px;
    display: flex;
    justify-content: right;
  }

  .update-password-btn {
    min-width: 250px;
    max-width: 250px;
    font-size: 16px;
    background: #4ea25e;
    padding: 10px 10px;
    color: #fff;
    border-radius: 5px;
    text-align: center;
  }

  .update-password-btn:hover {
    cursor: pointer;
    background: var(--orange-color);
  }

  .error-message-profile {
    display: none;
    position: absolute;
    font-size: 11px;
    bottom: -2px;
    left: 10px;
    color: red;
  }
</style>


<div class="content">
  <div id="profile__title">Đổi mật khẩu</div>
  <div id="profile-box">
    <form action="" id="change-password-form">
      <div class="info-fields">
        <label for="" method="POST">Mật khẩu cũ</label>
        <input class="input-password-profile" type="password" id="oldPassword" placeholder="Nhập mật khẩu cũ">
        <span class="error-message-profile">Vui lòng nhập mật khẩu cũ!</span>
        <i class="fa-regular fa-eye-slash eye-info"></i>
      </div>
      <div class="info-fields">
        <label for="">Mật khẩu mới</label>
        <input class="input-password-profile" type="password" id="newPassword" placeholder="Nhập mật khẩu mới">
        <span class="error-message-profile">Vui lòng nhập mật khẩu mới!</span>
        <i class="fa-regular fa-eye-slash eye-info"></i>
      </div>
      <div class="info-fields">
        <label for="">Xác nhận mật khẩu mới</label>
        <input class="input-password-profile" type="password" id="newPasswordConfirm" placeholder="Nhập lại mật khẩu">
        <span class="error-message-profile">Vui lòng nhập lại mật khẩu cũ!</span>
        <i class="fa-regular fa-eye-slash eye-info"></i>
      </div>
      <div class="button-box">
        <div id="updatePasswordBtn" class="update-password-btn">Cập nhật lại</div>
      </div>
    </form>
  </div>
</div>