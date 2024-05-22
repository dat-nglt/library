$(document).ready(function () {
  $('.list__action-btn').on('click', function () {
    Swal.fire({
      title: 'Xác nhận',
      text: 'Bạn có muốn xóa sách!',
      icon: 'warning',
      showCancelButton: true,
      cancelButtonColor: '#d33',
      cancelButtonText: 'Huỷ',
      confirmButtonColor: '#3085d6',
      confirmButtonText: 'Xác nhận',
  }).then((result) => {
      if (result.isConfirmed) {
        var id = $(this).data('id');
    $.ajax({
      url: './services/admin/book/deleteBook.php',
      type: 'DELETE',
      dataType: 'json',
      data: { id: id },
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
      error: function (xhr, status, error) {
        Swal.fire({
          title: "Thông báo",
          text: "Xóa không thành công",
          icon: "error",
          showConfirmButton: true,
        }).then(function () {
            window.location.assign("?controller=admin&action=book");
        });
      }
    });
      }
  });
  });
});