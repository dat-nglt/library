<div class="body__container">
    <div class="list__container">
        <div>
            <div style="flex: 1;display:flex;justify-content: space-between">
                <div>
                    <span>Danh sách sách</span><button onclick="openFormAdd()" id="list__add-btn" type="button">Thêm
                        sách</button>
                </div>
                <div style="display:flex; gap: 5px; justify-content: center; padding: 0 0 5px;align-items: center;">
                    <fieldset>
                        <legend>Tìm kiếm</legend>
                        <form action="" method="post" class="admin__form-search">
                            <input type="text" name="search-book" placeholder="Tên, tác giả, năm xuất bản" autocomplete="off">
                            <select name="category-book" id="category-book">
                                <option value="all" <?php if ($_SESSION['category-book'] === 'all')
                                    echo 'selected' ?>>
                                        Tất cả
                                    </option>
                                <?php foreach ($listCategory as $key => $value) { ?>
                                    <option value="<?= $value['idCategory'] ?>" <?php if ($_SESSION['category-book'] === $value['idCategory'])
                                          echo 'selected' ?>>
                                        <?= $value['nameCategory'] ?>
                                    </option>
                                <?php } ?>
                            </select>
                            <button type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
                        </form>
                    </fieldset>
                    <fieldset>
                        <legend>Sắp xếp</legend>
                        <form action="" method="post" class="admin__form-search">
                            <select name="sort-book" id="">
                                <option value="desc" <?php if ($_SESSION['sort-book'] === 'desc')
                                    echo 'selected' ?>>
                                        Mới nhất
                                    </option>
                                    <option value="asc" <?php if ($_SESSION['sort-book'] === 'asc')
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
                    <th style="width: 5%;">#</th>
                    <th style="width: 19%;">Tên sách</th>
                    <th style="width: 10%;">Tác giả</th>
                    <th style="width: 10%;">Hình ảnh</th>
                    <th style="width: 10%;">Số lượng</th>
                    <th style="width: 10%;">Nhà XB</th>
                    <th style="width: 9%;">Năm XB</th>
                    <th style="width: 11%;">Thể loại</th>
                    <th style="width: 10%;">Mô tả</th>
                    <th style="width: 6%;"></th>
                </tr>
                <?php
                                $stt = (($current_page - 1) * $limit) + 1;
                                foreach ($listBook as $key => $value) {
                                    ?>
                <tr class="list__content">
                    <td><?= $stt ?></td>
                    <td>
                        <div class="list__hidden-text" style="-webkit-line-clamp: 2;"><?= $value[1] ?></div>
                    </td>
                    <td>
                        <div class="list__hidden-text" style="-webkit-line-clamp: 2;"><?= $value[4] ?></div>
                    </td>
                    <td>
                        <div style="display: flex; align-items: center; justify-content: center">
                            <?php if($value[3] === ''){?>
                                <img style="height: 80%; width: 80%" src="https://res.cloudinary.com/di37whq60/image/upload/v1716194722/image/axdown7pmlzlgs7yelkd.png" alt="<?= $value[1] ?>">
                            <?php }else{ ?>
                                <img style="height: 80%; width: 80%" src="<?= $value[3] ?>" alt="<?= $value[1] ?>">
                            <?php }?>
                    </div>
                    </td>
                    <td>
                        <div class="list__hidden-text"><?= $value[2] ?></div>
                    </td>
                    <td>
                        <div class="list__hidden-text" style="-webkit-line-clamp: 2;"><?= $value[5] ?>
                        </div>
                    </td>
                    <td>
                        <div class="list__hidden-text"><?= $value[6] ?></div>
                    </td>
                    <td>
                        <div class="list__hidden-text"><?= $value[9] ?></div>
                    </td>
                    <td>
                        <div class="list__hidden-text"  style="-webkit-line-clamp: 2;"><?= $value[7] ?></div>
                    </td>
                    <td>
                        <div>
                            <button class="list__action-open-edit" type="button" data-id="<?= $value[0] ?>"><i
                                    class="fa-solid fa-pen-to-square list__icon-edit"></i></button>
                            <button class="list__action-btn" type="button" data-id="<?= $value[0] ?>"><i
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
                        echo '<a href="?controller=admin&action=book&page=1"> <button><i class="fa-solid fa-angles-left"></i></button></a>';
                    }
                    if ($current_page > 1) {
                        echo ' <a href="?controller=admin&action=book&page=' . ($current_page - 1) . '"><button><i class="fa-solid fa-angle-left"></i></button></a>';
                    }
                    for ($i = 1; $i <= $total_page; $i++) {
                        if ($i != $current_page) {
                            if ($i > $current_page - 3 && $i < $current_page + 3) {
                                echo '<a href="?controller=admin&action=book&page=' . $i . '"><button class="button">' . $i . '</button></a>';
                            }
                        } else {
                            echo '<a href="?controller=admin&action=book&page=' . $i . '" class="button-current"><button class="button" >' . $i . '</button></a>';
                        }
                    }
                    if ($current_page < $total_page) {
                        echo '<a href="?controller=admin&action=book&page=' . ($current_page + 1) . '"> <button><i class="fa-solid fa-angle-right"></i></button></a>';
                    }
                    if ($current_page < $total_page - 2) {
                        echo '<a href="?controller=admin&action=book&page=' . ($total_page) . '"><button><i class="fa-solid fa-angles-right"></i></button></a>';
                    }
                }
                ?>
            </div>

            <?php if ($_SESSION['search-book'] != '') { ?>
                <span>Từ khóa đã tìm kiếm: <span><?= $_SESSION['search-book'] ?></span></span>
            <?php } ?>
    </div>
</div>
<script src="./js/admin/book/openFormAdd.js"></script>
<script src="./js/admin/closeFormAdd.js"></script>
<script src="./js/admin/book/openFormEdit.js"></script>
<script src="./js/admin/book/deleteBook.js"></script>
<script src="./js/admin/changeImg.js"></script>
<script src="./js/admin/book/editBook.js"></script>


