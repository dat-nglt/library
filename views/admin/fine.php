<div class="body__container">
    <div class="list__container">
        <div>
            <div style="flex: 1;display:flex;justify-content: space-between">
                <div>
                    <span>Danh sách đóng phạt <span style="font-size: 14px"><button
                     <?php if(mysqli_num_rows($listUser) < 1) echo 'disabled style="background-color: gray" title="Không thể thêm phiếu phạt do không có phiếu đang mượn hoặc quá hạn trả sách"' ?> 
                     <?php if(mysqli_num_rows($listUser) > 0) echo 'onclick="openFormAdd()"' ?>  id="list__add-btn" type="button">Thêm
                    phiếu phạt</button>
                </div>
                <div style="display:flex; gap: 5px; justify-content: center; padding: 0 0 5px;align-items: center;">
                    <fieldset>
                        <legend>Tìm kiếm</legend>
                        <form action="?controller=admin&action=fine" method="post" class="admin__form-search">
                            <input type="text" name="search-fine" placeholder="MSSV" autocomplete="off">
                            <button type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
                        </form>
                    </fieldset>
                    <fieldset>
                        <legend>Sắp xếp</legend>
                        <form action="?controller=admin&action=fine" method="post" class="admin__form-search">
                            <select name="sort-fine" id="">
                                <option value="desc" <?php if ($_SESSION['sort-fine'] === 'desc')
                                    echo 'selected' ?>>
                                        Mới nhất
                                    </option>
                                    <option value="asc" <?php if ($_SESSION['sort-fine'] === 'asc')
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
                    <th style="width: 8%;">MSSV</th>
                    <th style="width: 17%;">Họ & tên</th>
                    <th style="width: 20%;">Tên sách mượn</th>
                    <th style="width: 10%;">Số tiền phạt</th>
                    <th style="width: 10%;">Ngày nộp</th>
                    <th style="width: 20%;">Lý do</th>
                    <th style="width: 5%;"></th>
                </tr>
                <?php
                                $stt = (($current_page - 1) * $limit) + 1;
                                foreach ($listFine as $key => $value) {
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
                        <div class="list__hidden-text" style="-webkit-line-clamp: 2;"><?= $value['nameBook'] ?>
                        </div>
                    </td>
                    <td>
                        <div class="list__hidden-text" style="-webkit-line-clamp: 2;"><?= number_format($value['amount'], 0, '.', '.') ?>&#8363;
                        </div>
                    </td>
                    <td>
                        <div class="list__hidden-text" style="-webkit-line-clamp: 2;">
                            <?= date("d-m-Y", strtotime($value['fine_date'])) ?>
                        </div>
                    </td>
                    <td>
                        <div class="list__hidden-text" style="-webkit-line-clamp: 2;"><?= $value['reason'] ?>
                        </div>
                    </td>
                    <td>
                        <div style="justify-content: center;">
                            <button class="list__action-btn" type="button" data-id="<?= $value['idFine'] ?>"><i
                                    class="fa-solid fa-trash list__icon-del"></i></button>
                        </div>
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
                        echo '<a href="?controller=admin&action=punish&page=1"> <button><i class="fa-solid fa-angles-left"></i></button></a>';
                    }
                    if ($current_page > 1) {
                        echo ' <a href="?controller=admin&action=punish&page=' . ($current_page - 1) . '"><button><i class="fa-solid fa-angle-left"></i></button></a>';
                    }
                    for ($i = 1; $i <= $total_page; $i++) {
                        if ($i != $current_page) {
                            if ($i > $current_page - 3 && $i < $current_page + 3) {
                                echo '<a href="?controller=admin&action=punish&page=' . $i . '"><button class="button">' . $i . '</button></a>';
                            }
                        } else {
                            echo '<a href="?controller=admin&action=punish&page=' . $i . '" class="button-current"><button class="button" >' . $i . '</button></a>';
                        }
                    }
                    if ($current_page < $total_page) {
                        echo '<a href="?controller=admin&action=punish&page=' . ($current_page + 1) . '"> <button><i class="fa-solid fa-angle-right"></i></button></a>';
                    }
                    if ($current_page < $total_page - 2) {
                        echo '<a href="?controller=admin&action=punish&page=' . ($total_page) . '"><button><i class="fa-solid fa-angles-right"></i></button></a>';
                    }
                }
                ?>
                
            </div> <?php if ($_SESSION['search-fine'] != '') { ?>
                <span>Từ khóa đã tìm kiếm: <span><?= $_SESSION['search-fine'] ?></span></span>
            <?php } ?>
        </div>
    </div>
</div>
<script>
    var listUser = <?php echo json_encode(mysqli_fetch_all($listUser)) ?>;
    var listRequest = <?php echo json_encode(mysqli_fetch_all($listRequest)) ?>;
</script>
<script src="./js/admin/fine/openFormAdd.js"></script>
<script src="./js/admin/closeFormAdd.js"></script>
<script src="./js/admin/fine/openFormEdit.js"></script>