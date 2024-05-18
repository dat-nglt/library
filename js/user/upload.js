$(document).ready(function () {
    $.cloudinary.config({
        cloud_name: 'dfjcxmlot',
        api_key: '228961218815535',
        api_secret: 'gpjAXY5kGhg40Hd5adbcMUIeV84'
    });
    $('#upload-file').click(function () {
        var file = $('#fileName')[0].files[0];
        var title = $('#title').val();
        var type = $('#type').val();
        var formData = new FormData();
        formData.append('file', file);
        formData.append('upload_preset', "library_CTUT");

        $.ajax({
            url: 'https://api.cloudinary.com/v1_1/dfjcxmlot/auto/upload',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                var postData = {
                    uploadURL: response.secure_url,
                    type1: type,
                    title1: title,
                }
                $.ajax({
                    type: 'POST',
                    url: '?controller=user&action=upload',
                    data: postData,
                    success: function (data) {
                        Swal.fire({
                            title: "Thông báo",
                            text: "Upload tài liệu thành công",
                            icon: "success",
                            showConfirmButton: true,
                        }).then(function () {
                            window.location.assign("http://localhost/library/?controller=user&action=upload");
                        });
                    }, error: function (xhr, status, error) {
                        Swal.fire({
                            title: "Thông báo",
                            text: "Upload tài liệu thất bại",
                            icon: "error",
                            showConfirmButton: true,
                        }).then(function () {
                            window.location.assign("http://localhost/library/?controller=user&action=upload");
                        });
                    }
                });
            },
            error: function (xhr, status, error) {
                console.log('tb');
                Swal.fire({
                    title: "Thông báo",
                    text: "Upload tài liệu thất bại",
                    icon: "error",
                    showConfirmButton: true,
                }).then(function () {
                    window.location.assign("http://localhost/library/?controller=user&action=upload");
                });
            }
        });
    });
})