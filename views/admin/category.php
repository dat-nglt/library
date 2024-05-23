<div class="body__container">
    <div class="list__container">
        <div>
            <div style="flex: 1;display:flex;justify-content: space-between">
                <div>
                    <span>Danh sách thể loại sách</span><button onclick="openFormAdd()" id="list__add-btn" type="button">Thêm
                        thủ công</button>
                </div>
                <div style="display:flex; gap: 5px; justify-content: center; padding: 0 0 5px;align-items: center;">
                    <fieldset>
                        <legend>Tìm kiếm</legend>
                        <form action="?controller=admin&action=category" method="post" class="admin__form-search">
                            <input type="text" name="search-category" placeholder="Tên thể loại" autocomplete="off">
                            <button type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
                        </form>
                    </fieldset>
                    <fieldset>
                        <legend>Sắp xếp</legend>
                        <form action="?controller=admin&action=category" method="post" class="admin__form-search">
                            <select name="sort-category" id="">
                                <option value="desc" <?php if ($_SESSION['sort-category'] === 'desc')
                                    echo 'selected' ?>>
                                        Mới nhất
                                    </option>
                                    <option value="asc" <?php if ($_SESSION['sort-category'] === 'asc')
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
                    <th style="width: 10%;">#</th>
                    <th style="width: 84%;">Tên thể loại</th>
                    <th style="width: 6%;"></th>
                </tr>
                <?php
                                $stt = (($current_page - 1) * $limit) + 1;
                                foreach ($listCategory as $key => $value) {
                                    ?>
                <tr class="list__content">
                    <td><?= $stt ?></td>
                    <td>
                        <div class="list__hidden-text"><?= $value[1] ?></div>
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
                        echo '<a href="?controller=admin&action=category&page=1"> <button><i class="fa-solid fa-angles-left"></i></button></a>';
                    }
                    if ($current_page > 1) {
                        echo ' <a href="?controller=admin&action=category&page=' . ($current_page - 1) . '"><button><i class="fa-solid fa-angle-left"></i></button></a>';
                    }
                    for ($i = 1; $i <= $total_page; $i++) {
                        if ($i != $current_page) {
                            if ($i > $current_page - 3 && $i < $current_page + 3) {
                                echo '<a href="?controller=admin&action=category&page=' . $i . '"><button class="button">' . $i . '</button></a>';
                            }
                        } else {
                            echo '<a href="?controller=admin&action=category&page=' . $i . '" class="button-current"><button class="button" >' . $i . '</button></a>';
                        }
                    }
                    if ($current_page < $total_page) {
                        echo '<a href="?controller=admin&action=category&page=' . ($current_page + 1) . '"> <button><i class="fa-solid fa-angle-right"></i></button></a>';
                    }
                    if ($current_page < $total_page - 2) {
                        echo '<a href="?controller=admin&action=category&page=' . ($total_page) . '"><button><i class="fa-solid fa-angles-right"></i></button></a>';
                    }
                }
                ?>
            </div>
            <?php if ($_SESSION['search-category'] != '') { ?>
                <span>Từ khóa đã tìm kiếm: <span><?= $_SESSION['search-category'] ?></span></span>
            <?php } ?>
        </div>
    </div>
</div>
<script src="./js/admin/category/openFormAdd.js"></script>
<script src="./js/admin/closeFormAdd.js"></script>
<script src="./js/admin/category/openFormEdit.js"></script>
<script src="./js/admin/category/delete.js"></script>