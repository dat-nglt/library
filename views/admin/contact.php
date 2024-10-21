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
                            <button class="list__action-open-edit" id="openModalBtn" type="button">   
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

    <div id="myModal">
    <div class="modalContent">
        <span id="closeModalBtn" class="close">&times;</span>
        <h2>Thông Tin</h2>
        <p><strong>Tên:</strong> John Doe</p>
        <p><strong>Email:</strong> gờ meo của hòa@gmail.com</p>
        <p><strong>Số điện thoại:</strong> 0123456789</p>
        <p><strong>Nội dung:</strong> Đây là nội dung thông tin.</p>
        <p><strong>Ngày gửi:</strong> 21/10/2024</p>
        <button id="closeModalBtn2" class="closeModalBtn2">Đóng</button>
    </div>
</div>



<style>
    #myModal {
        display: none;
        position: fixed;
        z-index: 1;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgba(0, 0, 0, 0.7);
    }

    .modalContent {
        background: linear-gradient(135deg, #ff7e5f, #feb47b);
        margin: 10% auto;
        padding: 30px;
        border-radius: 15px;
        box-shadow: 0px 10px 30px rgba(0, 0, 0, 0.3);
        width: 60%;
        color: white;
        font-family: 'Arial', sans-serif;
    }

    .modalContent h2 {
        font-size: 30px;
        margin-bottom: 20px;
    }

    .modalContent p {
        font-size: 18px;
        margin: 10px 0;
    }

    .close {
        color: white;
        float: right;
        font-size: 28px;
        font-weight: bold;
        cursor: pointer;
    }

    .close:hover,
    .close:focus {
        color: #ff6f61;
    }

    .closeModalBtn2 {
        background-color: white;
        color: #ff6f61;
        border: none;
        padding: 10px 20px;
        font-size: 18px;
        cursor: pointer;
        border-radius: 10px;
        margin-top: 20px;
    }

    .closeModalBtn2:hover {
        background-color: #ff6f61;
        color: white;
    }
    </style>
   <script>
        const modal = document.getElementById("myModal");
        const openModalBtn = document.getElementById("openModalBtn");  // Giả sử bạn có nút để mở modal
        const closeModalBtn = document.getElementById("closeModalBtn");
        const closeModalBtn2 = document.getElementById("closeModalBtn2");

        // Hàm mở modal
        openModalBtn.onclick = function() {
            modal.style.display = "block";
        }

        // Hàm đóng modal khi nhấn vào nút đóng (x)
        closeModalBtn.onclick = function() {
            modal.style.display = "none";
        }

        // Hàm đóng modal khi nhấn vào nút "Đóng" thứ hai
        closeModalBtn2.onclick = function() {
            modal.style.display = "none";
        }

        // Đóng modal khi nhấn ra ngoài modal
        window.onclick = function(event) {
            if (event.target === modal) {
                modal.style.display = "none";
            }
        }
   </script>