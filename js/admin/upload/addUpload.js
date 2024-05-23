function submitUpload() {
  $.cloudinary.config({
    cloud_name: "dfjcxmlot",
    api_key: "228961218815535",
    api_secret: "gpjAXY5kGhg40Hd5adbcMUIeV84",
  });
  var name = $("#input-name").val();
  var book = $("#select-book").val();
  var category = $("#select-category").val();

  if (category.trim() === "") {
    Swal.fire({
      title: "Thông báo",
      text: "Vui lòng thêm danh mục sách.",
      icon: "warning",
      showConfirmButton: true,
    });
    return;
  }

  if (name.trim() === "" || book.trim() === "") {
    Swal.fire({
      title: "Thông báo",
      text: "Vui lòng nhập các thông tin bắt buộc.",
      icon: "warning",
      showConfirmButton: true,
    });
    return;
  }

  var file = $("#upload-file")[0].files[0];
  var formData = new FormData();
  formData.append("file", file);
  formData.append("upload_preset", "library_CTUT");
  $.ajax({
    url: "https://api.cloudinary.com/v1_1/dfjcxmlot/auto/upload",
    type: "POST",
    data: formData,
    processData: false,
    contentType: false,
    success: function (response) {
      var data = {
        name: name,
        book: book,
        category: category,
        uploadURL: response.secure_url,
      };
      console.log(data);
      $.ajax({
        type: "POST",
        url: "./services/admin/upload/addUpload.php",
        dataType: "json",
        data: data,
        success: function (result) {
          Swal.fire({
            title: "Thông báo",
            text: result.msg,
            icon: result.status,
            showConfirmButton: true,
          }).then(function () {
            window.location.assign(result.path);
          });
        },
        error: function (xhr) {
          console.log(xhr);
          Swal.fire({
            title: "Thông báo",
            text: "Tải lên không thành công",
            icon: "error",
            showConfirmButton: true,
          }).then(function () {
            window.location.assign("?controller=admin&action=upload");
          });
        },
      });
    },
  });
}
