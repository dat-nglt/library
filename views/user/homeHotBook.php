<div class="book-content">
  <div class="grid-content">
    <?php foreach ($componentDatas['books'] as $book) { ?>
      <div class="book-item">
        <a href="">
          <img src="<?php echo $book['imgBook']; ?>" alt="">
          <?php echo $book['nameBook']; ?>
        </a>
      </div>
    <?php } ?>
  </div>
</div>