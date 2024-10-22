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

<div class="body__container">
    <div class="list__container">
        <div>
            <div style="flex: 1;display:flex;justify-content: space-between">
                <div>
                    <span>Danh sách sách</span>
                </div>
                <div style="display:flex; gap: 5px; justify-content: center; padding: 0 0 5px;align-items: center;">
                    <fieldset>
                        <legend>Tìm kiếm</legend>
                        <form action="" method="post" class="admin__form-search">
                            <input type="text" name="search-report" placeholder="Tên,email" autocomplete="off">

                            <button type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
                        </form>
                    </fieldset>
                    <fieldset>
                        <legend>Sắp xếp</legend>
                        <form action="" method="post" class="admin__form-search">
                            <select name="sort-report" id="">
                                <option value="desc" <?php if ($_SESSION['sort-report'] === 'desc') echo 'selected' ?>>
                                    Mới nhất
                                </option>
                                <option value="asc" <?php if ($_SESSION['sort-report'] === 'asc') echo 'selected' ?>>
                                    Cũ nhất
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
                <th style="width: 3%;">#</th>
                    <th style="width: 12%;">Họ & tên</th>
                    <th style="width: 20%;">email</th>
                    <th style="width: 15%;">Số điện thoại</th>
                    <th style="width: 40%;">Nội dung</th>
                    <th style="width: 10%;">Ngày gửi</th>
                <th style="width: 1%;"></th>
            </tr>

            <?php
                $stt = (($current_page - 1) * $limit) + 1;
                foreach ($listReport as $key => $value) {
            ?>
                    <tr class="list__content">
                        <td><?= $stt ?></td>
                        <td>
                            <div class="list__hidden-text" style="-webkit-line-clamp: 2;"><?= $value[1] ?></div>
                        </td>
                        <td>
                            <div class="list__hidden-text" style="-webkit-line-clamp: 2;"><?= $value[2] ?></div>
                        </td>
                        <td>
                            <div class="list__hidden-text"><?= $value[3] ?></div>
                        </td>
                        <td>
                            <div class="list__hidden-text" style="-webkit-line-clamp: 2;"><?= $value[4] ?>
                            </div>
                        </td>
                        <td>
                            <div class="list__hidden-text"  style="-webkit-line-clamp: 2;"><?= date("d-m-Y", strtotime($value[5])) ?></div>
                        </td>
                        <td>
                            <div>
                                <button class="list__action-btn" type="button" onclick="openview(<?= $value[0] ?>)"><i class="fa-solid fa-eye" style="color: #63E6BE;"></i></button>
                            </div>
                        </td>
                    </tr>
            <?php
                    $stt++;
                }
            ?>
        </table>


    <div class="list__paging">
            <div>
                <?php
                if ($total_page > 1) {
                    if ($current_page > 3) {
                        echo '<a href="?controller=admin&action=connect&page=1"> <button><i class="fa-solid fa-angles-left"></i></button></a>';
                    }
                    if ($current_page > 1) {
                        echo ' <a href="?controller=admin&action=connect&page=' . ($current_page - 1) . '"><button><i class="fa-solid fa-angle-left"></i></button></a>';
                    }
                    for ($i = 1; $i <= $total_page; $i++) {
                        if ($i != $current_page) {
                            if ($i > $current_page - 3 && $i < $current_page + 3) {
                                echo '<a href="?controller=admin&action=connect&page=' . $i . '"><button class="button">' . $i . '</button></a>';
                            }
                        } else {
                            echo '<a href="?controller=admin&action=connect&page=' . $i . '" class="button-current"><button class="button" >' . $i . '</button></a>';
                        }
                    }
                    if ($current_page < $total_page) {
                        echo '<a href="?controller=admin&action=connect&page=' . ($current_page + 1) . '"> <button><i class="fa-solid fa-angle-right"></i></button></a>';
                    }
                    if ($current_page < $total_page - 2) {
                        echo '<a href="?controller=admin&action=connect&page=' . ($total_page) . '"><button><i class="fa-solid fa-angles-right"></i></button></a>';
                    }
                }
                ?>
            </div>
            <?php if ($_SESSION['search-report'] != '') { ?>
                <span>Từ khóa đã tìm kiếm: <span><?= $_SESSION['search-report'] ?></span></span>
            <?php } ?>
        </div>
    </div>

    <div id="myModal">
    <div class="modalContent">
        <span id="closeModalBtn" class="close">&times;</span>
        <h2>Thông Tin</h2>
        <div id="indexContent">
            
        </div>
        <button id="closeModalBtn2" class="closeModalBtn2">Đóng</button>
    </div>
</div>
<script>
    const reportss = <?= json_encode($listReport) ?>;

    function openview(id) {
        const reports = reportss.filter(data => data[0] == id )
        const report = Object.values(reports)[0]
        


        document.getElementById('myModal').style.display = 'block';
        if (report) {
            report
            document.getElementById('indexContent').innerHTML = `
                <p><strong>Tên:</strong> ${report[1]}</p>
                <p><strong>Email:</strong> ${report[2]}</p>
                <p><strong>Số điện thoại:</strong> ${report[3]}</p>
                <p><strong>Nội dung:</strong> ${report[4]}</p>
                <p><strong>Ngày gửi:</strong> ${new Date(report[5]).toLocaleDateString()}</p>
            `;
           
        } else {
            console.log("Report not found");
        }
    }

    // Đóng modal khi nhấn nút
    document.getElementById("closeModalBtn").onclick = function() {
        document.getElementById('indexContent').innerHTML = ``;
        document.getElementById("myModal").style.display = "none";
    }

    document.getElementById("closeModalBtn2").onclick = function() {
        document.getElementById('indexContent').innerHTML = ``;
        document.getElementById("myModal").style.display = "none";
    }

    // Đóng modal khi nhấn ra ngoài modal
    window.onclick = function(event) {
        if (event.target === document.getElementById("myModal")) {
            document.getElementById("myModal").style.display = "none";
        }
    }
</script>



