<div class="book-content">
  <div class="gird-content">
    <?php
    $count = 0;
    $limit = 8;
    foreach ($data['componentDatas'] as $componentData) {
      // var_dump($componentData);
      if ($count >= $limit) {
        break;
      }
      echo "<a href='?controller=user&action=book_detail&id=" . $componentData['idBook'] . "'>";
      echo "<img src='" . (!empty($componentData['imgBook']) ? $componentData['imgBook'] : "https://upload.wikimedia.org/wikipedia/commons/thumb/0/0b/Book_icon_%28closed%29_-_Blue_and_gold.svg/1170px-Book_icon_%28closed%29_-_Blue_and_gold.svg.png") . "' alt=''>";
      echo "<strong>" . $componentData['nameBook'] . "</strong>";
      echo "</a>";

      $count++;
    }
    ?>
  </div>
</div>