function submitFine() {
    $.cloudinary.config({
        cloud_name: "di37whq60",
        api_key: "287339152575881",
        api_secret: "0ghXMK9HlG7IFL3l3njbLKFQgXo",
    });

    var user = $("#user_borrow").val();
    var request = $("#request").val();
    var idRequest = $('#idRequest').val();
    var day = $("#day").val();
    var price = $("#price").val();
    var des = $("#input-des").val();
console.log(idRequest);

    if (
        user.trim() === "" ||
        request.trim() === "" ||
        day.trim() === "" ||
        price.trim() === "" ||
        des.trim() === ""
    ) {
        Swal.fire({
            title: "Thông báo",
            text: "Vui lòng nhập các thông tin bắt buộc.",
            icon: "warning",
            showConfirmButton: true,
        });
        return;
    }

   
        // var data = {
        //     user,
        //    request,
        // };
        // $.ajax({
        //     type: "POST",
        //     url: "./services/admin/book/addBook.php",
        //     dataType: "json",
        //     data: data,
        //     success: function (result) {
        //         Swal.fire({
        //             title: "Thông báo",
        //             text: result.msg,
        //             icon: result.status,
        //             showConfirmButton: true,
        //         }).then(function () {
        //             window.location.assign(result.path);
        //         });
        //     },
        //     error: function () {
        //         Swal.fire({
        //             title: "Thông báo",
        //             text: "Thêm sách không thành công",
        //             icon: "error",
        //             showConfirmButton: true,
        //         }).then(function () {
        //             window.location.assign("?controller=admin&action=book");
        //         });
        //     },
        // });
}
