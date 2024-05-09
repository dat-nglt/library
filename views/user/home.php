<?php
if (isset($data) && $data !== []) {
  $notificationType = $data['notification']['type'];
  $notificationMessage = $data['notification']['message'];
  $notificationLink = $data['notification']['link'];
  $notificationType($notificationMessage, $notificationLink);
}
?>
<div class="home">
  <div class="user-search">
    <div class="user-search-sub">
      <select class="select-search" name="" id="">
        <option value="">Tất cả</option>
        <option value="">Nhan đề</option>
        <option value="">Tác giả</option>
        <option value="">Chủ đề</option>
        <option value="">Năm xuất bản</option>
        <option value="">Chỉ số phân loại</option>
      </select>
      <input class="input-search" type="text" placeholder="Nhập tên sách hoặc từ khoá cần tìm ...">

      <button id="btn-search">Tìm kiếm</button>
    </div>
  </div>

  <div class="book-data">
    <div class="book-data-sub">
      <div class="book-data-title">
        <i class="fa-solid fa-tags"></i>Tài liệu chuyên ngành
      </div>
      <div class="book-data-content">
        <a href="">- Toán cao cấp</a>
        <a href="">- Pháp luật đại cương</a>
        <a href="">- Tin học văn phòng</a>
        <a href="">- Đại số tuyến tính</a>
        <a href="" class="view-all">Xem tất cả</a>
      </div>
    </div>

    <div class="book-data-sub">
      <div class="book-data-title">
        <i class="fa-solid fa-tags"></i>Tài liệu điện tử
      </div>
      <div class="book-data-content">
        <a href="">- Toán cao cấp</a>
        <a href="">- Pháp luật đại cương</a>
        <a href="">- Tin học văn phòng</a>
        <a href="">- Đại số tuyến tính</a>
        <a href="" class="view-all">Xem tất cả</a>
      </div>
    </div>

    <div class="book-data-sub">
      <div class="book-data-title">
        <i class="fa-solid fa-tags"></i>Tài liệu mới cập nhật
      </div>
      <div class="book-data-content">
        <a href="">- Toán cao cấp</a>
        <a href="">- Pháp luật đại cương</a>
        <a href="">- Tin học văn phòng</a>
        <a href="">- Đại số tuyến tính</a>
        <a href="" class="view-all">Xem tất cả</a>
      </div>
    </div>
  </div>

  <div class="book-news">
    <div class="book-hot" style="border-right: 1px solid #333; padding: 5px 25px 0px 10px;">Điểm sách hay</div>
    <div class="news-hot" style="padding: 5px 0px;">Tin tức - Event</div>
  </div>
</div>