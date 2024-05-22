
<?php
$listRentBook = $listRentBook ? $listRentBook : [];
?>

<div class="content">
  <div id="profile__title"> Danh sách mượn</div>
  <div class="filterRentBook">
    <div class="sub-filter">
      <fieldset>
        <legend>Tìm kiếm</legend>
        <form action="?controller=user&action=profile&profilePage=rentHistory" method="post" class="admin__form-search">
          <input type="text" name="search_list_rent_book" placeholder="Tìm theo tên sách..." autocomplete="off">
          <button type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
        </form>
      </fieldset>

      <fieldset>
        <legend>Sắp xếp</legend>
        <form action="?controller=user&action=profile&profilePage=rentHistory" method="post" class="admin__form-search">
          <select name="sort_list_rent_book" id="">
            <option value="desc" <?php if ($_SESSION['sort_list_rent_book'] === 'desc')
              echo 'selected' ?>>
                Mới nhất
              </option>
              <option value="asc" <?php if ($_SESSION['sort_list_rent_book'] === 'asc')
              echo 'selected' ?>>Cũ
                nhất
              </option>
            </select>
            <button type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
          </form>
        </fieldset>
      </div>
      <a href="?controller=user&action=profile&profilePage=rentHistory">Tất cả</a>
    </div>
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
            $stt = ($currentPage - 1) * $limit + 1;
            foreach ($listRentBook as $item) {
              switch ($item[8]) {
                case 0:
                  $statusRequest = 'Chờ xét duyệt';
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
                  return "Chờ xét duyệt";
              }
              echo '<tr>';
              echo '<td>' . $stt . '</td>';
              echo '<td>' . $item[0] . '</td>';
              echo '<td>' . $item[6] . '</td>';
              echo '<td>' . $item[7] . '</td>';
              echo '<td>' . $item[4] . '</td>';
              echo '<td>' . $item[5] . '</td>';
              echo '<td style="max-width: 30px;">' . $statusRequest . '</td>';
              echo '</tr>';
              $stt++;
            }
            ?>
      </tbody>
    </table>
    <div class="number-page">
      <?php
      if ($totalPage > 1) {
        if ($currentPage > 3) {
          echo '<a href="?controller=user&action=profile&profilePage=rentHistory&page=1"><i class="fa-solid fa-angles-left"></i></a>';
        }
        if ($currentPage > 1) {
          echo ' <a href="?controller=user&action=profile&profilePage=rentHistory&page=' . ($currentPage - 1) . '"><i class="fa-solid fa-angle-left"></i></a>';
        }
        for ($i = 1; $i <= $totalPage; $i++) {
          if ($i != $currentPage) {
            if ($i > $currentPage - 3 && $i < $currentPage + 3) {
              echo '<a href="?controller=user&action=profile&profilePage=rentHistory&page=' . $i . '">' . $i . '</a>';
            }
          } else {
            echo '<a href="?controller=user&action=profile&profilePage=rentHistory&page=' . $i . '" class="button-current">' . $i . '</a>';
          }
        }
        if ($currentPage < $totalPage) {
          echo '<a href="?controller=user&action=profile&profilePage=rentHistory&page=' . ($currentPage + 1) . '"><i class="fa-solid fa-angle-right"></i></a>';
        }
        if ($currentPage < $totalPage - 2) {
          echo '<a href="?controller=user&action=profile&profilePage=rentHistory&page=' . ($totalPage) . '"><i class="fa-solid fa-angles-right"></i></a>';
        }
      }
      ?>
    </div>
  </div>
</div>