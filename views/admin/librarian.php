<div class="body__container">
    <div class="list__container">
        <div>
            <div style="flex: 1;display:flex;justify-content: space-between">
                <div>
                    <span>Danh sách thủ thư</span><button onclick="openFormAdd()" id="list__add-btn" type="button">Thêm
                        thủ thư</button>
                </div>
                <div style="display:flex; gap: 5px; justify-content: center; padding: 0 0 5px;align-items: center;">
                    <fieldset>
                        <legend>Tìm kiếm</legend>
                        <form action="?controller=admin&action=librarian" method="post" class="admin__form-search">
                            <input type="text" name="search-librarian" placeholder="MSSV, họ tên" autocomplete="off">
                            <button type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
                        </form>
                    </fieldset>
                    <fieldset>
                        <legend>Sắp xếp</legend>
                        <form action="?controller=admin&action=librarian" method="post" class="admin__form-search">
                            <select name="sort-librarian" id="">
                                <option value="desc" <?php if ($_SESSION['sort-librarian'] === 'desc')
                                    echo 'selected' ?>>
                                        Mới nhất
                                    </option>
                                    <option value="asc" <?php if ($_SESSION['sort-librarian'] === 'asc')
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
                    <th style="width: 15%;">Tên đăng nhập</th>
                    <th style="width: 22%;">Họ tên</th>
                    <th style="width: 10%;">SĐT</th>
                    <th style="width: 20%;">Email</th>
                    <th style="width: 20%;">Lớp</th>
                    <th style="width: 8%;"></th>
                </tr>
                <?php
                                $stt = (($current_page - 1) * $limit) + 1;
                                foreach ($listLibrarian as $key => $value) {
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
                        <div class="list__hidden-text"><?= $value[6] ?></div>
                    </td>
                    <td>
                        <div class="list__hidden-text"><?= $value[7] ?></div>
                    </td>
                    <td>
                        <div class="list__hidden-text"><?= $value[10] ?></div>
                    </td>
                    <td>
                        <div>
                            <button class="list__action-open-edit" type="button" data-id="<?= $value[0] ?>"><i
                                    class="fa-solid fa-pen-to-square list__icon-edit"></i></button>
                            <button class="list__action-btn" type="button" data-id="<?= $value[0] ?>">
                                <?php if ($value[9] === '2') {
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
                        echo '<a href="?controller=admin&action=librarian&page=1"> <button><i class="fa-solid fa-angles-left"></i></button></a>';
                    }
                    if ($current_page > 1) {
                        echo ' <a href="?controller=admin&action=librarian&page=' . ($current_page - 1) . '"><button><i class="fa-solid fa-angle-left"></i></button></a>';
                    }
                    for ($i = 1; $i <= $total_page; $i++) {
                        if ($i != $current_page) {
                            if ($i > $current_page - 3 && $i < $current_page + 3) {
                                echo '<a href="?controller=admin&action=librarian&page=' . $i . '"><button class="button">' . $i . '</button></a>';
                            }
                        } else {
                            echo '<a href="?controller=admin&action=librarian&page=' . $i . '" class="button-current"><button class="button" >' . $i . '</button></a>';
                        }
                    }
                    if ($current_page < $total_page) {
                        echo '<a href="?controller=admin&action=librarian&page=' . ($current_page + 1) . '"> <button><i class="fa-solid fa-angle-right"></i></button></a>';
                    }
                    if ($current_page < $total_page - 2) {
                        echo '<a href="?controller=admin&action=librarian&page=' . ($total_page) . '"><button><i class="fa-solid fa-angles-right"></i></button></a>';
                    }
                }
                ?>
            </div>

            <?php if ($_SESSION['search-librarian'] != '') { ?>
                <span>Từ khóa đã tìm kiếm: <span><?= $_SESSION['search-librarian'] ?></span></span>
            <?php } ?>
        </div>
    </div>
</div>
<script src="./js/admin/librarian/openFormAdd.js"></script>
<script src="./js/admin/closeFormAdd.js"></script>
<script src="./js/admin/showPassword.js"></script>
<script src="./js/admin/librarian/openFormEdit.js"></script>
<script src="./js/admin/librarian/lockUser.js"></script>