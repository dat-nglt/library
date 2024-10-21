<?php
$listRentBook = $listRentBook ? $listRentBook : [];
// var_dump($listRentBook);
?>

<div class="content">
  <div id="profile__title"> Lịch sử mượn sách</div>
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
                  $statusRequest = "Quá hạn trả";
                  break;
                case 4:
                  $statusRequest = "Yêu cầu bị từ chối";
                  break;
                default:
                  $statusRequest = "Chờ xét duyệt";
              }
              echo '<tr' . ($item[8] == 4 ? ' style="background-color: #ffe9bf;"' : '') . '>';
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


<style>
  .table-box {
    padding: 4px 15px 15px;
  }

  .filterRentBook {
    padding: 10px 15px 5px;
    display: flex;
    gap: 20px;
    align-items: flex-end;
    justify-content: space-between;
  }

  .filterRentBook>a {
    font-weight: 600;
    background: #919190;
    padding: 7px 35px;
    font-size: 14px;
    color: var(--white-cl);

    &:hover {
      background: #1ca26d;
    }
  }

  .filterRentBook>div>fieldset {
    display: inline-block;
    margin-right: 20px;
    width: fit-content;
    background-color: transparent;
    border-radius: 0px;
    border: 1px solid #727271;
    padding: 0px 10px 2px 10px;

    .admin__form-search {
      display: flex;
      gap: 7px;
      align-items: center;
    }

    legend {
      font-size: 13px;
      font-weight: 600;
    }

    input[type="text"] {
      width: 200px;
      padding: 0px 0 2px 2px;
      color: #333;
      font-size: 14px;
      outline: 0;
      background-color: transparent;
      border: none;
    }

    input::placeholder {
      font-style: italic;
      font-size: 14px;
    }

    button {
      padding: 0;
      font-size: 14px;
      cursor: pointer;
      color: #333;
      border: 0;
      border-radius: 5px;
      background-color: transparent;

      &:hover {
        background-color: transparent;
      }
    }

    select {
      border: none;
      background-color: transparent;
      color: #333;
      width: fit-content;
      margin-left: -5px;
      font-size: 14px;
      cursor: pointer;

      &:focus-within {
        outline: none;
      }

      option {
        color: var(--black-cl);
      }
    }
  }

  #rent-table {
    border-collapse: collapse;
  }

  #rent-table th,
  td {
    /* border: 1px solid #fff; */
    border: 1px solid #aaaaaa;
    text-align: center;
  }

  #rent-table th {
    padding: 10px 7px;
    font-size: 15px;
    background-color: #4ea25e !important;
    color: #fff;
  }

  #rent-table td {
    padding: 6px 10px;
    font-size: 13px;
    max-height: 10px;
    max-width: 200px;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
  }

  #rent-table tr:hover {
    cursor: pointer;
    background-color: #e4e4e4 !important;
  }

  .number-page {
    margin: 10px;
    display: flex;
    gap: 5px;
    justify-content: flex-end;
  }

  .number-page>a {
    padding: 2px;
    width: 20px;
    height: 1 / 1;
    border-radius: 3px;
    text-align: center;
    font-weight: 600;
    color: #fff;
    background: #919190;
  }

  .number-page>a:hover {
    background-color: #1ca26d;
  }
</style>