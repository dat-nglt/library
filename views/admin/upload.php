<div class="body__container">
    <div class="list__container">
        <div>
            <div style="flex: 1;display:flex;justify-content: space-between">
                <div>
                    <span>Danh sách Tải lên</span><button onclick="openFormAdd()" id="list__add-btn"
                        type="button">UPLOAD +</button>
                </div>
                <div style="display:flex; gap: 5px; justify-content: center; padding: 0 0 5px;align-items: center;">
                    <fieldset>
                        <legend>Tìm kiếm</legend>
                        <form action="" method="post" class="admin__form-search">
                            <input type="text" name="search-upload" placeholder="Nhập từ khoá cần tìm..."
                                autocomplete="off">
                            <select name="category-upload" id="category-upload">
                                <option value="all" <?php if ($_SESSION['category-upload'] === 'all')
                                    echo 'selected' ?>>
                                        Tất cả
                                    </option>
                                    <?php
                                foreach ($listCategory as $value) { ?>
                                    <option value="<?= $value['idCategory'] ?>" <?php if ($_SESSION['category-upload'] === $value['idCategory'])
                                          echo 'selected' ?>>
                                        <?= $value['nameCategory'] ?>
                                    </option>
                                    <?php
                                } ?>
                            </select>
                            <button type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
                        </form>
                    </fieldset>
                    <fieldset>
                        <legend>Sắp xếp</legend>
                        <form action="" method="post" class="admin__form-search">
                            <select name="sort-upload" id="">
                                <option value="desc" <?php if ($_SESSION['sort-upload'] === 'desc')
                                    echo 'selected' ?>>
                                        Mới nhất
                                    </option>
                                    <option value="asc" <?php if ($_SESSION['sort-upload'] === 'asc')
                                    echo 'selected' ?>>Cũ
                                        nhất
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
                    <th style="width: 3%;">#</th>
                    <th style="width: 5%;">MSSV</th>
                    <th style="width: 10%;">Họ & tên</th>
                    <th style="width: 17%;">File dữ liệu số</th>
                    <th style="width: 10%;">Ngày tải lên</th>
                    <th style="width: 10%;">Danh mục</th>
                    <th style="width: 25%;">Tài liệu</th>
                    <th style="width: 13%;">Trạng thái</th>
                    <th style="width: 7%;"></th>
                </tr>
                <?php
                                $stt = (($current_page - 1) * $limit) + 1;
                                foreach ($listUpload as $key => $value) {
                                    ?>
                <tr class="list__content">
                    <td><?= $stt ?></td>
                    <td>
                        <div class="list__hidden-text" style="-webkit-line-clamp: 2;"><?= $value['studentCode'] ?></div>
                    </td>
                    <td>
                        <div class="list__hidden-text" style="-webkit-line-clamp: 2;"><?= $value['fullName'] ?></div>
                    </td>
                    <td>
                        <a target="_blank" href="<?= $value['uploadURL'] ?>" class="list__hidden-text"
                            style="-webkit-line-clamp: 2;"><?= $value['titleUpload'] ?>.pdf</a>
                    </td>
                    <td>
                        <div class="list__hidden-text" style="-webkit-line-clamp: 2;">
                            <?= date("d-m-Y", strtotime($value['timeUpload'])) ?>
                        </div>
                    </td>
                    <td>
                        <div class="list__hidden-text" style="-webkit-line-clamp: 2;"><?= $value['nameCategory'] ?>
                        </div>
                    </td>
                    <td>
                        <div class="list__hidden-text" style="-webkit-line-clamp: 2;"><?php
                        if ($value['nameBook'] === null) {
                            echo "...";
                        } else {
                            echo $value['nameBook'];
                        }
                        ?>
                        </div>
                    </td>
                    <td>
                        <div class="list__hidden-text" style="-webkit-line-clamp: 2;">
                            <?php
                            if ($value['nameBook'] === null) {
                                echo "Chờ xác nhận";
                            } else {
                                echo "Đã duyệt";
                            }
                            ?>
                        </div>
                    </td>
                    <td>
                        <div>
                            <button class="list__action-open-edit" type="button" data-id="<?= $value['idUpload'] ?>"><i
                                    class="fa-solid fa-pen-to-square list__icon-edit"></i></button>
                            <button class="list__action-btn" type="button" data-id="<?= $value['idUpload'] ?>"><i
                                    class="fa-solid fa-trash list__icon-del"></i></button>
                    </td>
                </tr>
                <?php $stt++;
                                } ?>
        </table>
        <div class="list__paging">
            <div>
                <?php
                if ($total_page > 1) {
                    if ($current_page > 3) {
                        echo '<a href="?controller=admin&action=upload&page=1"> <button><i class="fa-solid fa-angles-left"></i></button></a>';
                    }
                    if ($current_page > 1) {
                        echo ' <a href="?controller=admin&action=upload&page=' . ($current_page - 1) . '"><button><i class="fa-solid fa-angle-left"></i></button></a>';
                    }
                    for ($i = 1; $i <= $total_page; $i++) {
                        if ($i != $current_page) {
                            if ($i > $current_page - 3 && $i < $current_page + 3) {
                                echo '<a href="?controller=admin&action=upload&page=' . $i . '"><button class="button">' . $i . '</button></a>';
                            }
                        } else {
                            echo '<a href="?controller=admin&action=upload&page=' . $i . '" class="button-current"><button class="button" >' . $i . '</button></a>';
                        }
                    }
                    if ($current_page < $total_page) {
                        echo '<a href="?controller=admin&action=upload&page=' . ($current_page + 1) . '"> <button><i class="fa-solid fa-angle-right"></i></button></a>';
                    }
                    if ($current_page < $total_page - 2) {
                        echo '<a href="?controller=admin&action=upload&page=' . ($total_page) . '"><button><i class="fa-solid fa-angles-right"></i></button></a>';
                    }
                }
                ?>
            </div>

            <?php if ($_SESSION['search-upload'] != '') { ?>
                <span>Từ khóa đã tìm kiếm: <span><?= $_SESSION['search-upload'] ?></span></span>
            <?php } ?>
        </div>
    </div>

    <script>
        var listBook = <?php echo json_encode($listBook) ?>;
        var listCategory = <?php echo json_encode($getNameCategory) ?>;
    </script>
    <script src="./js/admin/upload/openFormAdd.js"></script>
    <script src="./js/admin/upload/openFormEdit.js"></script>
    <script src="./js/admin/closeFormAdd.js"></script>
    <script src="./js/admin/upload/deleteUpload.js"></script>
    <script src="./js/admin/upload/addUpload.js"></script>