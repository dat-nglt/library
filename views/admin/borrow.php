<div class="body__container">
    <div class="list__container">
        <div>
            <div style="flex: 1;display:flex;justify-content: space-between">
                <div>
                    <span>Danh sách mượn - trả </span><button onclick="openFormAdd()" id="list__add-btn"
                        type="button">Thêm
                        phiếu mượn</button>
                </div>
                <div style="display:flex; gap: 5px; justify-content: center; padding: 0 0 5px;align-items: center;">
                    <fieldset>
                        <legend>Tìm kiếm</legend>
                        <form action="" method="post" class="admin__form-search">
                            <input type="text" name="search-borrow" placeholder="Tên độc giả, MSSV" autocomplete="off">
                            <select name="status-borrow" id="status-borrow">
                                <option value="all" <?php if ($_SESSION['status-borrow'] === 'all')
                                    echo 'selected' ?>>
                                        Tất cả
                                    </option>
                                    <option value="0" <?php if ($_SESSION['status-borrow'] === '0')
                                    echo 'selected' ?>>
                                        Chờ xét duyệt
                                    </option>
                                    <option value="1" <?php if ($_SESSION['status-borrow'] === '1')
                                    echo 'selected' ?>>
                                        Đã xét duyệt
                                    </option>
                                    <option value="2" <?php if ($_SESSION['status-borrow'] === '2')
                                    echo 'selected' ?>>
                                        Hoàn thành
                                    </option>
                                    <option value="3" <?php if ($_SESSION['status-borrow'] === '3')
                                    echo 'selected' ?>>
                                        Quá hạn
                                    </option>
                                    <option value="4" <?php if ($_SESSION['status-borrow'] === '4')
                                    echo 'selected' ?>>
                                        Từ chối
                                    </option>
                                    <option value="5" <?php if ($_SESSION['status-borrow'] === '5')
                                    echo 'selected' ?>>
                                        Đã hủy
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
                    <th style="width: 10%;">Mã yêu cầu</th>
                    <th style="width: 8%;">MSSV</th>
                    <th style="width: 27%;">Tên độc giả</th>
                    <th style="width: 13%;">Trạng thái</th>
                    <th style="width: 15%;">Thời gian</th>
                    <th style="width: 15%;">Cập nhật mới</th>
                    <th style="width: 7%;"></th>
                </tr>
                <?php
                                $stt = (($current_page - 1) * $limit) + 1;
                                // var_dump($listBorrow);
                                foreach ($listBorrow as $key => $value) {
                                    switch ($value[2]) {
                                        case '0':
                                            $status = 'Chờ xét duyệt';
                                            break;
                                        case '1':
                                            $status = 'Đã xét duyệt';
                                            break;
                                        case '2':
                                            $status = 'Hoàn thành';
                                            break;
                                        case '3':
                                            $status = 'Quá hạn';
                                            break;
                                        case '4':
                                            $status = 'Từ chối';
                                            break;
                                        case '5':
                                            $status = 'Đã hủy';
                                            break;
                                        default:
                                            $status = '';
                                            break;
                                    }
                                    ?>
                <tr class="list__content">
                    <td><?= $stt ?></td>
                    <td>
                        <div class="list__hidden-text"><?= $value[0] ?></div>
                    </td>
                    <td>
                        <div class="list__hidden-text"><?= $value[5] ?></div>
                    </td>
                    <td>
                        <div class="list__hidden-text"><?= $value[6] ?></div>
                    </td>
                    <td>
                        <div class="list__hidden-text"><?= $status ?></div>
                    </td>
                    <td>
                        <div class="list__hidden-text"><?= $value[3] ?></div>
                    </td>
                    <td>
                        <div class="list__hidden-text"><?= $value[4] ?></div>
                    </td>
                    <td>
                        <div>
                            <a href="http://localhost/library/?controller=admin&action=borrow_detail&id=<?= $value[0] ?>">
                                <button class="list__action" type="button" data-id="<?= $value[0] ?>" style="background-color: var(--white-cl); padding: 0; "><i
                                        class="fa-solid fa-eye list__icon-edit"></i></button>
                            </a>
                            <button class="list__action-open-edit" type="button" data-id="<?= $value[0] ?>"><i
                                    class="fa-solid fa-pen-to-square list__icon-edit"></i></button>
                            <!-- <button class="list__action-btn" type="button" data-id="<?= $value[0] ?>"><i
                                    class="fa-solid fa-trash list__icon-del"></i></button> -->
                    </td>
                </tr>
                <?php $stt++;
                                }
                                ?>
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
            <?php }
            ?>
        </div>
    </div>
    <script>
        var listBook = <?php echo json_encode(mysqli_fetch_all($listBook)) ?>;
        var listUser = <?php echo json_encode(mysqli_fetch_all($listUser)) ?>;
    </script>
    <script src="./js/admin/borrow/openFormAdd.js"></script>
    
    <script src="./js/admin/borrow/openFormEdit.js"></script>
    