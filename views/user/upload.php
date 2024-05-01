<div class="background"></div>
<div class="container upload">
    <div class="upload-file">
        <div class="upload-sub-1">
            <div id="profile__title"> Hướng dẫn sử dụng</div>
            <ul>
                <li>- Tài liệu là 01 file hoàn chỉnh với định dạng .pdf có đầy đủ các nội dung (từ
                    trang bìa - trang phụ lục).</li>
                <li>- Các trường thông tin bắt buộc (*) phải điền đầy đủ.</li>
                <li>- Tên file được đặt theo cú pháp: MSSV_Họ tên_Loại tài liệu (VD: 2100143_TruongVanDat_LuanVan).</li>
                <li> <strong>B1.</strong> Bạn cần đăng nhập để sử dụng chức năng này.</li>
                <li> <strong>B2.</strong> Điền đầy đủ thông tin theo biểu mẫu.</li>
                <li> <strong>B3.</strong> Chọn Browse để tải file tài liệu cần nộp.</li>
                <li> <strong>B4.</strong> Chọn "GHI PHIẾU" để tải lên</li>
                <li> <strong>B5.</strong> Chờ thông báo “Nộp tài liệu số thành công!”</li>
                <li> <strong>B6.</strong> Chờ kiểm tra và duyệt tài liệu.</li>
            </ul>
        </div>

        <div class="upload-sub-2">
            <div id="profile__title">Upload tài liệu số</div>
            <div class="form-upload">
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="form-upload-sub">
                        <div class="form-infor">
                            <label for="">Số thẻ</label>
                            <input type="text" name="fileName" id="fileName">
                            <label for="">Tác giả <span style="color: red;">*</span></label>
                            <input type="text" name="fileName" id="fileName">
                            <label for="">Nhan đề <span style="color: red;">*</span></label>
                            <input type="text" name="fileName" id="fileName">
                        </div>
                        <div class="form-infor">
                            <label for="">Họ & tên</label>
                            <input type="text" name="fileName" id="fileName">
                            <label for="">Email <span style="color: red;">*</span></label>
                            <input type="text" name="fileName" id="fileName">
                            <label for="">Điện thoại <span style="color: red;">*</span></label>
                            <input type="text" name="fileName" id="fileName">
                        </div>
                    </div>

                    <div class="title-upload">
                        <label for="">Tải lên tài liệu <span style="color: red;">*</span></label>
                        <input type="file" name="fileToUpload" id="fileToUpload" style="padding: 10px 0">
                    </div>

                    <div class="btn-upload">
                        <button type="button" id="upload-file" name="upload"> <i
                                class="fa-solid fa-cloud-arrow-up fa-lg"></i> GHI PHIẾU
                    </div>

                    <h2 style="font-size: 16px; text-transform: uppercase; padding: 10px 0; color: var(--green-color);">Danh sách tài liệu</h2>
                </form>
                <table class="table-upload">
                    <tr>
                        <th style="width: 5%">#</th>
                        <th style="width: 50%">File dữ liệu số</th>
                        <th style="width: 25%">Nhan đề</th>
                        <th style="width: 15%">Tác giả</th>
                        <th style="width: 5%"></th>
                    </tr>
                    <tr>
                        <td>1</td>
                        <td>Maria Anders Maria AndersMaria AndersMaria AndersMaria AndersMaria AndersMaria Anders</td>
                        <td>Germany</td>
                        <td>Germany</td>
                        <td>&&&</td>
                    </tr>
                    <tr>
                        <td>12</td>
                        <td>Francisco Chang</td>
                        <td>Mexico</td>
                        <td>Germany</td>
                        <td>&&&</td>
                    </tr>
                </table>
            </div>
        </div>
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