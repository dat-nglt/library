<div class="user-search">
  <div class="user-search-sub">
    <select class="select-search" name="option-search" id="option-search">
      <option value="all">Tất cả</option>
      <option value="nameBook">Tên sách</option>
      <option value="creatorBook">Tác giả</option>
      <option value="nameCategory">Chủ đề</option>
      <option value="publisherBook">Nhà xuất bản</option>
      <option value="dateBook">Năm xuất bản</option>
    </select>
    <input name="content-search" id="content-search" class="input-search" type="text"
      placeholder="Nhập tên sách hoặc từ khoá cần tìm ...">

    <button id="search-btn" type="button">Tìm kiếm</button>
  </div>
</div>

<div class="book-content">
  <div class="gird-content">
    <?php
    $count = 0;
    $limit = 8;
    foreach ($data['componentDatas'] as $componentData) {
      // var_dump($componentData);
      if ($count >= $limit) {
        break;
      } ?>

      <div class="book-card">
        <div style="display: flex;">
          <div class="book-card_info">
            <h3><?php echo $componentData['nameBook']; ?></h3>
            <h5><?php echo $componentData['creatorBook']; ?></h5>
            <h6><?php echo $componentData['publisherBook']; ?></h6>
            <a href="?controller=user&action=book_detail&id=<?php echo $componentData['idBook']; ?>">Chi tiết</a>
          </div>
          <img class="book-card_img"
            src="<?php echo !empty($componentData['imgBook']) ? $componentData['imgBook'] : 'https://upload.wikimedia.org/wikipedia/commons/thumb/0/0b/Book_icon_%28closed%29_-_Blue_and_gold.svg/1170px-Book_icon_%28closed%29_-_Blue_and_gold.svg.png'; ?>"
            alt="">
        </div>
      </div>

      <?php
      $count++;
    }
    ?>
  </div>
</div>

<script>
  const searchBtn = document.querySelector('#search-btn')

  $("#search-btn").on('click', function () {
    const contentSearch = $("#content-search").val();
    const optionSearch = $("#option-search").val();

    // if (!contentSearch) {
    //   showAlert("Vui lòng từ khóa cần tìm kiếm!", "warning");
    //   return;
    // }

    window.location.href = '?controller=user&action=searchBook&contentSearch=' + encodeURIComponent(contentSearch) + '&optionSearch=' + encodeURIComponent(optionSearch);
  })

  function showAlert(message, icon) {
    Swal.fire({
      title: "Thông báo",
      text: message,
      icon,
      showConfirmButton: true,
    }).then(location.reload);
  }
</script>

<style>
  .book-card {
    box-shadow: rgba(50, 50, 93, 0.25) 0px 2px 5px -1px, rgba(0, 0, 0, 0.3) 0px 1px 3px -1px;
    border-radius: 5px;
    overflow: hidden;
    background-color: #fff;
    width: 100%
  }

  .book-card_info {
    width: 55%;
    position: relative;
    padding: 20px 15px;

    >a {
      position: absolute;
      bottom: 15px;
      left: 15px;
      color: var(--green-cl);
      font-weight: 600;
    }

    >h3 {
      color: #727270;
    }

    >h5 {
      margin-top: 10px;
      color: #727270;
    }

    >h6 {
      margin-top: 10px;
      color: #727270;
    }
  }

  .book-card_img {
    width: 45%;
    aspect-ratio: 6 / 8;
  }

  .gird-content {
    display: grid;
    width: 1200px;
    margin: 10px auto;
    grid-gap: 20px;
    grid-template-columns: repeat(3, 1fr);
  }
</style>