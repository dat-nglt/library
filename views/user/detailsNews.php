<div class="container news">
  <div class="news-content">
    <?php foreach ($componentDatas as $componentData) { ?>
      <div class="news-card">
        <div class="news-data">
          <h1 class="news-title"><?php echo htmlspecialchars($componentData['title']); ?></h1>

          <div class="news-date">
            <i class="fa-solid fa-calendar-days icon-newdetail">
            </i>
            <span><?php echo htmlspecialchars($componentData['date']); ?></span>
          </div>

          <div class="news-content"><?php echo $componentData['content'] ?></div>

        
        </div>

      </div>
    </div>
  <?php } ?>
</div>
</div>

<style>
  .news {
    width: 1200px;
    margin: 0 auto;
    background-color: #fff;
    padding: 30px;
    border-radius: 5px;
  }

  .news-card {
    position: relative;
    .news-data {
      >h1 {
        color: #283e53;
        text-transform: uppercase;
        font-size: 30px;
      }

      .news-date {
        margin: 10px 0;
      }

      .news-content {
        margin: 10px 0;
      }

    }
  }
</style>

<!-- <style>
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
    text-overflow: ellipsis;
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
</style> -->