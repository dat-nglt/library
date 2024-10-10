<!-- <div class="news-content">
  <?php
  foreach ($componentDatas as $componentData) {
    echo '<div class="news-form">';
    echo '<a href=""><img class="news-img" src="' . $componentData['image'] . '" alt=""></a>';
    echo '<div class="news-data">';
    echo '<a href="" style="font-size: 16px; font-weight: 800;">' . $componentData['title'] . '</a>';
    echo '<div style="display: flex; gap: 40px">';
    echo '<span> <i class="fa-solid fa-user"></i> ' . $componentData['author'] . '</span>';
    echo '<span> <i class="fa-solid fa-eye"></i> ' . $componentData['views'] . '</span>';
    echo '<span> <i class="fa-solid fa-calendar-days"></i> ' . $componentData['date'] . '</span>';
    echo '</div>';
    echo '<span>' . $componentData['content'] . '</span>';
    echo '<a href="">Xem thêm</a>';
    echo '</div>';
    echo '</div>';
  }
  ?>
</div> -->

<div class="news-form">
  <a href="">
    <img class="news-img"
      src="data:image/jpeg;base64,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"
      alt="">
  </a>
  <div class="news-data">
    <a href="">Thông báo ngày hội sách năm 2024</a>
    <div class="info-field-news">
      <div> <i class="fa-solid fa-user"></i><span>Lê Nguyễn Minh Hòa</span></div>
      <div> <i class="fa-solid fa-eye"></i><span>50</span></div>
      <div> <i class="fa-solid fa-calendar-days"></i><span>01/10/2024</span></div>
    </div>
    <span>Giao lưu gặp gỡ các nhà thơ, nghệ sĩ đến từ các tỉnh thành trong khu vực</span>
  </div>
</div>


<style>
  .news-form {
    background-color: #fafaf7;
    box-shadow: rgba(60, 64, 67, 0.3) 0px 1px 2px 0px, rgba(60, 64, 67, 0.15) 0px 2px 6px 2px;
    margin: 0 auto;
    width: 1200px;
    margin-top: 10px;
    margin-bottom: 10px;
    padding: 10px;
    border-radius: 5px;
    display: flex;
    gap: 20px;

    img {
      border-radius: 5px;
    }

    >.news-data {
      display: flex;
      flex-direction: column;
      gap: 15px;
      padding: 10px 0;

      >.info-field-news {
        display: flex;
        gap: 40px;

        span {
          margin-left: 5px;
        }
      }

      >a:first-child {
        color: var(--green-cl);
        font-weight: 700;
        font-size: 23px;
      }

      >a:last-child {
        color: var(--green-cl);
      }
    }
  }
</style>