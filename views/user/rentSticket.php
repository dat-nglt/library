<div class="container book-basket">
  <div class="book-basket-container">
    <div class="book-basket-title">
      Giỏ sách của tôi
    </div>
    <div class="book-basket-list">
      <div class="book-in-basket">
        <div class="image-book-in-basket">
          <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/0/0b/Book_icon_%28closed%29_-_Blue_and_gold.svg/1170px-Book_icon_%28closed%29_-_Blue_and_gold.svg.png" alt="">
        </div>
        <div class="info-book-in-basket">
          <div class="info-field-book-in-basket">
            <h5>Tên sách:</h5>
            <p>Đắc nhân tâm</p>
          </div>
          <div class="info-field-book-in-basket">
            <h5>Thể loại sách:</h5>
            <p>Tâm lí học</p>
          </div>
          <div class="info-field-book-in-basket">
            <h5>Tác giả:</h5>
            <p>Tác giả 1 </p>
          </div>
          <div class="info-field-book-in-basket">
            <h5>Kho:</h5>
            <p>Còn 6 quyển</p>
          </div>
          <div class="info-field-book-in-basket">
            <h5>Số lượng:</h5>
            <p class="quantityElement"></p>
            <div class="update-count">
              <i class="fa-solid fa-circle-up"></i>
              <i class="fa-solid fa-circle-down"></i>
            </div>
          </div>
        </div>
        <div class="options-book-in-basket">
          <button>Xoá khỏi giỏ</button>
        </div>
      </div>
    </div>
  </div>
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

      >img {
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

      >button {
        background-color: var(--red-cl);
        padding: 8px 15px;
        border: none;
        outline: none;
        color: var(--white-color);
        font-weight: 600;
        border-radius: 5px;
        cursor: pointer;
      }
    }
  }
</style>

<script>
  document.addEventListener('DOMContentLoaded', function () {
    const bookInBasket = document.querySelectorAll('.book-in-basket');
    console.log(bookInBasket);


    bookInBasket.forEach(book => {
      const increaseCount = book.querySelector('.fa-circle-up');
      const decreaseCount = book.querySelector('.fa-circle-down');
      const quantityElement = book.querySelector('.quantityElement')

      let quantity = 1;

      // Hàm cập nhật số lượng
      function updateQuantity() {
        quantityElement.textContent = `${quantity} quyển`;
      }

      // Sự kiện click cho nút tăng
      increaseCount.addEventListener('click', () => {
        quantity++;
        updateQuantity();
      });

      // Sự kiện click cho nút giảm
      decreaseCount.addEventListener('click', () => {
        if (quantity > 1) { // Đảm bảo số lượng không nhỏ hơn 1
          quantity--;
        }
        updateQuantity();
      });

      // Khởi tạo hiển thị
      updateQuantity();
    })

  });

</script>