<style>
    h1 {
        text-transform: uppercase;
        font-weight: 600;
        font-size: 25px;
        text-align: center;
    }

    .container-borrowdetail {
        height: 100vh;
        max-width: 100%;
        margin-left: 250px;
        background: #ffffff;
        padding: 20px;
        overflow-y: auto;

        div {
            line-height: 2.2;
        }
    }

    .detail {
        margin-bottom: 15px;
        padding: 10px;
        border-bottom: 1px solid #dee2e6;
        font-size: 14px;
        font-weight: 600;

        span {
            font-weight: 400;
        }
    }

    .book-list {
        margin-top: 20px;
        display: flex;
        flex-direction: column;
    }

    .book-item {
        display: flex;
        align-items: center;
        margin-bottom: 20px;
        padding: 10px;
        border: 1px solid #dee2e6;
        border-radius: 5px;
        background-color: #f8f9fa;
        transition: background-color 0.3s;
    }

    .book-item:hover {
        background-color: #e2e6ea;
    }

    .value-image {
        width: 150px;
        height: 200px;
        margin-right: 15px;
        border-radius: 5px;
    }

    .value-info {
        flex: 1;
        display: flex;
        justify-content: space-between;
        align-items: center;

        div>div {
            font-weight: 600;

            span {
                font-weight: 400;
            }
        }
    }

    .btn {
        background-color: #007bff;
        color: white;
        padding: 10px 15px;
        text-decoration: none;
        border-radius: 5px;
        transition: background-color 0.3s;
        display: inline-block;

    }

    .btn:hover {
        background-color: #0056b3;
    }

    .status-dropdown {}

    .action-buttons {
        display: flex;
        gap: 20px;
        margin-right: 20px;

        button {
            margin: 0 auto;
            border: none;
            cursor: pointer;
        }

    }
</style>


<div class="container-borrowdetail">
    <a href="http://localhost/library/?controller=admin&action=borrow" class="btn">
        <i class="fa-solid fa-arrow-left-long"></i>
    </a>
    <h1>Chi Tiết Mượn - Trả Sách</h1>

    <div class="detail">Mã yêu cầu: <span><?= $borrowDetailInfo['id_Request'] ?></span></div>
    <div class="detail">Ngày yêu cầu: <span><?= $borrowDetailInfo['created_at'] ?></span></div>
    
    <form action="" method="post"> <!-- Thay đổi URL tại đây -->
        <input type="hidden" name="id_request" value="<?= $borrowDetailInfo['id_Request'] ?>">
        
        <div class="book-list">
            <?php foreach ($borrowDetail as $value): ?>
                <div class="book-item">
                    <img src="<?= $value['imgBook'] ?>" alt="<?= $value['nameBook'] ?>" class="value-image">
                    <div class="value-info">
                        <div>
                            <div>Mã sách: <span><?= $value['idBook'] ?></span> </div>
                            <div>Tên sách: <span><?= $value['nameBook'] ?></span> </div>
                            <div>Tác giả: <span><?= $value['creatorBook'] ?></span> </div>
                            <div>Ngày trả dự kiến: <span><?= $value['return_date'] ?></span> </div>
                            <div>Ngày trả thực tế: <span><?= $value['due_date'] ?></span> </div>
                            <div>Trạng thái: <?php
                                if ($value['statusRD'] === null) {
                                    echo '<span></span>'; // Do not display anything if statusRD is null
                                } else {
                                    switch ($value['statusRD']) {
                                        case 0:
                                            echo '<span>Chưa trả</span>'; // Not returned
                                            break;
                                        case 1:
                                            echo '<span>Đã trả</span>'; // Returned
                                            break;
                                        case 2:
                                            echo '<span>Quá hạn</span>'; // Overdue
                                            break;
                                        default:
                                            echo '<span>Không xác định</span>'; // Undefined status
                                    }
                                }
                            ?> </div>
                        </div>
                        <div class="action-buttons">
                            <button type="button" class="btn updateRequestDetail" data-id="<?= $value['idRequestDetail'] ?>">Cập nhật</button>
                            <button type="submit" name="extendBorrow" value="<?= $value['idRequestDetail'] ?>" class="btn">Gia hạn</button>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </form>
</div>

 <script src="./js/admin/borrow_detail/openFormEdit.js"></script>