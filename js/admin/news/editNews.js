function submitNewsEdit() {
    $.cloudinary.config({
        cloud_name: "di37whq60",
        api_key: "287339152575881",
        api_secret: "0ghXMK9HlG7IFL3l3njbLKFQgXo",
    });

    var id = $("#id").val();
    var title = $("#title").val();
    var content = editor.getData();

    if (
        title.trim() === "" ||
        content.trim() === ""
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
            title,
            content,
            id,
            image
        };
        $.ajax({
            type: "POST",
            url: "./services/admin/news/editNews.php",
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
                    window.location.assign("?controller=admin&action=news");
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
                    title,
                    content,
                    id,
                    image: response.secure_url,
                };
               
                $.ajax({
                    type: "POST",
                    url: "./services/admin/news/editNews.php",
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
                                "?controller=admin&action=news"
                            );
                        });
                    },
                });
            },
            error: function () {
                Swal.fire({
                    title: "Thông báo",
                    text: "Thay đổi ảnh bìa thất bại",
                    icon: "error",
                    showConfirmButton: true,
                }).then(function () {
                    window.location.assign("?controller=admin&action=news");
                });
            },
        });
    }
}
