$(document).ready(function () {
    $(".delete-btn").on("click", function () {
        Swal.fire({
            title: "Xác nhận",
            text: "Bạn có muốn xóa File dữ liệu!",
            icon: "warning",
            showCancelButton: true,
            cancelButtonColor: "#d33",
            cancelButtonText: "Huỷ",
            confirmButtonColor: "#3085d6",
            confirmButtonText: "Xác nhận",
        }).then((result) => {
            console.log(result);
            if (result.isConfirmed) {
                var id = $(this).data("id");
                console.log(id);
                $.ajax({
                    url: "./services/user/deleteUpload.php",
                    type: "DELETE",
                    dataType: "json",
                    data: { id: id },
                    success: function (result) {
                        console.log(result);
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
                            window.location.assign(
                                "?controller=user&action=upload"
                            );
                        });
                    },
                });
            }
        });
    });
});
