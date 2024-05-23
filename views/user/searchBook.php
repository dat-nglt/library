<!-- <form id="search-form"> -->
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
<!-- </form> -->
<div class="search-container">
  <div class="search-book-name">Kết quả tìm kiếm <?= $optionText ?>: <i><?= $contentSearch ?></i></div>

  <?php
  require_once './views/user/homeHotBook.php'
    ?>
</div>

<script>
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
  }</script>