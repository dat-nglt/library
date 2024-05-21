<div class="body__container">
    <div class="list__container">
        <div>
            <div style="flex: 1;display:flex;justify-content: space-between">
                <div>
                    <span>Danh sách mượn|trả </span><button onclick="openFormAdd()" id="list__add-btn" type="button">Thêm
                        phiếu mượn</button>
                </div>
                <div style="display:flex; gap: 5px; justify-content: center; padding: 0 0 5px;align-items: center;">
                    <fieldset>
                        <legend>Tìm kiếm</legend>
                        <form action="" method="post" class="admin__form-search">
                            <input type="text" name="search-borrow" placeholder="Tên, tác giả, năm xuất bản" autocomplete="off">
                            <select name="status-borrow" id="status-borrow">
                                <option value="all" <?php if ($_SESSION['status-borrow'] === 'all')
                                    echo 'selected' ?>>
                                        Tất cả
                                    </option>
                                    <option value="0" <?php if ($_SESSION['status-borrow'] === '0')
                                    echo 'selected' ?>>
                                       Yêu cầu
                                    </option>
                                    <option value="1" <?php if ($_SESSION['status-borrow'] === '1')
                                    echo 'selected' ?>>
                                        Mượn
                                    </option>
                                    <option value="2" <?php if ($_SESSION['status-borrow'] === '2')
                                    echo 'selected' ?>>
                                        Trả
                                    </option>
                            </select>
                            <button type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
                        </form>
                    </fieldset>
                    <fieldset>
                        <legend>Sắp xếp</legend>
                        <form action="" method="post" class="admin__form-search">
                            <select name="sort-borrow" id="">
                                <option value="desc" <?php if ($_SESSION['sort-borrow'] === 'desc')
                                    echo 'selected' ?>>
                                        Mới nhất
                                    </option>
                                    <option value="asc" <?php if ($_SESSION['sort-borrow'] === 'asc')
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
                    <th style="width: 7%;">MSSV</th>
                    <th style="width: 7%;">CCCD</th>
                    <th style="width: 26%;">Tên sách</th>
                    <th style="width: 10%;">Trạng thái</th>
                    <th style="width: 11%;">Day Request</th>
                    <th style="width: 10%;">Day Rental</th>
                    <th style="width: 10%;">Day Return</th>
                    <th style="width: 8%;"></th>
                </tr>
                <?php
                                $stt = (($current_page - 1) * $limit) + 1;
                                foreach ($listBorrow as $key => $value) {
                                    if($value[4] === '0'){
                                        $status = 'Đang chờ xét duyệt';
                                    }else if($value[4] === '1'){
                                        $status = 'Quá hạn xác nhận';
                                    }else if($value[4] === '2'){
                                        $status = 'Đang mượn';
                                    }else if($value[4] === '3'){
                                        $status = 'Đã trả';
                                    }else if($value[4] === '4'){
                                        $status = 'Quá hạn trả';
                                    }
                                ?>
                <tr class="list__content">
                    <td><?= $stt ?></td>
                    <td>
                        <div class="list__hidden-text"><?= $value[7] ?></div>
                    </td>
                    <td>
                        <div class="list__hidden-text"><?= $value[8] ?></div>
                    </td>
                    <td>
                        <div class="list__hidden-text" style="-webkit-line-clamp: 2;"><?= $value[9] ?></div>
                    </td>
                    <td>
                        <div class="list__hidden-text"><?= $status ?></div>
                    </td>
                    <td>
                        <div class="list__hidden-text"><?= $value[3] ?></div>
                    </td>
                    <td>
                        <div class="list__hidden-text"><?= $value[5] ?></div>
                    </td>
                    <td>
                        <div class="list__hidden-text"><?= $value[6] ?></div>
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
                        echo '<a href="?controller=admin&action=borrow&page=1"> <button><i class="fa-solid fa-angles-left"></i></button></a>';
                    }
                    if ($current_page > 1) {
                        echo ' <a href="?controller=admin&action=borrow&page=' . ($current_page - 1) . '"><button><i class="fa-solid fa-angle-left"></i></button></a>';
                    }
                    for ($i = 1; $i <= $total_page; $i++) {
                        if ($i != $current_page) {
                            if ($i > $current_page - 3 && $i < $current_page + 3) {
                                echo '<a href="?controller=admin&action=borrow&page=' . $i . '"><button class="button">' . $i . '</button></a>';
                            }
                        } else {
                            echo '<a href="?controller=admin&action=borrow&page=' . $i . '" class="button-current"><button class="button" >' . $i . '</button></a>';
                        }
                    }
                    if ($current_page < $total_page) {
                        echo '<a href="?controller=admin&action=borrow&page=' . ($current_page + 1) . '"> <button><i class="fa-solid fa-angle-right"></i></button></a>';
                    }
                    if ($current_page < $total_page - 2) {
                        echo '<a href="?controller=admin&action=borrow&page=' . ($total_page) . '"><button><i class="fa-solid fa-angles-right"></i></button></a>';
                    }
                }
                ?>
            </div>

            <?php if ($_SESSION['search-borrow'] != '') { ?>
                <span>Từ khóa đã tìm kiếm: <span><?= $_SESSION['search-borrow'] ?></span></span>
            <?php } ?>
    </div>
</div>
<?php var_dump(json_encode(mysqli_fetch_assoc($listBook))) ?>
<script>
    var listBook = <?php echo json_encode($listBook) ?>;
</script>
<script src="./js/admin/borrow/openFormAdd.js"></script>
<script src="./js/admin/closeFormAdd.js"></script>
<script src="./js/admin/borrow/openFormEdit.js"></script>
<script src="./js/admin/borrow/deleteItem.js"></script>