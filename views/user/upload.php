<div class="background"></div>
<div class="container upload">
    <div class="upload-file">
        <div class="upload-sub-1">
            <div id="profile__title"> Hướng dẫn sử dụng</div>
            <ul>
                <li>- Tài liệu là 01 file hoàn chỉnh với định dạng .pdf có đầy đủ các nội dung (từ
                    trang bìa - trang phụ lục).</li>
                <li>- Các trường thông tin bắt buộc (*) phải điền đầy đủ.</li>
                <li>- Tên file được đặt theo cú pháp: MSSV_Họ tên(VD: 2100143_TruongVanDat).</li>
                <li> <strong>B1.</strong> Bạn cần đăng nhập để sử dụng chức năng này.</li>
                <li> <strong>B2.</strong> Điền đầy đủ thông tin theo biểu mẫu.</li>
                <li> <strong>B3.</strong> Chọn Browse để tải file tài liệu cần nộp.</li>
                <li> <strong>B4.</strong> Chọn "GHI PHIẾU" để tải lên.</li>
                <li> <strong>B5.</strong> Chờ thông báo “Nộp tài liệu số thành công!”.</li>
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
                            <input type="text" readonly value="<?= $_SESSION['user']['username'] ?>">
                            <label for="">Tác giả <span style="color: red;">*</span></label>
                            <input type="text" id="creator">
                            <label for="">Nhan đề <span style="color: red;">*</span></label>
                            <input type="text" id="title">
                        </div>
                        <div class="form-infor">
                            <label for="">Họ & tên</label>
                            <input type="text" readonly value="<?= $_SESSION['user']['fullName'] ?>">
                            <label for="">Email <span style="color: red;">*</span></label>
                            <input type="text" id="email">
                            <label for="">Loại tài liệu<span style="color: red;">*</span></label>
                            <select id="type">
                                <option value="1">Bài giảng</option>
                                <option value="2">Giáo trình</option>
                                <option value="3">Đề tài NCKH</option>
                                <option value="4">Luận văn</option>
                                <option value="5">Luận án</option>
                                <option value="6">Tiểu luận/ĐATN</option>
                            </select>
                        </div>
                    </div>

                    <div class="title-upload">
                        <label for="">Tải lên tài liệu <span style="color: red;">*</span></label>
                        <input type="file" name="fileName" id="fileName" accept="application/pdf" style="padding: 10px 0">
                    </div>

                    <div class="btn-upload">
                        <button type="button" id="upload-file" name="upload"> <i
                                class="fa-solid fa-cloud-arrow-up fa-lg"></i> GHI PHIẾU
                    </div>

                    <h2 style="font-size: 16px; text-transform: uppercase; padding: 10px 0; color: var(--green-color);">
                        Danh sách tài liệu</h2>
                </form>
                <table class="table-upload">
                    <tr>
                        <th style="width: 5%">#</th>
                        <th style="width: 50%">File dữ liệu số</th>
                        <th style="width: 40%">Tác giả</th>
                        <th style="width: 5%"></th>
                    </tr>
                    <?php foreach ($data as $key => $upload) {
                        ?>
                        <tr>
                            <td><?= $key + 1 ?></td>
                            <td><a href="<?= $upload[1] ?>"><?= $upload[2] ?>.pdf</a></td>
                            <td><?= $upload[3] ?></td>
                            <td>
                                <button name="delete" id="<?= $upload[0] ?>"><i class="fa-regular fa-trash-can"></i></button>
                            </td>
                        </tr>
                    <?php } ?>

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
            var file = $('#fileName')[0].files[0];
            var email = $('#email').val();
            var creator = $('#creator').val();
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
                        email1: email,
                        title1: title,
                        creator1: creator,
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

</script>