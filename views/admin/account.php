<div class="body__container">
    <div class="list__container">
        <div>
            <div style="flex: 1;display:flex;justify-content: space-between">
                <div>
                    <span>Danh sách tài khoản</span><button onclick="return openFormAdd()" id="list__add-btn" type="button">Thêm
                    tài khoản</button>
                </div>
                <div style="display:flex; gap: 5px; justify-content: center; padding: 0 0 5px;align-items: center;">
                    <fieldset >
                        <legend>Tìm kiếm</legend>
                        <form action="" method="post" class="admin__form-search">
                            <input type="text" placeholder="MSSV, họ tên sinh viên">
                            <button type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
                        </form>
                        </fieldset>
                    <fieldset >
                        <legend>Sắp xếp</legend>
                        <form action="" method="post" class="admin__form-search">
                            <select  name="sort-product" id="">
                                <option value="desc">Mới nhất
                                </option>
                                <option value="asc">Cũ nhất
                                </option>
                            </select>
                            <button type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
                        </form>
                        </fieldset>
                </div>
            </div>
        </div>
        <table>
            <tr>
                <th style="width: 5%;">#</th>
                <th style="width: 7%;">MSSV</th>
                <th style="width: 30%;">Họ tên</th>
                <th style="width: 10%;">SĐT</th>
                <th style="width: 15%;">Email</th>
                <th style="width: 23%;">Lớp</th>
                <th style="width: 10%;"></th>
            </tr>
        <?php for ($i=1; $i <= 15; $i++) { ?>
            <tr class="list__content">
                <td><?= $i ?></td>
                <td>121111</td>
                <td>
                    <div class="list__hidden-text">Lê Nguyễn Minh Hòa</div>
                </td>
                
                <td>0836752979</td>
                <td>
                    <div class="list__hidden-text">lnmhoa2101251@student.ctuet.edu.vnlnmhoa2101251@student.ctuet.edu.vn lnmhoa2101251@student.ctuet.edu.vn</div>
                </td>
                <td>
                    <div class="list__hidden-text">Kỹ Thuật Phần Mềm 0121</div>
                </td>
                <td>
                    <div>
                    <a href="index.php?act=detail-product&id=<?=$idProduct?>"> <i class="fa-solid fa-pen-to-square list__icon-edit"></i></a>
                    <form action="" method="post">
                        <input type="hidden" name="id-delete" value="<?= $idProduct?>">
                        <button class="list__action-btn" type="submit" name="delete-product"><i
                            class="fa-solid fa-trash list__icon-del"></i></button></form></div>
                </td>
            </tr>
        <?php } ?>                  
        </table>
        <div class="list__paging">
        <a href="index.php?act=product&page="><button class="button">1</button></a>
        <a href="index.php?act=product&page="><button class="button">1</button></a>
        <a href="index.php?act=product&page="><button class="button">1</button></a>
        <a href="index.php?act=product&page="><button class="button">1</button></a>
        <a href="index.php?act=product&page="><button class="button">1</button></a>
               <!-- <?php
        if ($total_page > 1) {
            if ($current_page > 3) {
                echo '<a href="index.php?act=product&page=1"> <button><i class="fa-solid fa-angles-left"></i></button></a>';
            }
            if ($current_page > 1) {
                echo ' <a href="index.php?act=product&page=' . ($current_page - 1) . '"><button><i class="fa-solid fa-angle-left"></i></button></a>';
            } 
            for ($i = 1; $i <= $total_page; $i++) {
                if ($i != $current_page) {
                    if ($i > $current_page - 3 && $i < $current_page + 3) {
                        echo '<a href="index.php?act=product&page=' . $i . '"><button class="button">' . $i . '</button></a>';
                    }
                } else {
                    echo '<a href="index.php?act=product&page=' . $i . '" class="button-current"><button class="button" >' . $i . '</button></a>';
                }
            }
            if ($current_page < $total_page) {
                echo '<a href="index.php?act=product&page=' . ($current_page + 1) . '"> <button><i class="fa-solid fa-angle-right"></i></button></a>';
            }
            if ($current_page < $total_page - 2) {
                echo '<a href="index.php?act=product&page=' . ($total_page) . '"><button><i class="fa-solid fa-angles-right"></i></button></a>';
            }
        }
        ?> -->
                </div>
    </div>
    <div class="list__form">
        <form action="" method="post" class="list__form-add" onsubmit="return checkEmptyInput()">
            <div class="list__form-title">
                <span>Thêm tài khoản</span><i class="fa-solid fa-xmark close-icon"
                    onclick="return closeResetFormAdd()"></i>
            </div>
            <div class="list__form-content">
                <div class="list__form-nav">
                    <div class="list__nav-add-handmade nav-selected" onclick="changeFormHandmade()">Thủ công</div>
                    <div class="list__nav-add-excel" onclick="changeFormExcel()">File excel</div>
                </div>
                <div class="list__add-handmade open" style="padding: 5px 5px;flex: 1;">
                <div class="list__form-container-box">
                <div class="list__form-box">
                    <label for="category-name" class="list__form-label">MSSV</label>
                    <input type="number" class="list__form-input" name="name-product" id="category-name"
                        onblur="return checkEmptyInput()" placeholder="Nhập mã số sinh viên">
                    <small class="list__form-error-input"></small>
                </div>
                <div class="list__form-box">
                    <label for="category-name" class="list__form-label">Họ và tên</label>
                    <input type="text" class="list__form-input" name="name-product" id="category-name"
                        onblur="return checkEmptyInput()" placeholder="Nhập họ và tên">
                    <small class="list__form-error-input"></small>
                </div>
                </div>  
                <div class="list__form-container-box">
                <div class="list__form-box">
                    <label for="category-name" class="list__form-label">Ngày sinh</label>
                    <input type="date" class="list__form-input" name="name-product" id="category-name"
                        onblur="return checkEmptyInput()" placeholder="Nhập ngày sinh">
                    <small class="list__form-error-input"></small>
                </div>
                <div class="list__form-box">
                    <label for="category-name" class="list__form-label">Địa chỉ</label>
                    <input type="text" class="list__form-input" name="name-product" id="category-name"
                        onblur="return checkEmptyInput()" placeholder="Nhập địa chỉ">
                    <small class="list__form-error-input"></small>
                </div>
                </div>  
                <div class="list__form-container-box">
                <div class="list__form-box">
                    <label for="category-name" class="list__form-label">Số điện thoại</label>
                    <input type="number" class="list__form-input" name="name-product" id="category-name"
                        onblur="return checkEmptyInput()" placeholder="Nhập số điện thoại">
                    <small class="list__form-error-input"></small>
                </div>
                <div class="list__form-box">
                    <label for="category-name" class="list__form-label">Email</label>
                    <input type="text" class="list__form-input" name="name-product" id="category-name"
                        onblur="return checkEmptyInput()" placeholder="Nhập email">
                    <small class="list__form-error-input"></small>
                </div>
                </div>  
                <div class="list__form-container-box">
                <div class="list__form-box">
                    <label for="category-name" class="list__form-label">Số CCCD/CNND</label>
                    <input type="number" class="list__form-input" name="name-product" id="category-name"
                        onblur="return checkEmptyInput()" placeholder="Nhập số CCCD/CNND">
                    <small class="list__form-error-input"></small>
                </div>
                <div class="list__form-box">
                    <label for="category-name" class="list__form-label">Mật khẩu</label>
                    <input type="text" class="list__form-input" name="name-product" id="category-name"
                        onblur="return checkEmptyInput()" placeholder="Nhập lớp">
                    <small class="list__form-error-input"></small>
                </div>
                </div> 
                <div class="list__form-container-box" style="grid-template-columns: 25% 71%;">
                <div class="list__form-box">
                    <label for="category-name" class="list__form-label">Lớp</label>
                    <select name="" id="" class="list__select-class" onchange="handleSelectClass()">
                        <option value="0">Đã có</option>
                        <option value="1">Thêm mới</option>
                    </select>
                </div>
                <div class="list__form-box">
                    <select name="" id="" class="list__select-class-select" style="margin-top: 27px; margin-bottom: 0;">
                        <option value="0">KTPM0121</option>
                        <option value="1">HTTT0121</option>
                        <option value="2">KHDL0121</option>
                        <option value="3">NNA0121</option>
                    </select>
                    <input type="text" class="list__select-class-input" style="margin-top: 27px; margin-bottom: 0; display:none" placeholder="Nhập lớp">
                </div>
                </div>      
                </div>
                <div class="list__add-file-excel close">
                <div class="list__form-container-box">
                <div class="list__form-box">
                    <label for="category-name" class="list__form-label">MSSV</label>
                    <input type="number" class="list__form-input" name="name-product" id="category-name"
                        onblur="return checkEmptyInput()" placeholder="Nhập mã số sinh viên">
                    <small class="list__form-error-input"></small>
                </div>
                <div class="list__form-box">
                    <label for="category-name" class="list__form-label">Họ và tên</label>
                    <input type="text" class="list__form-input" name="name-product" id="category-name"
                        onblur="return checkEmptyInput()" placeholder="Nhập họ và tên">
                    <small class="list__form-error-input"></small>
                </div>
                </div> 
                </div>
            </div>
            <div class="list__form-btn">
                <button type="button" class="close-btn" onclick="return closeFormAdd()">Đóng</button>
                <button type="submit" name="add-product">Thêm</button>
            </div>
        </form>
    </div>
</div>
<script src="./js/admin/openAdd.js"></script>
<script src="./js/admin/changeDisplayAdd.js"></script>