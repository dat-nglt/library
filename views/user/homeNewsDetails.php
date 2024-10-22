<div class="news-content">
  <?php foreach ($componentDatas as $componentData) { ?>
    <div class="news-card">
      <div class="box-img"><img class="news-img" src="<?php echo htmlspecialchars($componentData['image']); ?>"
          alt="ảnh của <?php echo htmlspecialchars($componentData['author']); ?>"></div>
      <div class="news-data">
        <div class="news-title"><?php echo htmlspecialchars($componentData['title']); ?></div>
        <div class="info-field-news">
          <div class="content-container"><i
              class="fa-solid fa-newspaper icon-newdetail"></i><span><?php echo htmlspecialchars($componentData['content']); ?></span>
          </div>
          <div><i
              class="fa-solid fa-user icon-newdetail"></i><span><?php echo htmlspecialchars($componentData['author']); ?></span>
          </div>
          <div><i
              class="fa-solid fa-calendar-days icon-newdetail"></i><span><?php echo htmlspecialchars($componentData['date']); ?></span>
          </div>
        </div>
        <a class="back-newhot" href="?controller=user&action=newsHot">Quay lại</a>
      </div>
    </div>
  <?php } ?>
</div>




<style>
  .news-content {
    display: flex;
    flex-direction: column;
    align-items: center;
    padding: 20px;
  }

  .news-card {
    position: relative;
    background-color: #f9f9f9;
    box-shadow: rgba(0, 0, 0, 0.1) 0px 4px 10px;
    margin: 15px;
    width: 100%;
    max-width: 700px;
    border-radius: 15px;
    overflow: hidden;
    display: flex;
    flex-direction: column;
  }

  .box-img {
    width: 100%;
    text-align: center;
  }

  .news-img {
    width: 50%;
    height: auto;
    border-radius: 10px;
    margin: 20px;
  }

  .news-data {
    display: flex;
    flex-direction: column;
    padding: 15px;
    gap: 10px;
  }

  .news-title {
    font-size: 20px;
    font-weight: bold;
    color: #333;
  }

  .info-field-news {
    display: flex;
    flex-direction: column;
    gap: 5px;
  }

  .content-container {
    display: -webkit-box;
    overflow: hidden;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    margin: 0;
    word-break: break-word;
  }

  .back-newhot {
    text-align: right;
    font-weight: bold;
    color: #007bff;
    text-decoration: none;
  }

  .icon-newdetail {
    margin-right: 10px
  }
</style>