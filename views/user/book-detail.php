<div class="container bookdetail">
  <div class="book-detail">
    <div class="book-form">
      <div id="profile__title" style="text-align: center;">Thông tin tài liệu</div>
      <?php $book = mysqli_fetch_assoc($bookData); ?>
      <div class="book-form-sub">
        <img src="<?= !empty($book['imgBook']) ? $book['imgBook'] : "./upload/book.png"; ?>" alt="">
        <ul>
          <li>Mã sách: <span id="idBook"><?= $book['idBook']; ?></span></li>
          <li>Tên sách: <span><?= $book['nameBook']; ?></span></li>
          <li>Loại sách: <span><?= $book['nameCategory']; ?></span></li>
          <li>Tác giả: <span><?= $book['creatorBook']; ?></span></li>
          <li>Năm xuất bản: <span><?= $book['dateBook']; ?></span></li>
          <li>Nhà xuất bản: <span><?= $book['publisherBook']; ?></span></li>
          <li>Mô tả: <span><?= $book['desBook']; ?></span></li>
        </ul>
      </div>

      <div>
        <table class="table-book">
          <tr>
            <th style="width: 50%">File dữ liệu số</th>
            <th style="width: 50%">Số lượng trong kho: <span><?= $book['quantityBook']; ?></span></th>
          </tr>
          <tr>
            <td>
              <?php if (!empty($book['titleUpload'])): ?>
                <a href="<?php echo $book['uploadURL']; ?>" target="_blank"><?php echo $book['titleUpload']; ?>.pdf</a>
              <?php else: ?>
                <span style="color: var(--orange-color); font-weight: 700;">Đang cập nhật!</span>
              <?php endif; ?>
            </td>
            <td>
              <button type="button" id="request-Book">Đăng ký mượn</button>
            </td>
          </tr>
        </table>
      </div>
    </div>
  </div>
</div>

<script src="./js/user/detail-book.js"></script>