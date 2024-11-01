$(document).ready(function () {
  $.cloudinary.config({
    cloud_name: 'dfjcxmlot',
    api_key: '228961218815535',
    // Không nên tiết lộ api_secret ở phía frontend
  });

  $('#upload-file').click(function () {
    var file = $('#fileName')[0].files[0];
    var title = $('#title').val();
    var type = $('#type').val();
    var formData = new FormData();
    formData.append('file', file);
    formData.append('upload_preset', 'library_CTUT');

    // Kiểm tra tiêu đề
    if (title.trim() === '') {
      Swal.fire({
        title: 'Thông báo',
        text: 'Vui lòng nhập nhan đề tải lên',
        icon: 'warning',
        showConfirmButton: true
      });
      return;
    }

    // Kiểm tra tệp
    if (!file) {
      Swal.fire({
        title: 'Thông báo',
        text: 'Vui lòng chọn tài liệu để tải lên',
        icon: 'warning',
        showConfirmButton: true
      });
      return;
    }

    // Kiểm tra định dạng tệp
    var validFileTypes = ['application/pdf'];
    if (!validFileTypes.includes(file.type)) {
      Swal.fire({
        title: 'Thông báo',
        text: 'Vui lòng tải lên tệp PDF',
        icon: 'warning',
        showConfirmButton: true
      });
      return;
    }

    $.ajax({
      url: 'https://api.cloudinary.com/v1_1/dfjcxmlot/auto/upload',
      type: 'POST',
      data: formData,
      processData: false,
      contentType: false,
      success: function (response) {
        var postData = {
          uploadURL: response.secure_url,
          type1: type,
          title1: title
        };
        $.ajax({
          type: 'POST',
          url: '?controller=user&action=upload',
          data: postData,
          success: function () {
            Swal.fire({
              title: 'Thông báo',
              text: 'Upload tài liệu thành công',
              icon: 'success',
              showConfirmButton: true
            }).then(function () {
              window.location.assign('http://localhost/library/?controller=user&action=upload');
            });
          },
          error: function (xhr, status, error) {
            Swal.fire({
              title: 'Thông báo',
              text: 'Upload tài liệu thất bại',
              icon: 'error',
              showConfirmButton: true
            }).then(function () {
              window.location.assign('http://localhost/library/?controller=user&action=upload');
            });
          }
        });
      },
      error: function (xhr, status, error) {
        console.log('tb');
        Swal.fire({
          title: 'Thông báo',
          text: 'Upload tài liệu thất bại',
          icon: 'error',
          showConfirmButton: true
        }).then(function () {
          window.location.assign('http://localhost/library/?controller=user&action=upload');
        });
      }
    });
  });
});