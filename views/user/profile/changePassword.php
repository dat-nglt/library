<div class="content">
  <div id="profile-box">
    <div class="input-fields">
      <label for="">Mật khẩu cũ</label>
      <input class="input-password-profile" type="password" id="oldPassword">
      <span class="error-message-profile">Vui lòng nhập mật khẩu cũ!</span>
      <i id="eye" class="fa-regular fa-eye-slash"></i>
    </div>
    <div class="input-fields">
      <label for="">Mật khẩu mới</label>
      <input class="input-password-profile" type="password" id="newPassword">
      <span class="error-message-profile">Vui lòng nhập mật khẩu mới!</span>
      <i id="eye" class="fa-regular fa-eye-slash"></i>
    </div>
    <div class="input-fields">
      <label for="">Nhập lại mật khẩu mới</label>
      <input class="input-password-profile" type="password" id="newPasswordConfirm">
      <span class="error-message-profile">Vui lòng nhập lại mật khẩu cũ!</span>
      <i id="eye" class="fa-regular fa-eye-slash"></i>
    </div>
    <div class="button-box">
      <div id="updateBtn" class="update-password-btn" disabled>Cập nhật lại</div>
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

  $(document).ready(function () {
    $("#updateBtn").on('click', function (event) {
      if ($(this).prop("disabled")) {
        return;
      }d
      var oldPassword = $("#oldPassword").val();
      var newPassword = $("#newPassword").val();
      var newPasswordConfirm = $("#newPasswordConfirm").val();

      $.ajax({
        type: "POST",
        url: "?controller=user&action=profile&profilePage=changePassword",
        data: {
          oldPassword: oldPassword,
          newPassword: newPassword,
          newPasswordConfirm: newPasswordConfirm
        },
        success: function (result) {
          console.log(result);
        },
        error: function (xhr, status, error) {
          console.error(error);
        }
      });

      event.preventDefault();
    });
  });


</script>