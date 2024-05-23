<style>
  .chart__container {
    width: calc(100vw - 254px);
    padding: 20px;
    position: relative;
    left: 254px;
    display: flex;
    justify-content: space-between;
    flex-wrap: wrap;
  }

  .box__chart {
    flex: 0 0 calc(50% - 10px);
    /* Mỗi item chiếm 50% không gian, trừ đi khoảng cách giữa các item */
    margin: 5px;
  }

  .title__chart {
    border-radius: 5px 5px 0 0;
    text-transform: capitalize;
    width: 100%;
    padding: 8px 0;
    text-align: center;
    font-size: 20px;
    background-color: #299849;
    font-weight: 600;
  }

  .content__chart {
    height: calc(100vh / 2 - 70px);
  }

  #book-chart {
    /* width: 550px; */
  }

  #request-chart {
    /* width: 600px; */
  }
</style>

<div class="body__container">

  <div class="chart__container">
    <div class="box__chart">
      <div id='1' class="title__chart">Số lượng sách được mượn</div>
      <div class="content__chart" id="book-chart">
      </div>
    </div>

    <div class="box__chart">
      <div class="title__chart">Số lượng yêu cầu mượn sách</div>
      <div class="content__chart" id="request-chart">
      </div>
    </div>

    <div class="box__chart">
      <div class="title__chart">Số lượng tài khoản</div>
      <div class="content__chart" id="user-chart">
      </div>
    </div>

    <div class="box__chart">
      <div class="title__chart">Số lượng tài liệu</div>
      <div class="content__chart" id="type-chart">
      </div>
    </div>
  </div>

</div>

<script type="text/javascript">
  var countRequest = <?php echo json_encode($data['countRequestInMonth']); ?>; 

  var countStatus = <?php echo json_encode($data['countStatusRequest']); ?>; 

  var countUser = <?php echo json_encode($data['countUser']); ?>;

  var countCategory = <?php echo json_encode($data['countCategory']); ?>; 

  window.onload = function () {
    var bookChart = new CanvasJS.Chart("book-chart",
      {
        title: {
        },
        data: [

          {
            dataPoints: countRequest.map((item) => {
              return { x: parseInt(item[0]), y: parseInt(item[1]), label: `Tháng ${item[0]}` }
            })
          }
        ]
      });
    bookChart.render();

    var requestChart = new CanvasJS.Chart("request-chart",
      {
        legend: {
          // maxWidth: 350,
          itemWidth: 70
        },
        data: [
          {
            type: "pie",
            showInLegend: true,
            legendText: "{indexLabel}",
            dataPoints:
              countStatus.map((item) => {
                var nameStatus;
                if (parseInt(item[0]) === 0) {
                  nameStatus = 'Chờ xét duyệt';
                } else if (parseInt(item[0]) === 1) {
                  nameStatus = 'Đang mượn';
                } else if (parseInt(item[0]) === 2) {
                  nameStatus = 'Đã trả';
                } else if (parseInt(item[0]) === 3) {
                  nameStatus = 'Mượn quá hạn';
                } else if (parseInt(item[0]) === 4) {
                  nameStatus = 'Yêu cầu bị từ chối';
                }

                return { y: parseInt(item[1]), indexLabel: nameStatus }

              })
          }
        ]
      });
    requestChart.render();

    var userChart = new CanvasJS.Chart("user-chart",
      {
        legend: {
          // maxWidth: 350,
          itemWidth: 70
        },
        data: [
          {
            type: "pie",
            showInLegend: true,
            legendText: "{indexLabel}",
            dataPoints:
              countUser.map((item) => {
                var nameUser;
                if (parseInt(item[0]) === 0 || parseInt(item[0]) === 1) {
                  nameUser = 'Độc giả';
                } else if (parseInt(item[0]) === 2 || parseInt(item[0]) === 4) {
                  nameUser = 'Thủ thư';
                } else if (parseInt(item[0]) === 3) {
                  nameUser = 'Quản trị viên';
                }
                return { y: parseInt(item[1]), indexLabel: nameUser }

              })
          }
        ]
      });
    userChart.render();

    var typeChart = new CanvasJS.Chart("type-chart",
      {
        legend: {
          // maxWidth: 350,
          itemWidth: 70
        },
        data: [
          {
            type: "pie",
            showInLegend: true,
            legendText: "{indexLabel}",
            dataPoints:
              countCategory.map((item) => {
                return { y: parseInt(item[2]), indexLabel: item[1] }
              })
          }
        ]
      });
    typeChart.render();
  }
</script>