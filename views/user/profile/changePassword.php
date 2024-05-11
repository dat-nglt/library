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

<!-- 
<script src="./js/user/profile.js">
  </script> -->

<script>
  document.addEventListener("DOMContentLoaded", function () {
    const inputPasswordProfile = document.querySelectorAll(".input-password-profile");
    const updateBtn = document.querySelector("#updateBtn");
    const eyes = document.querySelectorAll(".eye-info");
    const errorInfo = document.querySelectorAll(".error-message-profile");

    initErrorHandler();
    initEyeClickHandler();
    initUpdatePasswordHandler();
  });

  function initErrorHandler() {
    inputPasswordProfile.forEach((input, index) => {
      input.addEventListener("blur", function () {
        errorInfo[index].style.display = input.value === "" ? "block" : "none";
      });
    });
  }

  function initEyeClickHandler() {
    const showStatus = new Array(eyes.length).fill(false);
    eyes.forEach((eye, index) => {
      eye.addEventListener("click", function (e) {
        showStatus[index] = !showStatus[index];
        inputPasswordProfile[index].type = showStatus[index] ? "text" : "password";
        e.target.classList.toggle("fa-eye-slash");
        e.target.classList.toggle("fa-eye");
      });
    });
  }

  function initUpdatePasswordHandler() {
    $("#updatePasswordBtn").on("click", function () {
      const oldPassword = $("#oldPassword").val();
      const newPassword = $("#newPassword").val();
      const newPasswordConfirm = $("#newPasswordConfirm").val();

      if (!oldPassword || !newPassword || !newPasswordConfirm) {
        showAlert("Vui lòng điền đầy đủ thông tin!", "warning");
        return;
      }

      if (newPassword !== newPasswordConfirm) {
        showAlert("Nhập lại mật khẩu không trùng khớp!", "warning");
        return;
      }
      updatePassword(oldPassword, newPassword);
    });
  }

  function updatePassword(oldPassword, newPassword) {
    fetch('?controller=user&action=profile&profilePage=changePassword', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json'
      },
      body: JSON.stringify({ oldPassword, newPassword })
    })
      .then(response => {
        const message = response.status === 200 ? "Cập nhật mật khẩu thành công" : "Cập nhật mật khẩu không thành công!";
        const icon = response.status === 200 ? "success" : "warning";
        showAlert(message, icon);
      })
      .catch(error => {
        showAlert("Đã có lỗi xảy ra, vui lòng kiểm tra lại!", "info");
      });
  }

  function showAlert(message, icon) {
    Swal.fire({
      title: "Thông báo",
      text: message,
      icon,
      showConfirmButton: true,
    }).then(location.reload);
  }

</script>