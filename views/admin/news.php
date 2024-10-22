<div class="body__container">
    <div class="list__container">
        <div>
            <div style="flex: 1;display:flex;justify-content: space-between">
                <div>
                    <span>Danh sách tin tức</span><button onclick="openFormAdd()" id="list__add-btn" type="button">Thêm
                        tin mới</button>
                </div>
                <div style="display:flex; gap: 5px; justify-content: center; padding: 0 0 5px;align-items: center;">
                    <fieldset>
                        <legend>Tìm kiếm</legend>
                        <form action="?controller=admin&action=news" method="post" class="admin__form-search">
                            <input type="text" name="search-news" placeholder="Tiêu đề" autocomplete="off">
                            <button type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
                        </form>
                    </fieldset>
                    <fieldset>
                        <legend>Sắp xếp</legend>
                        <form action="?controller=admin&action=news" method="post" class="admin__form-search">
                            <select name="sort-news" id="">
                                <option value="desc" <?php if ($_SESSION['sort-news'] === 'desc')
                                    echo 'selected' ?>>
                                        Mới nhất
                                    </option>
                                    <option value="asc" <?php if ($_SESSION['sort-news'] === 'asc')
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
                    <th style="width: 30%;">Tiêu đề</th>
                    <th style="width: 10%;">Ảnh bìa</th>
                    <th style="width: 35%;">Nội dung</th>
                    <th style="width: 13%;">Ngày đăng</th>
                    <th style="width: 8%;"></th>
                </tr>
                <?php 
                                $stt = (($current_page - 1) * $limit) + 1;
                                foreach ($listNews as $key => $value) {
                                    ?>
                <tr class="list__content">
                    <td><?= $stt ?></td>
                    <td>
                        <div class="list__hidden-text"><?= $value['title'] ?></div>
                    </td>
                    <td>
                        <div style="display: flex; align-items: center; justify-content: center">
                            <?php if($value['image'] === ''){?>
                                <img style="height: 80px; width: 90%" src="https://res.cloudinary.com/di37whq60/image/upload/v1716194722/image/axdown7pmlzlgs7yelkd.png" alt="<?= $value['title'] ?>">
                            <?php }else{ ?>
                                <img style="height: 80px; width: 90%" src="<?= $value['image'] ?>" alt="<?= $value['title'] ?>">
                            <?php }?>
                    </div>
                    </td>
                    <td>
                        <div class="list__hidden-text"><?= $value['content'] ?></div>
                    </td>
                    <td>
                        <div class="list__hidden-text"><?= date("d-m-Y", strtotime($value['date'])) ?></div>
                    </td>
                    <td>
<div>
                     <button class="list__action-open-edit" type="button" data-id="<?= $value['id'] ?>"><i
                             class="fa-solid fa-pen-to-square list__icon-edit"></i></button>
                     <button class="list__action-btn" type="button" data-id="<?= $value['id'] ?>"><i
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
                        echo '<a href="?controller=admin&action=news&page=1"> <button><i class="fa-solid fa-angles-left"></i></button></a>';
                    }
                    if ($current_page > 1) {
                        echo ' <a href="?controller=admin&action=news&page=' . ($current_page - 1) . '"><button><i class="fa-solid fa-angle-left"></i></button></a>';
                    }
                    for ($i = 1; $i <= $total_page; $i++) {
                        if ($i != $current_page) {
                            if ($i > $current_page - 3 && $i < $current_page + 3) {
                                echo '<a href="?controller=admin&action=news&page=' . $i . '"><button class="button">' . $i . '</button></a>';
                            }
                        } else {
                            echo '<a href="?controller=admin&action=news&page=' . $i . '" class="button-current"><button class="button" >' . $i . '</button></a>';
                        }
                    }
                    if ($current_page < $total_page) {
                        echo '<a href="?controller=admin&action=news&page=' . ($current_page + 1) . '"> <button><i class="fa-solid fa-angle-right"></i></button></a>';
                    }
                    if ($current_page < $total_page - 2) {
                        echo '<a href="?controller=admin&action=news&page=' . ($total_page) . '"><button><i class="fa-solid fa-angles-right"></i></button></a>';
                    }
                }
                ?>
            </div>

            <?php if ($_SESSION['search-news'] != '') { ?>
                <span>Từ khóa đã tìm kiếm: <span><?= $_SESSION['search-news'] ?></span></span>
            <?php } ?>
        </div>
    </div>
</div>
<script src="./js/admin/news/openFormAdd.js"></script>
<script src="./js/admin/closeFormAdd.js"></script>
<script src="./js/admin/news/openFormEdit.js"></script>
<script src="./js/admin/book/deleteBook.js"></script>
<script src="./js/admin/changeImgNews.js"></script>