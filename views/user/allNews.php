<div class="news-search">
  <div class="news-search-sub">
    <select class="select-search" id="sort-search">
      <option value="desc">Mới nhất</option>
      <option value="asc">Xưa nhất</option>
    </select>
    <input class="date-news" type="date" id="date-search">
    <input id="content-search" class="input-search" type="text"
      placeholder="Nhập từ khoá cần tìm ...">
    <button id="search-btn" type="button">Tìm kiếm</button>
  </div>
</div>

<div class="news-content">
  <?php foreach ($componentDatas as $componentData) { ?>
    <div class="news-form">
      <div class="news-img">
        <img src="<?php echo $componentData['image'] ?>" alt="<?php echo $componentData['title'] ?>">
      </div>
      <div class="news-data">
        <a href="?controller=user&action=newsdetails&id=<?php echo $componentData['id'] ?>" class="news-title"><?php echo $componentData['title'] ?></a>
        <div class="info-field-news">
          <div class="content-container"><i class="fa-solid fa-newspaper"></i><span><?php echo $componentData['content'] ?></span></div>
          <div><i class="fa-solid fa-calendar-days"></i><span><?php echo $componentData['date'] ?></span></div>
        </div>
      </div>
    </div>
  <?php } ?>
</div>
<script>
  const searchBtn = document.querySelector('#search-btn')
  $("#search-btn").on('click', function () {
    const contentSearch = $("#content-search").val();
    const sortSearch = $("#sort-search").val();
    const dateSearch = $("#date-search").val();
    window.location.href = '?controller=user&action=searchNews&contentSearch=' + encodeURIComponent(contentSearch) + '&sortSearch=' + encodeURIComponent(optionSearch) + '&=' + encodeURIComponent(optionSearch);
  })
  function showAlert(message, icon) {
    Swal.fire({
      title: "Thông báo",
      text: message,
      icon,
      showConfirmButton: true,
    }).then(location.reload);
  }
</script>
<style>
  .news-content {
    max-width: 1200px; 
    margin: 0 auto; 
  }

  .news-form {
    position: relative;
    background-color: #fff;
    box-shadow: rgba(50, 50, 93, 0.25) 0px 2px 5px -1px, rgba(0, 0, 0, 0.3) 0px 1px 3px -1px;
    margin: 10px 0; 
    border-radius: 5px;
    overflow: hidden;
    display: flex;
    gap: 20px;
    padding: 15px; 
  }

  .news-img {
    width: 200px; 
    overflow: hidden;
    display: flex;
    align-items: center;
  }

  .news-img img {
    width: 100%; 
    border-radius: 5px;
    object-fit: cover;
  }

  .news-title {
    font-size: 21px;
    font-weight: 600;
    display: -webkit-box;
    -webkit-box-orient: vertical;
    -webkit-line-clamp: 2;
    overflow: hidden;
    text-overflow: ellipsis;
    max-height: 3em;
    line-height: 1.5em;
    color: #727270;
  }

  .info-field-news {
    display: flex;
    flex-direction: column;
    gap: 10px;
  }

  .content-container {
    display: -webkit-box;
    -webkit-box-orient: vertical;
    -webkit-line-clamp: 1;
    overflow: hidden;
    text-overflow: ellipsis;
    max-height: 3em;
    line-height: 1.5em;
  }

  .info-field-news i {
    min-width: 20px;
  }

  .info-field-news span {
    margin-left: 5px;
    color: #727270;
  }

  .news-data {
    display: flex;
    flex-direction: column;
    gap: 15px;
    padding: 10px 0 10px 15px; 
    flex: 1;
  }

  .news-data a:last-child {
    font-weight: 600;
    color: var(--green-cl);
    margin-top: auto;
  }
</style>
