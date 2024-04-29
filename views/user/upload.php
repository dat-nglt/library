<div class="background"></div>
<div class="container upload">
    <div class="upload-file">
        <form action="" method="post" enctype="multipart/form-data">
            <div class="form-upload">
                <div class="form-upload-sub">
                    <label for="">Số phiếu</label>
                    <input type="text" name="fileName" id="fileName">
                    <label for="">Số thẻ</label>
                    <input type="text" name="fileName" id="fileName">
                    <label for="">Họ & tên</label>
                    <input type="text" name="fileName" id="fileName">
                </div>
                <div class="form-upload-sub">
                    <label for="">Số phiếu</label>
                    <input type="text" name="fileName" id="fileName">
                    <label for="">Số thẻ</label>
                    <input type="text" name="fileName" id="fileName">
                    <label for="">Tải lên tài liệu</label>
                    <input type="file" name="fileToUpload" id="fileToUpload">
                </div>
            </div>
            <button type="button" id="upload-file" name="upload" style="padding: 10px 30px; background:red;">

        </form>
    </div>
</div>

<script>
    $(document).ready(function () {
        $.cloudinary.config({
            cloud_name: 'dfjcxmlot',
            api_key: '228961218815535',
            api_secret: 'gpjAXY5kGhg40Hd5adbcMUIeV84'
        });
        $('#upload-file').click(function () {
            var file = $('#fileToUpload')[0].files[0];
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
                    console.log('tc');
                    var postData = {
                        uploadURL: response.secure_url
                    }
                    $.ajax({
                        type: 'POST',
                        url: '?controllers=user&action=upload',
                        data: postData,
                        success: function (data) {
                            Swal.fire({
                                title: "Thông báo",
                                text: "Thay đổi avatar thành công",
                                icon: "success",
                                showConfirmButton: true,
                            }).then(function () {
                                // window.location.assign("http://localhost/qlkh/src/index.php?act=profile");
                            });
                        }, error: function (xhr, status, error) {
                            Swal.fire({
                                title: "Thông báo",
                                text: "Thay đổi avatar thất bại",
                                icon: "error",
                                showConfirmButton: true,
                            }).then(function () {
                                // window.location.assign("http://localhost/qlkh/src/index.php?act=profile");
                            });
                        }
                    });
                },
                error: function (xhr, status, error) {
                    console.log('tb');
                    Swal.fire({
                        title: "Thông báo",
                        text: "Thay đổi avatar thất bại",
                        icon: "error",
                        showConfirmButton: true,
                    }).then(function () {
                        // window.location.assign("http://localhost/qlkh/src/index.php?act=profile");
                    });
                }
            });
        });
    })

</script>