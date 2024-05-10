<div class="content">
  <div id="profile__title"> Lịch sử mượn</div>
  <div class="table-box">
    <table id="rent-table">
      <thead>
        <tr>
          <th style="width: 5%;">STT</th>
          <th style="width: 14%;">Mã phiếu mượn</th>
          <th style="width: 20%">Tên sách</th>
          <th style="width: 20%">Tác Giả</th>
          <th style="width: 13%;">Ngày mượn</th>
          <th style="width: 13%;">Ngày trả</th>
          <th style="width: 15%;">Trạng thái</th>
        </tr>
      </thead>
      <tbody>
        <?php
        for ($i = 1; $i <= 10; $i++) {
          echo '<tr>';
          echo '<td>' . $i . '</td>';
          echo '<td>1</td>';
          echo '<td>Hội Kín</td>';
          echo '<td>Nguyễn Trương Đạt con ông Trương Văn Đạt</td>';
          echo '<td>20/04/2024</td>';
          echo '<td>22/04/2024</td>';
          echo '<td>Đã trả</td>';
          echo '</tr>';
        }
        ?>
      </tbody>
    </table>
    <div class="number-page">
      <a href="">1</a>
      <a href="">1</a>
      <a href="">1</a>
      <a href="">1</a>
      <a href="">1</a>
    </div>
  </div>
</div>