<div class="container bookdetail">
  <div class="book-detail">
    <form action="" method="POST" id="bookDetailForm">
      <div class="book-form">
        <div id="profile__title" style="text-align: center;">Thông tin tài liệu</div>
        <?php $book = mysqli_fetch_assoc($bookData); ?>
        <div class="book-form-sub">
          <img id="imgBook" src="<?= !empty($book['imgBook']) ? $book['imgBook'] : "./upload/book.png"; ?>" alt="">
          <input type="hidden" name="imgBook" value="<?= !empty($book['imgBook']) ? $book['imgBook'] : "./upload/book.png"; ?>">

          <ul>
            <li>Mã sách: <input type="text" name="idBook" value="<?= $book['idBook']; ?>" readonly></li>
            <li>Tên sách: <input type="text" name="nameBook" value="<?= $book['nameBook']; ?>" readonly></li>
            <li>Loại sách: <input type="text" name="nameCategory" value="<?= $book['nameCategory']; ?>" readonly></li>
            <li>Tác giả: <input type="text" name="creatorBook" value="<?= $book['creatorBook']; ?>" readonly></li>
            <li>Năm xuất bản: <input type="text" name="dateBook" value="<?= $book['dateBook']; ?>" readonly></li>
            <li>Nhà xuất bản: <input type="text" name="publisherBook" value="<?= $book['publisherBook']; ?>" readonly></li>
            <li>Mô tả: <input type="text" name="desBook" value="<?= $book['desBook']; ?>" readonly></li>
          </ul>
        </div>

        <div>
          <table class="table-book">
            <tr>
              <th style="width: 50%">File dữ liệu số</th>
              <th style="width: 50%">Số lượng: <input type="text" name="quantityBook" value="<?= $book['quantityBook']; ?> cuốn" readonly></th>
            </tr>
            <tr>
              <td>
                <?php
                echo isset($_SESSION['user'])
                  ? (!empty($book['titleUpload'])
                    ? '<a href="' . $book['uploadURL'] . '" target="_blank">' . $book['titleUpload'] . '.pdf</a>'
                    : '<span style="color: var(--orange-color); font-weight: 700;">Đang cập nhật!</span>')
                  : '<span style="color: var(--orange-color); font-weight: 700;">'
                  . '<a href="http://localhost/library/?controller=user&action=login" style="color: green; text-decoration: none;">Đăng nhập</a> để xem tài liệu</span>'; 
                ?>
              </td>
              <td>
                <button type="submit" id="request-Book" name="request-Book">Yêu cầu mượn</button>
              </td>
            </tr>
          </table>
        </div>
      </div>
    </form>
  </div>
</div>