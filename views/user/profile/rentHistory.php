<?php
$listRentBook = $listRentBook ? $listRentBook : [];
?>

<div class="content">
  <div id="profile__title"> Danh sách mượn</div>
  <div class="table-box">
    <table id="rent-table">
      <thead>
        <tr>
          <th style="width: 5%;">STT</th>
          <th style="width: 10%;">Mã phiếu</th>
          <th style="width: 24%; min-width: 225.81px;">Tên sách</th>
          <th style="width: 15%; min-width: 225.81px">Tác Giả</th>
          <th style="width: 13%;">Ngày mượn</th>
          <th style="width: 13%;">Ngày trả</th>
          <th style="width: 20%;">Trạng thái</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $index = 0;
        foreach ($listRentBook as $item) {
          switch ($item[8]) {
            case 0:
              $statusRequest = "Chờ xác nhận";
              break;
            case 1:
              $statusRequest = "Đang mượn";
              break;
            case 2:
              $statusRequest = "Đã trả";
              break;
            case 3:
              $statusRequest = "Từ chối mượn";
              break;
            default:
              return "Chờ xác nhận";
          }
          $index++;
          echo '<tr>';
          echo '<td>' . $index . '</td>';
          echo '<td>' . $item[0] . '</td>';
          echo '<td>' . $item[6] . '</td>';
          echo '<td>' . $item[7] . '</td>';
          echo '<td>' . $item[4] . '</td>';
          echo '<td>' . $item[5] . '</td>';
          echo '<td>' . $statusRequest . '</td>';
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