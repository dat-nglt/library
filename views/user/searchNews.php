<div class="news-search">
  <div class="news-search-sub">
    <select class="select-search" id="sort-search">
      <option value="desc">Mới nhất</option>
      <option value="asc">Xưa nhất</option>
    </select>
    <input class="date-news" type="date" id="date-search">
    <input id="content-search" class="input-search" type="text"
      placeholder="Nhập từ khoá cần tìm ...">
    <button id="search-btn" type="button">Tìm kiếm</button>
  </div>
</div>

<div class="search-container">
  <div class="search-book-name">Kết quả tìm kiếm <?= $dateSearch ?>: <i><?= $contentSearch ?></i></div>
  <?php
  require_once './views/user/homeHotNews.php'
    ?>
</div>

<script>
const searchBtn = document.querySelector('#search-btn')
  $("#search-btn").on('click', function () {
    const contentSearch = $("#content-search").val();
    const sortSearch = $("#sort-search").val();
    const dateSearch = $("#date-search").val();
    window.location.href = '?controller=user&action=searchNews&contentSearch=' + encodeURIComponent(contentSearch) + '&sortSearch=' + encodeURIComponent(optionSearch) + '&=' + encodeURIComponent(optionSearch);
  })
  function showAlert(message, icon) {
    Swal.fire({
      title: "Thông báo",
      text: message,
      icon,
      showConfirmButton: true,
    }).then(location.reload);
  }
  }</script>