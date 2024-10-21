<style>
  #change-password-form {
    padding: 15px;
    width: 65%;
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
  }

  .info-fields>i {
    position: absolute;
    top: 37px;
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
        <input class="input-password-profile" type="password" id="oldPassword">
        <span class="error-message-profile">Vui lòng nhập mật khẩu cũ!</span>
        <i class="fa-regular fa-eye-slash eye-info"></i>
      </div>
      <div class="info-fields">
        <label for="">Mật khẩu mới</label>
        <input class="input-password-profile" type="password" id="newPassword">
        <span class="error-message-profile">Vui lòng nhập mật khẩu mới!</span>
        <i class="fa-regular fa-eye-slash eye-info"></i>
      </div>
      <div class="info-fields">
        <label for="">Nhập lại mật khẩu mới</label>
        <input class="input-password-profile" type="password" id="newPasswordConfirm">
        <span class="error-message-profile">Vui lòng nhập lại mật khẩu cũ!</span>
        <i class="fa-regular fa-eye-slash eye-info"></i>
      </div>
      <div class="button-box">
        <div id="updatePasswordBtn" class="update-password-btn">Cập nhật lại</div>
      </div>
    </form>
  </div>
</div>