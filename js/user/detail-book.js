$(document).ready(function () {
  $("#request-Book").click(function () {
    var id = $("#idBook").text();

    $.ajax({
      type: "POST",
      url: "?controller=user&action=book_detail&id=" + id,
      data: {},
      processData: false,
      contentType: false,
      success: function () {
        Swal.fire({
          title: "Thông báo",
          text: "Đăng ký mượn tài liệu thành công",
          icon: "success",
          showConfirmButton: true,
        }).then(function () {
          window.location.assign(
            "http://localhost/library/?controller=user&action=book_detail&id=" +
              id
          );
        });
      },
      error: function (xhr, status, error) {
        console.log("tb");
        Swal.fire({
          title: "Thông báo",
          text: "Đăng ký mượn  liệu thất bại",
          icon: "error",
          showConfirmButton: true,
        }).then(function () {
          window.location.assign(
            "http://localhost/library/?controller=user&action=book_detail&id=" +
              id
          );
        });
      },
    });
  });
});
