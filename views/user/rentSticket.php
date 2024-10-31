<div class="container book-basket">
  <form action="" method="POST" class>
    <div class="book-basket-container">
      <div class="book-basket-title">
        Giỏ sách của tôi
      </div>
      <div class="book-basket-list">
        <?php
        if (isset($_SESSION["cart"]) && count($_SESSION["cart"]) > 0) {
          foreach ($_SESSION["cart"] as $item) {
            ?>
            <div class="book-in-basket">
              <div class="image-book-in-basket">
                <a href="<?php echo 'http://localhost/library/?controller=user&action=book_detail&id=' . $item['bid'] ?>">
                  <img src="<?= $item['bookImg']; ?>" alt="">
                </a>
              </div>
              <div class="info-book-in-basket">
                <div class="info-field-book-in-basket">
                  <h5>Tên sách:</h5>
                  <p><?= $item['bname']; ?></p>
                  <input type="hidden" name="bookName" value="<?= $item['bname']; ?>">
                </div>
                <div class="info-field-book-in-basket">
                  <h5>Loại sách:</h5>
                  <p><?= $item['category']; ?></p>
                  <input type="hidden" name="bookCategory" value="<?= $item['category']; ?>">
                </div>
                <div class="info-field-book-in-basket">
                  <h5>Tác giả:</h5>
                  <p><?= $item['author']; ?></p>
                  <input type="hidden" name="bookAuthor" value="<?= $item['author']; ?>">
                </div>
                <div class="info-field-book-in-basket">
                  <h5>Năm xuất bản:</h5>
                  <p><?= $item['dateBook']; ?></p>
                  <input type="hidden" name="bookYear" value="<?= $item['dateBook']; ?>">
                </div>
                <div class="info-field-book-in-basket">
                  <h5>Nhà xuất bản:</h5>
                  <p class="quantityElement"><?= $item['publisherBook']; ?></p>
                  <input type="hidden" name="bookPublisher[]" value="<?= $item['publisherBook']; ?>">
                </div>
                <input type="hidden" name="bookImg" value="<?= $item['bookImg']; ?>">
              </div>
              <div class="options-book-in-basket">
                <form action="" method="POST" style="display:inline;">
                  <input type="hidden" name="bookBid" value="<?= $item['bid']; ?>">
                  <button class="bookRemove" name="bookRemove" type="submit">Xoá khỏi giỏ</button>
                </form>
              </div>
            </div>
          <?php }
          echo '<button id="comfirmRequest" name="comfirmRequest" type="submit">Xác nhận mượn</button>';
        } else {
          echo '<p>Giỏ sách của bạn đang trống.</p>';
        }
        ?>
      </div>
    </div>
  </form>
</div>



<style>
  .book-basket-container {
    display: flex;
    flex-direction: column;
    justify-content: center;
    background-color: #ffffff;
    box-shadow: 0px 0px 20px 10px rgba(0, 0, 0, 0.3);
    width: 900px;
    min-height: 50px;
    margin: 0 auto;
  }

  .book-basket-title {
    display: flex;
    align-items: center;
    justify-content: center;
    background-color: var(--green-color);
    width: 100%;
    color: #ffffff;
    padding: 15px;
    font-size: 16px;
    text-transform: uppercase;
    font-weight: 600;
  }

  .book-basket-list {
    display: flex;
    justify-content: center;
    align-items: center;
    flex-direction: column;
    gap: 10px;
    padding: 10px;
  }

  .book-in-basket {
    min-height: 60px;
    border-radius: 5px;
    width: 100%;
    padding: 10px;
    background-color: #fafaf7;
    box-shadow: rgba(60, 64, 67, 0.3) 0px 1px 2px 0px, rgba(60, 64, 67, 0.15) 0px 2px 6px 2px;
    display: flex;

    >.image-book-in-basket {
      flex: 1;

      >a>img {
        width: 100%;
        border-radius: 5px;
        aspect-ratio: 1 / 1;
      }
    }

    >.info-book-in-basket {
      padding: 10px 15px;
      flex: 4;

      >.info-field-book-in-basket {
        display: flex;
        margin-bottom: 8px;
        align-items: center;



        >h5 {
          color: var(--green-cl)
        }

        >.update-count {
          margin-left: 5px;
          display: flex;
          align-items: center;
          gap: 5px;

          i {
            margin-top: 2px;
            font-size: 15px;
            cursor: pointer;
            color: var(--red-cl);
          }

          >i:first-child {
            color: var(--blue-cl);
          }

          >p {
            font-size: 13px;
            margin: 0 10px;
          }
        }

        >p {
          font-weight: 600;
          margin-left: 5px;
          font-size: 13px;
        }
      }
    }

    >.options-book-in-basket {
      flex: 1;
      display: flex;
      justify-content: center;
      align-items: center;
    }

  }

  .bookRemove {
    background-color: var(--red-cl);
    color: #ffffff;
    padding: 8px 15px;
    border: none;
    outline: none;
    font-weight: 600;
    cursor: pointer;

    &:hover {
      opacity: 0.8;
    }
  }

  #comfirmRequest {
    background-color: var(--orange-color);
    padding: 10px 25px;
    border: none;
    outline: none;
    color: #ffffff;
    font-weight: 600;
    text-transform: uppercase;
    cursor: pointer;

    &:hover {
      opacity: 0.8;
    }
  }
</style>

<script src="./js/user/detail-book.js"></script>