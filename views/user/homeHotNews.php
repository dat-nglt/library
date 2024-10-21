<div class="news-content">
  <?php
  foreach ($componentDatas as $componentData) { ?>
    <div class="news-form">
      <img class="news-img" src="https://res.cloudinary.com/dta7fdnph/image/upload/v1729434759/soft_shadow_ocndts.png"
        alt="">
      <div class="news-data">
        <div class="news-title"><?php echo $componentData['title'] ?></div>
        <div class="info-field-news">
          <div class="content-container"><i
              class="fa-solid fa-newspaper"></i></i><span><?php echo $componentData['content'] ?></span></div>
          <div> <i class="fa-solid fa-user"></i><span><?php echo $componentData['author'] ?></span></div>
          <div> <i class="fa-solid fa-calendar-days"></i><span><?php echo $componentData['date'] ?></span></div>
        </div>
        <a href="">Chi tiết</a>
      </div>
    </div>
    <?php
  }
  ?>
</div>



<style>
  .content-container {
    display: -webkit-box;
    -webkit-box-orient: vertical;
    -webkit-line-clamp: 1;
    overflow: hidden;
    text-overflow: ellipsis;
    max-height: 3em;
    line-height: 1.5em;
  }

  .news-title {
    font-size: 21px;
    font-weight: 600;
    color: ;
    display: -webkit-box;
    -webkit-box-orient: vertical;
    -webkit-line-clamp: 2;
    overflow: hidden;
    text-overflow: ellipsis;
    max-height: 3em;
    line-height: 1.5em;
    color: #727270;
  }

  .news-form {
    position: relative;
    background-color: #fff;
    box-shadow: rgba(50, 50, 93, 0.25) 0px 2px 5px -1px, rgba(0, 0, 0, 0.3) 0px 1px 3px -1px;
    margin: 10px auto;
    width: 1200px;
    border-radius: 5px;
    overflow: hidden;
    display: flex;
    gap: 20px;

    img {}

    >.news-data {
      display: flex;
      flex-direction: column;
      gap: 15px;
      padding: 30px 0;

      >.info-field-news {
        display: flex;
        flex-direction: column;
        gap: 10px;

        i {
          min-width: 20px;
        }

        span {
          margin-left: 5px;
          color: #727270;
        }
      }

      >a:last-child {
        position: absolute;
        right: 30px;
        bottom: 30px;
        font-weight: 600;
        color: var(--green-cl);
      }
    }
  }
</style>