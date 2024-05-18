<div class="book-content">
  <div class="gird-content">
    <?php
    $count = 0;
    $limit = 8;
    foreach ($data['componentDatas'] as $componentData) {
      // var_dump($componentData);
      if ($count >= $limit ) {
        break;
      }
      echo "<a href='?controller=user&action=book_detail&id=". $componentData['idBook']."'>";
      echo "<img src='" . (!empty($componentData['imgBook']) ? $componentData['imgBook'] : "./upload/book.png") . "' alt=''>";
      echo $componentData['nameBook'];
      echo "</a>";
      
      $count++;
    }
    ?>
  </div>
</div>