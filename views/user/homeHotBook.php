<div class="book-content">
  <div class="gird-content">
    <?php
    foreach ($data['componentDatas'] as $componentData) {
      echo "<a href=''>";
      echo "<img src='" . $componentData['image'] . "' alt=''>";
      echo $componentData['title'];
      echo "</a>";
    }
    ?>
  </div>
</div>