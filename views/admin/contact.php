<div class="body__container">
    <div class="list__container">
        <!-- <div>
            <div style="flex: 1;display:flex;justify-content: space-between">
                <div>
                    <span>PHẢN HỒI TỪ NGƯỜI DÙNG</span>
                    
                </div>
                <div style="display:flex; gap: 5px; justify-content: center; padding: 0 0 5px;align-items: center;">
                    <fieldset>
                        <legend>Tìm kiếm</legend>
                        <form action="" method="post" class="admin__form-search">
                            <input type="text" name="search-upload" placeholder="Nhập từ khoá cần tìm..."
                                autocomplete="off">
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
            </div> -->
            <table>
                <tr>
                    <th style="width: 3%;">#</th>
                        <th style="width: 12%;">Họ & tên</th>
                        <th style="width: 20%;">email</th>
                        <th style="width: 15%;">Số điện thoại</th>
                        <th style="width: 40%;">Nội dung</th>
                        <th style="width: 10%;">Ngày gửi</th>
                    <th style="width: 1%;"></th>
                </tr>
                <tr class="list__content">
                    <td>1</td>
                    <td>
                        <div class="list__hidden-text" style="-webkit-line-clamp: 2;">Hòa Hòa Hòa</div>
                    </td>
                    <td>
                        <div class="list__hidden-text" style="-webkit-line-clamp: 2;">hoahoahoa@gmai.com</div>
                    </td>
                    <td>
                        <div class="list__hidden-text" style="-webkit-line-clamp: 2;">000000000000000</div>
                    </td>
                    <td>
                        <div class="list__hidden-text" style="-webkit-line-clamp: 2;">1111111111111111111</div>
                    </td>
                    <td>
                        <div class="list__hidden-text" style="-webkit-line-clamp: 2;">
                            22/12/2003
                        </div>
                    </td>
                    <td>
                        <div>
                            <button class="list__action-open-edit" type="button">   
                            <i class="fa-solid fa-eye" style="color: #63E6BE;"></i></button>
                    </td>
                </tr>
                
                
            </table>

        
        <!-- <div class="list__paging">
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

        </div> -->
    </div>
    <script src="./js/admin/contact/openFormViewReport.js"></script>
    <script src="./js/admin/closeFormAdd.js"></script>