<div class="body__container">
    <div class="list__container">
        <div>
            <div style="flex: 1;display:flex;justify-content: space-between">
                <div>
                    <span>Danh sách độc giả</span><button onclick="openFormAdd()" id="list__add-btn" type="button">Thêm
                        độc giả</button>
                        <!-- <button onclick="openFormAddExcel()" id="list__add-btn" type="button">Thêm
                        file excel</button> -->
                </div>
                <div style="display:flex; gap: 5px; justify-content: center; padding: 0 0 5px;align-items: center;">
                    <fieldset>
                        <legend>Tìm kiếm</legend>
                        <form action="?controller=admin&action=account" method="post" class="admin__form-search">
                            <input type="text" name="search-account" placeholder="MSSV, họ tên" autocomplete="off">
                            <button type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
                        </form>
                    </fieldset>
                    <fieldset>
                        <legend>Sắp xếp</legend>
                        <form action="?controller=admin&action=account" method="post" class="admin__form-search">
                            <select name="sort-account" id="">
                                <option value="desc" <?php if ($_SESSION['sort-account'] === 'desc')
                                    echo 'selected' ?>>
                                        Mới nhất
                                    </option>
                                    <option value="asc" <?php if ($_SESSION['sort-account'] === 'asc')
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
                    <th style="width: 18%;">Họ tên</th>
                    <th style="width: 13%;">Quên quán</th>
                    <th style="width: 8%;">Ngày sinh</th>
                    <th style="width: 9%;">SĐT</th>
                    <th style="width: 16%;">Email</th>
                    <th style="width: 10%;">CCCD</th>
                    <th style="width: 6%;">Lớp</th>
                    <th style="width: 6%;"></th>
                </tr>
                <?php
                                $stt = (($current_page - 1) * $limit) + 1;
                                foreach ($listAccount as $key => $value) {
                                    ?>
                <tr class="list__content">
                    <td><?= $stt ?></td>
                    <td>
                        <div class="list__hidden-text"><?= $value[1] ?></div>
                    </td>
                    <td>
                        <div class="list__hidden-text"><?= $value[3] ?></div>
                    </td>
                    <td>
                        <div class="list__hidden-text"><?= $value[5] ?></div>
                    </td>
                    <td>
                        <div class="list__hidden-text"><?= date("d-m-Y", strtotime($value[4])) ?></div>
                    </td>
                    <td>
                        <div class="list__hidden-text"><?= $value[6] ?></div>
                    </td>
                    <td>
                        <div class="list__hidden-text"><?= $value[7] ?></div>
                    </td>
                    <td>
                        <div class="list__hidden-text"><?= $value[8] ?></div>
                    </td>
                    <td>
                        <div class="list__hidden-text"><?= $value[10] ?></div>
                    </td>
                    <td>
                        <div>
                            <button class="list__action-open-edit" type="button" data-id="<?= $value[0] ?>"><i
                                    class="fa-solid fa-pen-to-square list__icon-edit"></i></button>
                            <button class="list__action-btn" type="button" data-id="<?= $value[0] ?>">
                                <?php if ($value[9] === '1') {
                                    echo '<i class="fa-solid fa-lock list__icon-del"></i>';
                                } else{
                                    echo '<i class="fa-solid fa-lock-open list__icon-edit"></i>';
                                } ?>
                            </button>
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
                        echo '<a href="?controller=admin&action=account&page=1"> <button><i class="fa-solid fa-angles-left"></i></button></a>';
                    }
                    if ($current_page > 1) {
                        echo ' <a href="?controller=admin&action=account&page=' . ($current_page - 1) . '"><button><i class="fa-solid fa-angle-left"></i></button></a>';
                    }
                    for ($i = 1; $i <= $total_page; $i++) {
                        if ($i != $current_page) {
                            if ($i > $current_page - 3 && $i < $current_page + 3) {
                                echo '<a href="?controller=admin&action=account&page=' . $i . '"><button class="button">' . $i . '</button></a>';
                            }
                        } else {
                            echo '<a href="?controller=admin&action=account&page=' . $i . '" class="button-current"><button class="button" >' . $i . '</button></a>';
                        }
                    }
                    if ($current_page < $total_page) {
                        echo '<a href="?controller=admin&action=account&page=' . ($current_page + 1) . '"> <button><i class="fa-solid fa-angle-right"></i></button></a>';
                    }
                    if ($current_page < $total_page - 2) {
                        echo '<a href="?controller=admin&action=account&page=' . ($total_page) . '"><button><i class="fa-solid fa-angles-right"></i></button></a>';
                    }
                }
                ?>
            </div>

            <?php if ($_SESSION['search-account'] != '') { ?>
                <span>Từ khóa đã tìm kiếm: <span><?= $_SESSION['search-account'] ?></span></span>
            <?php } ?>
        </div>
    </div>
</div>
<script src="./js/admin/account/openFormAdd.js"></script>
<script src="./js/admin/closeFormAdd.js"></script>
<script src="./js/admin/showPassword.js"></script>
<script src="./js/admin/account/openFormEdit.js"></script>
<script src="./js/admin/account/lockUser.js"></script>
<!-- <script src="./js/admin/account/addExcelFile.js"></script> -->