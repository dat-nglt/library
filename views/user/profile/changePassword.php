<?php
echo ($_SESSION['c']);
?>

<div class="content">
  <div id="profile-box">
    <form action="">
      <div class="input-fields">
        <label for="" method="POST">Mật khẩu cũ</label>
        <input class="input-password-profile" type="password" id="oldPassword">
        <span class="error-message-profile">Vui lòng nhập mật khẩu cũ!</span>
        <i class="fa-regular fa-eye-slash eye-info"></i>
      </div>
      <div class="input-fields">
        <label for="">Mật khẩu mới</label>
        <input class="input-password-profile" type="password" id="newPassword">
        <span class="error-message-profile">Vui lòng nhập mật khẩu mới!</span>
        <i class="fa-regular fa-eye-slash eye-info"></i>
      </div>
      <div class="input-fields">
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
    const inputPasswordProfile = document.querySelectorAll(
      ".input-password-profile"
    );
    const updateBtn = document.querySelector("#updateBtn");
    const eyes = document.querySelectorAll(".eye-info");
    const errorInfo = document.querySelectorAll(".error-message-profile");

    inputPasswordProfile.forEach((input, index) => {
      input.addEventListener("blur", function () {
        errorInfo[index].style.display = input.value === "" ? "block" : "none";
      });
    });

    var showStatus = [false, false, false];
    eyes.forEach((eye, index) => {
      eye.addEventListener("click", function () {
        showStatus[index] = !showStatus[index];
        inputPasswordProfile[index].type = showStatus[index]
          ? "text"
          : "password";
        eye.classList.toggle("fa-eye-slash");
        eye.classList.toggle("fa-eye");
      });
    });
  });

  $(document).ready(function () {
    $("#updatePasswordBtn").on("click", function () {
      const oldPassword = $("#oldPassword").val();
      const newPassword = $("#newPassword").val();
      const newPasswordConfirm = $("#newPasswordConfirm").val();

      if (!oldPassword || !newPassword || !newPasswordConfirm) {
        Swal.fire({
          title: "Cảnh báo",
          text: "Vui lòng điền đầy đủ thông tin!",
          icon: "warning",
          showConfirmButton: true,
        }).then(location.reload);
        return;
      }

      if (newPassword !== newPasswordConfirm) {
        Swal.fire({
          title: "Cảnh báo",
          text: "Nhập lại mật khẩu không trùng khớp!",
          icon: "warning",
          showConfirmButton: true,
        }).then(location.reload);
        return;
      }

      $.ajax({
        url: "?controller=user&action=profile",
        type: "POST",
        data: {
          oldPassword: oldPassword,
          newPassword: newPassword,
          newPasswordConfirm: newPasswordConfirm,
        },
        success: function (result) {
          Swal.fire({
            title: "Thông báo",
            text: "Cập nhật mật khẩu thành công!",
            icon: "success",
            showConfirmButton: true,
          }).then(location.reload);
        },
        error: function (xhr) {
          if (xhr.responseJSON && xhr.responseJSON.message) {
            Swal.fire({
              title: "Thông báo",
              text: xhr.responseJSON.message,
              icon: "error",
              showConfirmButton: true,
            }).then(location.reload);
          } else {
            Swal.fire({
              title: "Thông báo",
              text: "Cập nhật mật khẩu không thành công",
              icon: "error",
              showConfirmButton: true,
            }).then(location.reload);
          }
        },
      });
    });
  });
</script>