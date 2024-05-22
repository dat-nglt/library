console.log("hehe");

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
      console.log(eye.classList);
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
      url: "./services/user/profile/changePassword.php",
      type: "POST",
      dataType: "json",
      data: {
        oldPassword,
        newPassword,
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
