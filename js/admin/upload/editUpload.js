function submitUploadEdit() {
  var id = $("#id_Book").val();
  var id_Book = $("#select-book-add").val();
  var data = {
    id,
    id_Book,
  };

  $.ajax({
    type: "POST",
    url: "./services/admin/upload/editUpload.php",
    dataType: "json",
    data: data,
    success: function (result) {
      console.log(data);
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
  console.log(data);
}
