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
    <button type="button" class="login-with-google-btn">
      <a href="<?= $url ?>" style="color: #757575;">Đăng nhập với Google</a>
    </button>
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