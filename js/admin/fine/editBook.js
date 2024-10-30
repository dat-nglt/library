function submitBookEdit() {
    $.cloudinary.config({
        cloud_name: "di37whq60",
        api_key: "287339152575881",
        api_secret: "0ghXMK9HlG7IFL3l3njbLKFQgXo",
    });

    var id = $("#id_book").val();
    var name = $("#input-name").val();
    var creator = $("#input-creator").val();
    var count = $("#input-count").val();
    var publisher = $("#input-publisher").val();
    var dateBook = $("#input-date-book").val();
    var des = $("#input-des").val();
    var category = $("#category-book-add").val();

    if (category.trim() === "") {
        Swal.fire({
            title: "Thông báo",
            text: "Vui lòng thêm thể loại sách.",
            icon: "warning",
            showConfirmButton: true,
        });
        return;
    }

    if (
        name.trim() === "" ||
        creator.trim() === "" ||
        count.trim() === "" ||
        publisher.trim() === "" ||
        dateBook.trim() === ""
    ) {
        Swal.fire({
            title: "Thông báo",
            text: "Vui lòng nhập các thông tin bắt buộc.",
            icon: "warning",
            showConfirmButton: true,
        });
        return;
    }

    var file = $("#newImg")[0].files[0];
    if (file === undefined) {
        var image = $('#oldimg').attr('src');;
        var data = {
            name,
            creator,
            count,
            publisher,
            dateBook,
            des,
            category,
            id,
            image
        };
        $.ajax({
            type: "POST",
            url: "./services/admin/book/editBook.php",
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
                    text: "Chỉnh sửa không thành công",
                    icon: "error",
                    showConfirmButton: true,
                }).then(function () {
                    window.location.assign("?controller=admin&action=book");
                });
            },
        });
    } else {
        var formData = new FormData();
        formData.append("file", file);
        formData.append("upload_preset", "quanlikhohang");
        $.ajax({
            url: "https://api.cloudinary.com/v1_1/di37whq60/image/upload",
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                var data = {
                    name,
                    creator,
                    count,
                    publisher,
                    dateBook,
                    des,
                    image: response.secure_url,
                    category,
                    id,
                };
                console.log(data);
                $.ajax({
                    type: "POST",
                    url: "./services/admin/book/editBook.php",
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
                            text: "Chỉnh sửa không thành công",
                            icon: "error",
                            showConfirmButton: true,
                        }).then(function () {
                            window.location.assign(
                                "?controller=admin&action=book"
                            );
                        });
                    },
                });
            },
            error: function () {
                Swal.fire({
                    title: "Thông báo",
                    text: "Thay đổi ảnh sách thất bại",
                    icon: "error",
                    showConfirmButton: true,
                }).then(function () {
                    window.location.assign("?controller=admin&action=book");
                });
            },
        });
    }
}
