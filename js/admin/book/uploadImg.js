function submitBook() {
    $.cloudinary.config({
        cloud_name: 'di37whq60',
        api_key: '287339152575881',
        api_secret: '0ghXMK9HlG7IFL3l3njbLKFQgXo'
    });
            var file = $('#newImg')[0].files[0];
        if (file === undefined) {
            var name = $("#input-name").val();
        var creator = $("#input-creator").val();
        var count = $("#input-count").val();
        var publisher = $("#input-publisher").val();
        var dateBook = $("#input-date-book").val();
        var des = $("#input-des").val();
        var category = $("#category-book-add").val();
        var data = {
            name,
            creator,
            count,
            publisher,
            dateBook,
            des,
            category,
        };
            $.ajax({
                type: 'POST',
                url: './services/admin/book/upload.php',
                dataType: 'json',
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
                        text: "Thêm sách không thành công",
                        icon: "success",
                        showConfirmButton: true,
                      }).then(function () {
                          window.location.assign("?controller=admin&action=book");
                      });
                  },
            });
        } else {
            var formData = new FormData();
            formData.append('file', file);
            formData.append('upload_preset', "quanlikhohang");
            $.ajax({
                url: 'https://api.cloudinary.com/v1_1/di37whq60/image/upload',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {
                    var name = $("#input-name").val();
                    var creator = $("#input-creator").val();
                    var count = $("#input-count").val();
                    var publisher = $("#input-publisher").val();
                    var dateBook = $("#input-date-book").val();
                    var des = $("#input-des").val();
                    var category = $("#category-book-add").val();
                    var data = {
                        name,
                        creator,
                        count,
                        publisher,
                        dateBook,
                        des,
                        image: response.secure_url,
                        category,
                    };
                    console.log(data);
                    $.ajax({
                        type: 'POST',
                        url: './services/admin/book/upload.php',
                        dataType: 'json',
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
                                text: "Thêm sách không thành công",
                                icon: "error",
                                showConfirmButton: true,
                              }).then(function () {
                        window.location.assign("?controller=admin&action=book");
                    });
    
                          },
                    });
                },
                error: function () {
                    Swal.fire({
                        title: "Thông báo",
                        text: "Thêm ảnh sách thất bại",
                        icon: "error",
                        showConfirmButton: true,
                    }).then(function () {
                        window.location.assign("?controller=admin&action=book");
                    });
                }
            });
        }
        }



