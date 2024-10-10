<style>
  .login>form {
    margin: 0 auto;
    display: flex;
    align-items: flex-start;
    flex-direction: column;
    width: fit-content;
    padding: 25px 40px;
    background: #fff;
    border-radius: 10px;
    box-shadow: 0px 0px 20px 10px rgba(0, 0, 0, 0.3);
    z-index: 2;
  }

  .login .input-field {
    position: relative;
    margin-bottom: 20px;
    display: flex;
    flex-direction: column;
    gap: 5px;
    width: 90%;
  }

  .login .input-field span {
    display: none;
    position: absolute;
    bottom: -16px;
    font-size: 11px;
    font-style: italic;
    color: red;
  }

  .login .input-field label {
    font-weight: 600;
    color: #867c7c;
    font-size: 16px;
  }

  .login .input-field input {
    font-size: 16px;
    font-weight: 600;
    color: #867c7c;
    width: 330px;
    padding: 10px 15px;
    border-radius: var(--border-radius);
    border: 1px solid #cdcdcd;
    outline: none;
  }

  .login .input-field:nth-of-type(2) input {
    padding-right: 40px;
  }

  .login .input-field i {
    cursor: pointer;
    position: absolute;
    right: -20px;
    top: 58%;
  }

  .remember-pass {
    display: flex;
    gap: 5px;
    padding: 5px 0;
    margin-bottom: 20px;
  }

  .remember-pass label {
    font-size: 14px;
    color: #867c7c;
  }

  #loginBtn {
    width: 100%;
    background-color: #2daf52;
    padding: 10px;
    color: #fff;
    font-size: 14px;
    border-radius: 20px;
    font-weight: 500;
    border: none;
    box-shadow: 0 -1px 0 #299849, 0 1px 1px #299849;
    transition: background-color 0.3s, box-shadow 0.3s;
  }

  #loginBtn:hover {
    cursor: pointer;
    /* background-color: #299849; */
    box-shadow: 0 -1px 0 #299849, 0 2px 4px #299849;
  }

  #or {
    width: 100%;
    text-align: center;
    padding: 15px 0;
    color: grey;
    font-weight: 600;
    font-size: 12px;
  }

  .login-with-google-btn {
    transition: background-color 0.3s, box-shadow 0.3s;
    padding: 12px 0px 12px 25px;
    border: none;
    border-radius: 20px;
    width: 100%;
    box-shadow: 0 -1px 0 rgba(0, 0, 0, 0.04), 0 1px 1px rgba(0, 0, 0, 0.25);
    font-size: 14px;
    font-weight: 500;
    background-image: url(data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMTgiIGhlaWdodD0iMTgiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+PGcgZmlsbD0ibm9uZSIgZmlsbC1ydWxlPSJldmVub2RkIj48cGF0aCBkPSJNMTcuNiA5LjJsLS4xLTEuOEg5djMuNGg0LjhDMTMuNiAxMiAxMyAxMyAxMiAxMy42djIuMmgzYTguOCA4LjggMCAwIDAgMi42LTYuNnoiIGZpbGw9IiM0Mjg1RjQiIGZpbGwtcnVsZT0ibm9uemVybyIvPjxwYXRoIGQ9Ik05IDE4YzIuNCAwIDQuNS0uOCA2LTIuMmwtMy0yLjJhNS40IDUuNCAwIDAgMS04LTIuOUgxVjEzYTkgOSAwIDAgMCA4IDV6IiBmaWxsPSIjMzRBODUzIiBmaWxsLXJ1bGU9Im5vbnplcm8iLz48cGF0aCBkPSJNNCAxMC43YTUuNCA1LjQgMCAwIDEgMC0zLjRWNUgxYTkgOSAwIDAgMCAwIDhsMy0yLjN6IiBmaWxsPSIjRkJCQzA1IiBmaWxsLXJ1bGU9Im5vbnplcm8iLz48cGF0aCBkPSJNOSAzLjZjMS4zIDAgMi41LjQgMy40IDEuM0wxNSAyLjNBOSA5IDAgMCAwIDEgNWwzIDIuNGE1LjQgNS40IDAgMCAxIDUtMy43eiIgZmlsbD0iI0VBNDMzNSIgZmlsbC1ydWxlPSJub256ZXJvIi8+PHBhdGggZD0iTTAgMGgxOHYxOEgweiIvPjwvZz48L3N2Zz4=);
    background-color: #eae8e8;
    background-repeat: no-repeat;
    background-position: 90px 12px;

    &:hover {
      cursor: pointer;
      box-shadow: 0 -1px 0 rgba(0, 0, 0, 0.04), 0 2px 4px rgba(0, 0, 0, 0.25);
    }
  }
</style>

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
    const accountInput = document.querySelector('#taiKhoan');
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

    accountInput.addEventListener('input', function (e) {
      e.target.value = e.target.value.replace(/\D/g, '');
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