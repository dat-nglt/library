<div class="content">
  <div id="profile-box">
    <div class="input-fields">
      <label for="">Mật khẩu cũ</label>
      <input class="input-password-profile" type="password" value="2101364">
      <span class="error-message-profile">Vui lòng nhập mật khẩu cũ!</span>
      <i id="eye" class="fa-regular fa-eye-slash"></i>
    </div>
    <div class="input-fields">
      <label for="">Mật khẩu mới</label>
      <input class="input-password-profile" type="password" value="Nguyễn Lê Tấn Đạt">
      <span class="error-message-profile">Vui lòng nhập mật khẩu mới!</span>
      <i id="eye" class="fa-regular fa-eye-slash"></i>
    </div>
    <div class="input-fields">
      <label for="">Nhập lại mật khẩu mới</label>
      <input class="input-password-profile" type="password" value="Kỹ thuật phần mềm">
      <span class="error-message-profile">Vui lòng nhập lại mật khẩu cũ!</span>
      <i id="eye" class="fa-regular fa-eye-slash"></i>
    </div>
    <div class="button-box">
      <div id="updateBtn" class="update-password-btn">Cập nhật lại</div>
    </div>
  </div>
</div>

<script>
  document.addEventListener('DOMContentLoaded', function () {
    const inputPasswordProfile = document.querySelectorAll('.input-password-profile');
    const updateBtn = document.querySelector('#updateBtn');
    const eye = document.querySelector('#eye');
    const errorInfo = document.querySelectorAll('.error-message-profile');

    inputPasswordProfile.forEach((input, index) => {
      input.addEventListener('blur', function () {
        errorInfo[index].style.display = input.value === "" ? "block" : "none";
      });
    });

    inputPasswordProfile.forEach(element => {
      element.addEventListener('input', function () {
        updateBtn.disabled = Array.from(inputLogin).some(input => input.value === '');
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