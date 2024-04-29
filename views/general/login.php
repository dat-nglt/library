<?php
if (isset($data) && $data !== []) {
  $notificationType = $data['notification']['type'];
  $notificationMessage = $data['notification']['message'];
  $notificationLink = $data['notification']['link'];
  $notificationType($notificationMessage, $notificationLink);
}
?>

<div class="login">
  <form action="?controller=user&action=login" method="POST">
    <div class="input-field">
      <label for="taiKhoan">Tên đăng nhập</label>
      <input class="input-login" id="taiKhoan" name="taiKhoan" type="text">
      <span class="error-message">Tên tài khoản không được để trống!</span>
    </div>
    <div class="input-field">
      <label for="matKhau">Mật khẩu</label>
      <input class="input-login" id="matKhau" name="matKhau" type="password">
      <span class="error-message">Mật khẩu không được để trống!</span>
      <i id="eye" class="fa-regular fa-eye-slash"></i>
    </div>
    <div class="remember-pass">
      <input type="checkbox" name="" id="nhoMatKhau">
      <label for="nhoMatKhau">Nhớ mật khẩu</label>
    </div>
    <button id="loginBtn" name="login" type="submit" disabled>Đăng nhập</button>

    <div id="or">Hoặc</div>
    <div class="login__google" style="margin: 0 auto">
      <div id="g_id_onload" data-client_id="554567692253-kgdu69c1indcvdctlnmi9r0083eeh2qg.apps.googleusercontent.com"
        data-context="signin" data-ux_mode="popup" data-callback="handleCredentialResponse" data-auto_prompt="false">
      </div>

      <div class="g_id_signin" data-type="standard" data-shape="rectangular" data-theme="outline"
        data-text="signin_with" data-size="large" data-logo_alignment="left">
      </div>
    </div>


  </form>
</div>

<script>
  document.addEventListener('DOMContentLoaded', function () {
    const inputLogin = document.querySelectorAll('.input-login');
    const loginBtn = document.querySelector('#loginBtn');
    const eye = document.querySelector('#eye');
    const passwordInput = document.querySelector('#matKhau');
    const errorInfo = document.querySelectorAll('.error-message');

    inputLogin.forEach((input, index) => {
      input.addEventListener('blur', function () {
        errorInfo[index].style.display = input.value === "" ? "block" : "none";
      });
    });

    inputLogin.forEach(element => {
      element.addEventListener('input', function () {
        loginBtn.disabled = Array.from(inputLogin).some(input => input.value === '');
      });
    });

    var show = false;
    eye.addEventListener('click', function () {
      show = !show;
      passwordInput.type = show ? 'text' : 'password';
      eye.classList.toggle("fa-eye-slash");
      eye.classList.toggle("fa-eye");
    });
  });

</script>
<script src="https://accounts.google.com/gsi/client" async></script>