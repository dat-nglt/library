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

<script>
  document.addEventListener(
  'DOMContentLoaded',
  function () {
    const inputPasswordProfile =
      document.querySelectorAll(
        '.input-password-profile'
      )
    const updateBtn =
      document.querySelector(
        '#updateBtn'
      )
    const eyes =
      document.querySelectorAll(
        '.eye-info'
      )
    const errorInfo =
      document.querySelectorAll(
        '.error-message-profile'
      )

    inputPasswordProfile.forEach(
      (input, index) => {
        input.addEventListener(
          'blur',
          function () {
            errorInfo[
              index
            ].style.display =
              input.value === ''
                ? 'block'
                : 'none'
          }
        )
      }
    )

    var showStatus = [
      false,
      false,
      false
    ]
    eyes.forEach((eye, index) => {
      eye.addEventListener(
        'click',
        function () {
          showStatus[index] =
            !showStatus[index]
          inputPasswordProfile[
            index
          ].type = showStatus[index]
            ? 'text'
            : 'password'
          eye.classList.toggle(
            'fa-eye-slash'
          )
          eye.classList.toggle('fa-eye')
          console.log(eye.classList)
        }
      )
    })
  }
)

$(document).ready(function () {
  const passwordPattern =
    /^(?=.*[0-9])(?=.*[a-zA-Z])(?=.*[!@#$%^&*])[a-zA-Z0-9!@#$%^&*]{8,20}$/
  $('#updatePasswordBtn').on(
    'click',
    function () {
      const oldPassword = $(
        '#oldPassword'
      ).val()
      const newPassword = $(
        '#newPassword'
      ).val()
      const newPasswordConfirm = $(
        '#newPasswordConfirm'
      ).val()

      if (
        !oldPassword ||
        !newPassword ||
        !newPasswordConfirm
      ) {
        Swal.fire({
          title: 'Cảnh báo',
          text: 'Vui lòng điền đầy đủ thông tin!',
          icon: 'warning',
          showConfirmButton: true
        })
        return
      }

      if (
        !passwordPattern.test(
          newPassword
        )
      ) {
        Swal.fire({
          title: 'Cảnh báo',
          text: 'Mật khẩu mới tối thiểu 8 kí tự, 1 kí tự in hoa và 1 kí tự đặc biệt!',
          icon: 'warning',
          showConfirmButton: true
        })
        return
      }

      if (
        newPassword !==
        newPasswordConfirm
      ) {
        Swal.fire({
          title: 'Cảnh báo',
          text: 'Nhập lại mật khẩu không trùng khớp!',
          icon: 'warning',
          showConfirmButton: true
        }).then(location.reload)
        return
      }

      $.ajax({
        url: './services/user/changePassword.php',
        type: 'POST',
        dataType: 'json',
        data: {
          oldPassword,
          newPassword
        },
        success: function (result) {
          console.log(result)
          Swal.fire({
            title: 'Thông báo',
            text: result.msg,
            icon: result.status,
            showConfirmButton: true
          }).then(function () {
            window.location.assign(
              result.path
            )
          })
        },
        error: function (xhr) {
          Swal.fire({
            title: 'Thông báo',
            text: 'Cập nhật mật khẩu không thành công',
            icon: 'error',
            showConfirmButton: true
          })
        }
      })
    }
  )
})

</script>