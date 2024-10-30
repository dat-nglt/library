<style>
  .body__container {
    width: calc(100vw - 254px);
    position: relative;
    left: 254px;
    flex-direction: column;
    padding: 20px;
  }

  .options {
    padding: 15px 0;
    margin: 0 auto 20px;
    width: 95%;
    display: flex;
    align-items: center;
    justify-content: space-between;
  }

  .chart__container {
    width: 95%;
    margin: 0 auto;
    height: 500px;
    display: flex;
    justify-content: space-between;
  }

  .canvasjs-chart-container {
    width: 100%;
  }

  .canvasjs-chart-canvas {

    width: 100% !important;
  }

  button {
    font-size: 20px;
    height: 100%;
    cursor: pointer;
    border: none;
    background-color: #0095ff;
    border-radius: 5px;
    padding: 6px 8px;
    color: #fff;
    font-weight: 500;
    margin-top: 7px;

    &:hover {
      background-color: #2ac312;
    }
  }

  fieldset {
    width: fit-content;
    background-color: transparent;
    border-radius: 5px;
    padding: 0px 10px 3px 10px;

    .admin__form-search {
      display: flex;
      gap: 7px;
      align-items: center;
    }

    legend {
      font-size: 15px;
      font-weight: 500;
      padding: 0 7px;
    }

    select {
      border: none;
      background-color: transparent;
      color: black;
      width: fit-content;
      margin-left: -5px;
      font-size: 15px;
      padding: 1.5px 0;

      &:focus-within {
        outline: none;
      }

      option {
        color: var(--black-cl);
        font-size: 15px;

        &:checked {
          font-weight: bold;
        }
      }
    }
  }

  .admin__form-search {
    display: flex;
    align-items: center;
    gap: 5px;
  }

  .canvasjs-chart-tooltip {
    bottom: 0 !important;
  }
</style>

