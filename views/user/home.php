<?php
if (isset($data['notification']) && $data !== []) {
  $notificationType = $data['notification']['type'];
  $notificationMessage = $data['notification']['message'];
  $notificationLink = $data['notification']['link'];
  $notificationType($notificationMessage, $notificationLink);
}

?>
<div class="home">
  <div class="user-search">
    <div class="user-search-sub">
      <select class="select-search" name="option-search" id="option-search">
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
  <div class="book-data">
    <div class="book-data-sub">
      <div class="book-data-title">
        <i class="fa-solid fa-tags"></i>Tài liệu chuyên ngành
      </div>
      <div class="book-data-content">
        <a href="?controller=user&action=searchBook&contentSearch=NCKH&optionSearch=nameCategory">- Đề tài NCKH</a>
        <a href="?controller=user&action=searchBook&contentSearch=Đồ%20Án&optionSearch=nameCategory">- Đồ án</a>
        <a href="?controller=user&action=searchBook&contentSearch=Tiểu%20luận&optionSearch=nameCategory">- Tiểu luận</a>
      </div>
    </div>

    <div class="book-data-sub">
      <div class="book-data-title">
        <i class="fa-solid fa-tags"></i>Tài liệu học tập
      </div>
      <div class="book-data-content">
        <a href="?controller=user&action=searchBook&contentSearch=Bài%20giảng&optionSearch=nameCategory">- Bài giảng</a>
        <a href="?controller=user&action=searchBook&contentSearch=Giáo%20trình&optionSearch=nameCategory">- Giáo
          trình</a>
        <a href="?controller=user&action=searchBook&contentSearch=Đề%20cương&optionSearch=nameCategory">- Đề cương</a>
      </div>
    </div>

    <div class="book-data-sub">
      <div class="book-data-title">
        <i class="fa-solid fa-tags"></i>Tài liệu khác
      </div>
      <div class="book-data-content">
        <a href="?controller=user&action=searchBook&contentSearch=Tiểu%20thuyết&optionSearch=nameCategory">- Tiểu
          thuyết</a>
        <a href="?controller=user&action=searchBook&contentSearch=Truyện&optionSearch=nameCategory">- Truyện</a>
        <a href="?controller=user&action=searchBook&contentSearch=Tạp%20chí&optionSearch=nameCategory">- Tạp chí</a>
      </div>
    </div>
  </div>

  <div class="book-news">
    <div class="BN-title">
      <?php
      echo '<a href="?controller=user&action=bookHot" class="BN-item" id="book-hot">Điểm sách hay</a>';
      echo '<a href="?controller=user&action=newsHot" class="BN-item" id="news-hot">Tin tức - Event</a>';
      ?>
    </div>

    <div id="content">
      <?php
      $data['componentName'] = isset($data['componentName']) ? $data['componentName'] : 'home';
      require_once './views/user/' . $data['componentName'] . '.php'
        ?>
    </div>
    <a class="BN-viewAll" href="">Xem tất cả</a>
  </div>
</div>

<script>
  const currentURL = window.location.href;
  const BNitem = document.querySelectorAll('.BN-item');
  const searchBtn = document.querySelector('#search-btn')

  console.log(currentURL);

  for (const [key, item] of Object.entries(BNitem)) {
    if (currentURL.includes(item.href)) {
      item.classList.toggle('active-home-hot');
    }
    else if (currentURL == 'http://localhost/library/') {
      BNitem[0].classList.add('active-home-hot');
    }
  }

  $("#search-btn").on('click', function () {
    const contentSearch = $("#content-search").val();
    const optionSearch = $("#option-search").val();

    if (!contentSearch) {
      showAlert("Vui lòng từ khóa cần tìm kiếm!", "warning");
      return;
    }

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