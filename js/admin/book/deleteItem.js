$(document).ready(function () {
  $('.list__action-btn').on('click', function () {
    var itemId = $(this).data('id');
    $.ajax({
      url: './components/deleteCategory.php',
      type: 'DELETE',
      dataType: 'json',
      data: { id: itemId },
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
          text: "Xóa không thành công.",
          icon: "error",
          showConfirmButton: true,
        }).then(function () {
            window.location.assign("?controller=admin&action=category");
        });
      }
    });
  });
});