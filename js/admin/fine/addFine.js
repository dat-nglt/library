function submitFine() {

    var idRequest = $('#idRequest').val();
    var price = $("#price").val();
    var des = $("#input-des").val();

    if (
        price.trim() === "" ||
        des.trim() === ""
    ) {
        Swal.fire({
            title: "Thông báo",
            text: "Vui lòng nhập các thông tin bắt buộc!",
            icon: "warning",
            showConfirmButton: true,
        });
        return;
    }

    if (
        price < 1
    ) {
        Swal.fire({
            title: "Thông báo",
            text: "Số tiền phải lớn hơn 0",
            icon: "warning",
            showConfirmButton: true,
        });
        return;
    }

    if (
        !idRequest
    ) {
        Swal.fire({
            title: "Thông báo",
            text: "Phiếu mượn không hợp lệ",
            icon: "warning",
            showConfirmButton: true,
        });
        return;
    }

   
        var data = {
          idRequest,
          price,
          des
         };
        $.ajax({
            type: "POST",
            url: "./services/admin/fine/addFine.php",
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
            error: function () {
                Swal.fire({
                    title: "Thông báo",
                    text: "Thêm phiếu phạt không thành công",
                    icon: "error",
                    showConfirmButton: true,
                }).then(function () {
                    window.location.assign("?controller=admin&action=fine");
                });
            },
        });
}
