<div class="news-content">
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
</div>