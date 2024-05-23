<div class="body__container">
    <div class="list__container">
        <div>
            <div style="flex: 1;display:flex;justify-content: space-between">
                <div>
                    <span>Danh sách đóng phạt <span style="font-size: 14px">(Phạt 2.000 VNĐ với mỗi 1 ngày trễ hạn)</span></span>
                </div>
                <div style="display:flex; gap: 5px; justify-content: center; padding: 0 0 5px;align-items: center;">
                    <fieldset>
                        <legend>Sắp xếp</legend>
                        <form action="" method="post" class="admin__form-search">
                            <select name="sort-punish" id="">
                                <option value="DESC" <?php if ($_SESSION['sort-punish'] === 'DESC')
                                    echo 'selected' ?>>
                                        Mới nhất
                                    </option>
                                    <option value="ASC" <?php if ($_SESSION['sort-punish'] === 'ASC')
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
                    <th style="width: 10%;">MSSV</th>
                    <th style="width: 20%;">Họ & tên</th>
                    <th style="width: 20%;">Mã mượn sách</th>
                    <th style="width: 20%;">Số ngày trễ hạn</th>
                    <th style="width: 20%;">Tổng phí phạt</th>
                    <th style="width: 5%;"></th>
                </tr>
                <?php
                                $stt = (($current_page - 1) * $limit) + 1;
                                foreach ($listPunish as $key => $value) {
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
                        <div class="list__hidden-text" style="-webkit-line-clamp: 2;"><?= $value['id_Request'] ?>
                        </div>
                    </td>
                    <td>
                        <div class="list__hidden-text" style="-webkit-line-clamp: 2;"><?= $value['countDate'] ?>
                        </div>
                    </td>
                    <td>
                        <div class="list__hidden-text" style="-webkit-line-clamp: 2;"><?= $value['moneyPunish'] ?> VNĐ
                        </div>
                    </td>

                    <td>
                        <div style="justify-content: center;">
                            <button class="list__action-btn" type="button" data-id="<?= $value['idPunish'] ?>"><i
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
            </div>
        </div>
    </div>

    <script src="./js/admin/punish/deletePunish.js"></script>