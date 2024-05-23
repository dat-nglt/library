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
                            <input type="text" disabled value="<?= $_SESSION['user']['studentCode'] ?>">
                            <label for="">Nhan đề <span style="color: red;">*</span></label>
                            <input type="text" id="title">
                        </div>
                        <div class="form-infor">
                            <label for="">Họ & tên</label>
                            <input type="text" disabled value="<?= $_SESSION['user']['fullName'] ?>">
                            <label for="">Loại tài liệu<span style="color: red;">*</span></label>
                            <select id="type">
                                <?php foreach ($data['typeData'] as $type) {
                                    ?>
                                    <option value="<?= $type['idCategory'] ?>"><?= $type['nameCategory'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>

                    <div class="title-upload">
                        <label for="">Tải lên tài liệu <span style="color: red;">*</span></label>
                        <input type="file" name="fileName" id="fileName" accept="application/pdf"
                            style="padding: 10px 0">
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
                        <th style="width: 40%">File tài liệu số</th>
                        <th style="width: 30%">Loại tài liệu</th>
                        <th style="width: 20%">Trạng thái</th>
                        <th style="width: 5%"></th>
                    </tr>

                    <?php foreach ($data['uploadData'] as $key => $upload) {
                        ?>
                        <tr>
                            <td><?= $key + 1 ?></td>
                            <td><a href="<?= $upload['uploadURL'] ?>" target="_blank"><?= $upload['titleUpload'] ?>.pdf</a>
                            </td>
                            <td><?= $upload['nameCategory'] ?></td>
                            <td><?php
                            if ($upload['nameBook'] === null) {
                                echo "Chờ xác nhận";
                            } else {
                                echo "Đã duyệt";
                            }
                            ?></td>
                            <td>
                                <button type="button" name="delete" class="delete-btn"
                                    data-id="<?= $upload['idUpload'] ?>"><i class="fa-regular fa-trash-can"></i></button>
                            </td>
                        </tr>
                    <?php } ?>

                </table>
            </div>
        </div>
    </div>
</div>

<script src="./js/user/upload.js"></script>
<script src="./js/user/deleteUpload.js"></script>