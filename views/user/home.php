<?php
if (isset($data) && $data !== []) {
  $notificationType = $data['notification']['type'];
  $notificationMessage = $data['notification']['message'];
  $notificationLink = $data['notification']['link'];
  $notificationType($notificationMessage, $notificationLink);
}
?>

<div class="container home">
  <div class="background"></div>
  <div class="login">
    <div class="user-search">
      <div class="user-search-sub">
        <select class="select-search" name="" id="">
          <option value="">Tất cả</option>
          <option value="">Nhan đề</option>
          <option value="">Tác giả</option>
          <option value="">Chủ đề</option>
          <option value="">Năm xuất bản</option>
          <option value="">Chỉ số phân loại</option>
        </select>
        <input class="input-search" type="text" placeholder="Nhập tên sách hoặc từ khoá cần tìm ...">

        <button id="btn-search">Tìm kiếm</button>
      </div>
    </div>
  </div>

  <form action="" method="post" enctype="multipart/form-data">
    <input type="file" name="fileToUpload" id="fileToUpload">
    <button type="button" id="upload-file" name="upload" style="padding: 10px 30px; background:red;">
  </form>
</div>

<script>
  $(document).ready(function () {
    $.cloudinary.config({
      cloud_name: 'dfjcxmlot',
      api_key: '228961218815535',
      api_secret: 'gpjAXY5kGhg40Hd5adbcMUIeV84'
    });
    $('#upload-file').click(function () {
      var file = $('#fileToUpload')[0].files[0];
      var formData = new FormData();
      formData.append('file', file);
      formData.append('upload_preset', "library_CTUT");

      $.ajax({
        url: 'https://api.cloudinary.com/v1_1/dfjcxmlot/auto/upload',
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function (response) {
          console.log('tc');
          var postData = {
            uploadURL: response.secure_url
          }
          $.ajax({
            type: 'POST',
            url: '?controllers=user&action=upload',
            data: postData,
            success: function (data) {
              Swal.fire({
                title: "Thông báo",
                text: "Thay đổi avatar thành công",
                icon: "success",
                showConfirmButton: true,
              }).then(function () {
                // window.location.assign("http://localhost/qlkh/src/index.php?act=profile");
              });
            }, error: function (xhr, status, error) {
              Swal.fire({
                title: "Thông báo",
                text: "Thay đổi avatar thất bại",
                icon: "error",
                showConfirmButton: true,
              }).then(function () {
                // window.location.assign("http://localhost/qlkh/src/index.php?act=profile");
              });
            }
          });
        },
        error: function (xhr, status, error) {
          console.log('tb');
          Swal.fire({
            title: "Thông báo",
            text: "Thay đổi avatar thất bại",
            icon: "error",
            showConfirmButton: true,
          }).then(function () {
            // window.location.assign("http://localhost/qlkh/src/index.php?act=profile");
          });
        }
      });
    });
  })

</script>
