<div class="body__container">
            <div class="list__container">
                <div><span>Danh sách tài khoản</span><button onclick="return openFormAdd()" id="list__add-btn" type="button">Thêm
                        tài khoản</button>
                        <div style="flex: 1; margin: 0; display:flex;justify-content: flex-end;">
                <fieldset >
            <legend>Tìm kiếm tài khoản</legend>
            <form action="" method="post" >
               <input type="text" placeholder="Mã số sinh viên">
                <button type="submit">OK</button>
            </form>
        </fieldset>
        <fieldset >
        <legend>Sắp xếp hàng hóa</legend>
            <form action="" method="post" >
                <select  name="sort-product" id="">
                    <option value="desc">Mới nhất
                    </option>
                    <option value="asc">Cũ nhất
                    </option>
                </select>
                <button type="submit">OK</button>
            </form>
        </fieldset>
                </div></div>
                <table>
                    <tr>
                        <th style="width: 5%;">STT</th>
                        <th style="width: 10%;">Mã hàng</th>
                        <th style="width: 30%;">Tên hàng</th>
                        <th style="width: 15%;">Số lượng</th>
                        <th style="width: 13%;">Mã danh mục</th>
                        <th style="width: 15%;">Ghi chú</th>
                        <th style="width: 15%;">Hành động</th>
                    </tr>
                    <tr class="list__content">
                        <td>1</td>
                        <td>12</td>
                        <td>
                            <div class="list__hidden-text">123</div>
                        </td>
                        <td>1234</td>
                        <td>12345</td>
                        <td>
                            <div class="list__hidden-text">123456</div>
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
                    <tr class="list__content">
                        <td>1</td>
                        <td>12</td>
                        <td>
                            <div class="list__hidden-text">123</div>
                        </td>
                        <td>1234</td>
                        <td>12345</td>
                        <td>
                            <div class="list__hidden-text">123456</div>
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
                    <tr class="list__content">
                        <td>1</td>
                        <td>12</td>
                        <td>
                            <div class="list__hidden-text">123</div>
                        </td>
                        <td>1234</td>
                        <td>12345</td>
                        <td>
                            <div class="list__hidden-text">123456</div>
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
                    <tr class="list__content">
                        <td>1</td>
                        <td>12</td>
                        <td>
                            <div class="list__hidden-text">123</div>
                        </td>
                        <td>1234</td>
                        <td>12345</td>
                        <td>
                            <div class="list__hidden-text">123456</div>
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
                    <tr class="list__content">
                        <td>1</td>
                        <td>12</td>
                        <td>
                            <div class="list__hidden-text">123</div>
                        </td>
                        <td>1234</td>
                        <td>12345</td>
                        <td>
                            <div class="list__hidden-text">123456</div>
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
                    <tr class="list__content">
                        <td>1</td>
                        <td>12</td>
                        <td>
                            <div class="list__hidden-text">123</div>
                        </td>
                        <td>1234</td>
                        <td>12345</td>
                        <td>
                            <div class="list__hidden-text">123456</div>
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
                        <h1>Thêm hàng hóa</h1><i class="fa-solid fa-xmark close-icon"
                            onclick="return closeResetFormAdd()"></i>
                    </div>
                    <div class="list__form-content">
                        <div class="list__form-box">
                            <label for="category-name" class="list__form-label">Tên hàng hóa</label>
                            <input type="text" class="list__form-input" name="name-product" id="category-name"
                                onblur="return checkEmptyInput()" placeholder="Nhập tên hàng hóa">
                            <small class="list__form-error-input"></small>
                        </div>
                        <div class="list__form-box">
                            <label for="category-name" class="list__form-label">Danh mục</label>
                            <select name="id-category" id="">
                                <?php foreach ($listCategory as $key => $value) {
                                    extract($value);?>
                                    <option value="<?= $idCategory ?>"><?= $nameCategory ?></option>
                                <?php }
                                ?>
                            </select>
                            <small class="list__form-error-input"></small>
                        </div>
                        <div class="list__form-box">
                            <label for="category-note" class="list__form-label">Ghi chú</label>
                            <textarea name="note-product" class="list__form-textarea"
                                id="category-note" cols="30" rows="10" placeholder="Nhập ghi chú"></textarea>
                            <small class="list__form-error-textarea"></small>
                        </div>
                    </div>
                    <div class="list__form-btn">
                        <button type="button" class="close-btn" onclick="return closeFormAdd()">Đóng</button>
                        <button type="submit" name="add-product">Thêm</button>
                    </div>
                </form>
            </div>
        </div>