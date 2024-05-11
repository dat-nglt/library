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
    <div class="BN-title">
      <a href="?controller=user&action=bookHot" class="BN-item" id="book-hot">Điểm sách hay</a>
      <a href="?controller=user&action=newsHot" class="BN-item" id="news-hot">Tin tức - Event</a>
    </div>

    <div id="content">

    </div>

    <div class="book-content">
      <div class="gird-content">
        <a href=""><img src="https://res.cloudinary.com/ctuetdig/image/upload/v1599548496/To_hoc_lap_trinh_d5t64o.png"
            alt="">Tớ Học Lập Trình
          Làm Quen Với Python</a>
        <a href=""><img src="https://res.cloudinary.com/ctuetdig/image/upload/v1599548496/To_hoc_lap_trinh_d5t64o.png"
            alt="">Tớ Học Lập Trình
          Làm Quen Với Python</a>
        <a href=""><img src="https://res.cloudinary.com/ctuetdig/image/upload/v1599548496/To_hoc_lap_trinh_d5t64o.png"
            alt="">Tớ Học Lập Trình
          Làm Quen Với Python</a>
        <a href=""><img src="https://res.cloudinary.com/ctuetdig/image/upload/v1599548496/To_hoc_lap_trinh_d5t64o.png"
            alt="">Tớ Học Lập Trình
          Làm Quen Với Python</a>
      </div>
      <div class="gird-content">
        <a href=""><img src="https://res.cloudinary.com/ctuetdig/image/upload/v1599548496/To_hoc_lap_trinh_d5t64o.png"
            alt="">Tớ Học Lập Trình
          Làm Quen Với Python</a>
        <a href=""><img src="https://res.cloudinary.com/ctuetdig/image/upload/v1599548496/To_hoc_lap_trinh_d5t64o.png"
            alt="">Tớ Học Lập Trình
          Làm Quen Với Python</a>
        <a href=""><img src="https://res.cloudinary.com/ctuetdig/image/upload/v1599548496/To_hoc_lap_trinh_d5t64o.png"
            alt="">Tớ Học Lập Trình
          Làm Quen Với Python</a>
        <a href=""><img src="https://res.cloudinary.com/ctuetdig/image/upload/v1599548496/To_hoc_lap_trinh_d5t64o.png"
            alt="">Tớ Học Lập Trình
          Làm Quen Với Python</a>
      </div>
    </div>

    <div class="news-content">
      <div class="news-form">
        <a href=""><img class="news-img" src="./upload/check-in.png" alt=""></a>
        <div class="news-data">
          <a href="" style="font-size: 16px; font-weight: 800;">Hướng Dẫn Check-In Khi Đến Thư Viện</a>
          <div style="display: flex; gap: 40px">
            <span> <i class="fa-solid fa-user"></i> Trương Văn Đạt</span>
            <span> <i class="fa-solid fa-eye"></i> 2601</span>
            <span> <i class="fa-solid fa-calendar-days"></i> 26/01/20224</span>
          </div>
          <span>Hướng dẫn sinh viên, viên chức của trường Check-In khi đến sử dụng thư viện</span>
          <a href="">Xem thêm</a>
        </div>
      </div>

      <div class="news-form">
        <a href=""><img class="news-img" src="./upload/check-in.png" alt=""></a>
        <div class="news-data">
          <a href="" style="font-size: 16px; font-weight: 800;">Hướng Dẫn Check-In Khi Đến Thư Viện</a>
          <div style="display: flex; gap: 40px">
            <span> <i class="fa-solid fa-user"></i> Trương Văn Đạt</span>
            <span> <i class="fa-solid fa-eye"></i> 2601</span>
            <span> <i class="fa-solid fa-calendar-days"></i> 26/01/20224</span>
          </div>
          <span>Hướng dẫn sinh viên, viên chức của trường Check-In khi đến sử dụng thư viện</span>
          <a href="">Xem thêm</a>
        </div>
      </div>

      <div class="news-form">
        <a href=""><img class="news-img" src="./upload/check-in.png" alt=""></a>
        <div class="news-data">
          <a href="" style="font-size: 16px; font-weight: 800;">Hướng Dẫn Check-In Khi Đến Thư Viện</a>
          <div style="display: flex; gap: 40px">
            <span> <i class="fa-solid fa-user"></i> Trương Văn Đạt</span>
            <span> <i class="fa-solid fa-eye"></i> 2601</span>
            <span> <i class="fa-solid fa-calendar-days"></i> 26/01/20224</span>
          </div>
          <span>Hướng dẫn sinh viên, viên chức của trường Check-In khi đến sử dụng thư viện</span>
          <a href="">Xem thêm</a>
        </div>
      </div>

      <div class="news-form">
        <a href=""><img class="news-img" src="./upload/check-in.png" alt=""></a>
        <div class="news-data">
          <a href="" style="font-size: 16px; font-weight: 800;">Hướng Dẫn Check-In Khi Đến Thư Viện</a>
          <div style="display: flex; gap: 40px">
            <span> <i class="fa-solid fa-user"></i> Trương Văn Đạt</span>
            <span> <i class="fa-solid fa-eye"></i> 2601</span>
            <span> <i class="fa-solid fa-calendar-days"></i> 26/01/20224</span>
          </div>
          <span>Hướng dẫn sinh viên, viên chức của trường Check-In khi đến sử dụng thư viện</span>
          <a href="">Xem thêm</a>
        </div>
      </div>

    </div>

    <a class="BN-viewAll" href="">Xem tất cả</a>
  </div>
</div>

<script>

  // const bookHotBtn = document.querySelector('#book-hot');
  // const newsHotBtn = document.querySelector('#news-hot');
  // const content = document.querySelector('#meme');

  // function loadComponent1() {
  //   fetch('?controller=user&action=bookhot')
  //     .then(response => response.text())
  //     .then(data => {
  //       content.innerHTML = 'hehe';
  //     })
  //     .catch(error => console.log(error));
  // }



</script>