<div class="body__container">
  <?php
  $dataPoints = array();
  ?>
  <div class="options">
    <h2 id="title">Loại thống kê</h2>
    <!-- <?php
    print_r($_SESSION["chart_option"])
      ?> -->
    <div>
      <form action="?controller=admin" method="post" class="admin__form-search">
        <?php
        switch ($_SESSION['chart_option']) {
          case "chartRequest":
            foreach ($chartData as $item) {
              $dataPoints[] = array(
                "label" => $item['month'], // Hoặc $item->label nếu $item là đối tượng
                "y" => $item['countRequest'] // Hoặc $item->value nếu $item là đối tượng
              );
            }
            ?>
            <fieldset>
              <legend>Năm</legend>
              <select name="years_filter" id="years_filter">
                <option value="2022" <?php if ($_SESSION['years_filter'] === '2022')
                  echo 'selected'; ?>>
                  2022
                </option>
                <option value="2023" <?php if ($_SESSION['years_filter'] === '2023')
                  echo 'selected'; ?>>
                  2023
                </option>
                <option value="2024" <?php if ($_SESSION['years_filter'] === '2024')
                  echo 'selected'; ?>>
                  2024
                </option>
              </select>
            </fieldset>
            <fieldset>
              <legend>Trạng thái</legend>
              <select name="status_filter" id="status_filter">
                <option value="all" <?php if ($_SESSION['status_filter'] === 'all')
                  echo 'selected'; ?>>
                  Tất cả
                </option>
                <option value="0" <?php if ($_SESSION['status_filter'] === '0')
                  echo 'selected'; ?>>
                  Chờ xét duyệt
                </option>
                <option value="1" <?php if ($_SESSION['status_filter'] === '1')
                  echo 'selected'; ?>>
                  Đang mượn
                </option>
                <option value="2" <?php if ($_SESSION['status_filter'] === '2')
                  echo 'selected'; ?>>
                  Đã trả
                </option>
                <option value="3" <?php if ($_SESSION['status_filter'] === '3')
                  echo 'selected'; ?>>
                  Quá hạn
                </option>
                <option value="4" <?php if ($_SESSION['status_filter'] === '4')
                  echo 'selected'; ?>>
                  Từ chối yêu cầu
                </option>
              </select>
            </fieldset>
            <?php
            break; // Thêm break để không chạy vào case tiếp theo
          case "chartBook":
            foreach ($chartData as $item) {
              $dataPoints[] = array(
                "label" => $item['nameCategory'], // Hoặc $item->label nếu $item là đối tượng
                "y" => $item['count'] // Hoặc $item->value nếu $item là đối tượng
              );
            }
            ?>
            <fieldset>
              <legend>Trạng thái</legend>
              <select name="category_filter" id="category_filter">
                <option value="all" <?php if ($_SESSION['category_filter'] === 'all')
                  echo 'selected'; ?>>
                  Tất cả
                </option>
                <option value="inStock" <?php if ($_SESSION['category_filter'] === 'inStock')
                  echo 'selected'; ?>>
                  Sẵn kho
                </option>
                <option value="rented" <?php if ($_SESSION['category_filter'] === 'rented')
                  echo 'selected'; ?>>
                  Đã được mượn
                </option>
              </select>
            </fieldset>
            <?php
            break; // Thêm break
          case "chartReader":
            foreach ($chartData as $item) {
              $dataPoints[] = array(
                "label" => $item['gender'] == 1 ? "Nam" : "Nữ", // Hoặc $item->label nếu $item là đối tượng
                "y" => $item['countReader'] // Hoặc $item->value nếu $item là đối tượng
              );
            }
            ?>
            <!-- <fieldset>
              <legend>Giới tính</legend>
              <select name="sex_filter" id="sex_filter">
                <option value="all" <?php if ($_SESSION['sex_filter'] === 'all')
                  echo 'selected'; ?>>
                  Tất cả
                </option>
                <option value="male" <?php if ($_SESSION['sex_filter'] === 'male')
                  echo 'selected'; ?>>
                  Nam
                </option>
                <option value="female" <?php if ($_SESSION['sex_filter'] === 'female')
                  echo 'selected'; ?>>
                  Nữ
                </option>
              </select>
            </fieldset> -->
            <fieldset>
              <legend>Khóa học</legend>
              <select name="grade_filter" id="grade_filter">
                <option value="all" <?php if ($_SESSION['grade_filter'] === 'all')
                  echo 'selected'; ?>>
                  Tất cả
                </option>
                <option value="9" <?php if ($_SESSION['grade_filter'] === '9')
                  echo 'selected'; ?>>
                  Khóa 9
                </option>
                <option value="10" <?php if ($_SESSION['grade_filter'] === '10')
                  echo 'selected'; ?>>
                  Khóa 10
                </option>
              </select>
            </fieldset>
            <?php
            break; // Thêm break
        }
        ?>
        <fieldset>
          <legend>Lựa chọn</legend>
          <select name="chart_option" id="chart_option">
            <option value="chartRequest" <?php if ($_SESSION['chart_option'] === 'chartRequest')
              echo 'selected'; ?>>
              Thống kê số lượt mượn sách
            </option>
            <option value="chartReader" <?php if ($_SESSION['chart_option'] === 'chartReader')
              echo 'selected'; ?>>
              Thống kê số lượng độc giả
            </option>
            <option value="chartBook" <?php if ($_SESSION['chart_option'] === 'chartBook')
              echo 'selected'; ?>>
              Thống kê số lượng tài liệu
            </option>
          </select>
        </fieldset>
        <button type="submit">
          <i class="fa-solid fa-magnifying-glass-chart"></i>
        </button>
      </form>
    </div>
  </div>
  <div class="chart__container" id="chart__container">

  </div>
</div>


<script type="text/javascript">

  let titleElement = document.querySelector("#title");
  let chartOption = document.querySelector("#chart_option");
  var chartObj = {}
  titleElement.innerHTML = chartOption.options[chartOption.selectedIndex].innerText;

  console.log(chartOption.value);

  switch (chartOption.value) {
    case "chartBook":
      chartObj = {
        animationEnabled: true,
        data: [{
          type: "pie",
          yValueFormatString: "#,##0\" quyển\"",
          indexLabel: "{label} ({y})",
          dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
        }]
      }
      break;
    case "chartReader":
      chartObj = {
        animationEnabled: true,
        data: [{
          type: "pie",
          yValueFormatString: "#,##0\" bạn\"",
          indexLabel: "{label} ({y})",
          dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
        }]
      }
      break;
    case "chartRequest":
      chartObj = {
        axisY: {
          title: "Lượt mượn"
        },
        data: [{
          type: "line",
          dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
        }]
      }
      break;
  }


  var chart = new CanvasJS.Chart("chart__container", chartObj);
  chart.render();
</script>