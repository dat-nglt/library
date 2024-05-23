<style>
  .chart__container {
    width: calc(100vw - 254px);
    height: 100vh;
    padding: 20px;
    position: relative;
    left: 254px;
    display: flex;
    gap: 50px;
    justify-content: center;
  }

  .box__chart {
    width: fit-content;
    height: fit-content;
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

  #book-chart {
    overflow: hidden;
    height: 300px;
    width: 550px;
  }

  #request-chart {
    height: 300px;
    width: 600px;
  }
</style>

<div class="body__container">

  <div class="chart__container">
    <div class="box__chart">
      <div class="title__chart">Số lượng sách đã mượn</div>
      <div id="book-chart">
      </div>
    </div>

    <div class="box__chart">
      <div class="title__chart">Số lượng yều cầu mượn sách</div>
      <div id="request-chart">
      </div>
    </div>
  </div>

</div>

<script type="text/javascript">
  window.onload = function () {
    var bookChart = new CanvasJS.Chart("book-chart",
      {
        title: {
        },
        data: [

          {
            dataPoints: [
              { x: 1, y: 2975715, label: "Tháng 1" },
              { x: 2, y: 267017, label: "Tháng 2" },
              { x: 3, y: 175200, label: "Tháng 3" },
              { x: 4, y: 154580, label: "Tháng 4" },
              { x: 5, y: 116000, label: "Tháng 5" },
              { x: 6, y: 97800, label: "Tháng 6" },
              { x: 7, y: 20682, label: "Tháng 7" },
              { x: 8, y: 20350, label: "Tháng 8" },
              { x: 9, y: 20350, label: "Tháng 9" },
              { x: 10, y: 20350, label: "Tháng 10" },
              { x: 11, y: 20350, label: "Tháng 11" },
              { x: 12, y: 20350, label: "Tháng 12" },
            ]
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
            dataPoints: [
              { y: 4181563, indexLabel: "Chờ xét duyệt" },
              { y: 2175498, indexLabel: "Đang mượn" },
              { y: 3125844, indexLabel: "Đã trả" },
              { y: 1176121, indexLabel: "Quá hạn" },
              { y: 1727161, indexLabel: "Yêu cầu bị từ chối" },
            ]
          }
        ]
      });
    requestChart.render();
  }
</script>