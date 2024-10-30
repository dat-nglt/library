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

  fieldset {
            width: fit-content;
            background-color: transparent;
            border-radius: 5px;
            padding: 0px 10px 5px 15px;

            .admin__form-search {
                display: flex;
                gap: 7px;
                align-items: center;
            }

            legend {
                font-size: 20px;
                font-weight: 500;
                padding: 0 7px;
            }

          
            button {
                padding: 0;
                font-size: 25px;
                cursor: pointer;
                color: black;
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
                color: black;
                width: fit-content;
                margin-left: -5px;
                font-size: 17px;
                padding: 1.5px 0;

                &:focus-within {
                    outline: none;
                }

                option {
                    color: var(--black-cl);

                    &:checked {
                        font-weight: bold;
                    }
                }
            }
        }
        .canvasjs-chart-tooltip {
          bottom: 0 !important;
        }
</style>

<div class="body__container">
    <div class="options">
      <h1 id="title">Loại thống kê</h1>
      <!-- <?php 
        print_r($_SESSION["chart_option"])
      ?> -->
      <div>
        <fieldset>
          <legend>Lựa chọn thống kê</legend>
            <form action="?controller=admin" method="post" class="admin__form-search">
              <select name="chart_option" id="chart_option">
                    <option value="chartRequest" <?php if ($_SESSION['chart_option'] === 'chartRequest')
                      echo 'selected' ?>>
                        Thống kê số lượt mượn sách
                    </option>
                    <option value="chartReader" <?php if ($_SESSION['chart_option'] === 'chartReader')
                      echo 'selected' ?>>
                        Thống kê số lượng độc giả
                    </option>
                    <option value="chartBook" <?php if ($_SESSION['chart_option'] === 'chartBook')
                      echo 'selected' ?>>
                        Thống kê số lượng tài liệu
                    </option>
                </select>
                <button type="submit"><i class="fa-solid fa-magnifying-glass-chart" style="color: #0095ff;"></i></button>
            </for>
        </fieldset>
      </div>
    </div>
  <div class="chart__container" id="chart__container">
  
  </div>
</div>


<script type="text/javascript">

  let titleElement = document.querySelector("#title");
  let chartOption = document.querySelector("#chart_option");
  titleElement.innerHTML = chartOption.options[chartOption.selectedIndex].innerText;



  var chart = new CanvasJS.Chart("chart__container", {
	animationEnabled: true,
  axisX: {
		minimum: new Date(2015, 01, 25),
		maximum: new Date(2017, 02, 15),
		valueFormatString: "MMM YY"
	},
	axisY: {
		title: "Số lượt mượt sách",
		titleFontColor: "#4F81BC",
		includeZero: true,
	},
	data: [{
		indexLabelFontColor: "darkSlateGray",
		name: "views",
		type: "area",
		yValueFormatString: "#,##0 lượt",
		dataPoints: [
			{ x: new Date(2015, 02, 1), y: 74.4, label: "Q1-2015" },
			{ x: new Date(2015, 05, 1), y: 61.1, label: "Q2-2015" },
			{ x: new Date(2015, 08, 1), y: 47.0, label: "Q3-2015" },
			{ x: new Date(2015, 11, 1), y: 48.0, label: "Q4-2015" },
			{ x: new Date(2016, 02, 1), y: 74.8, label: "Q1-2016" },
			{ x: new Date(2016, 05, 1), y: 51.1, label: "Q2-2016" },
			{ x: new Date(2016, 08, 1), y: 40.4, label: "Q3-2016" },
			{ x: new Date(2016, 11, 1), y: 45.5, label: "Q4-2016" },
			{ x: new Date(2017, 02, 1), y: 78.3, label: "Q1-2017", indexLabel: "Highest", markerColor: "red" }
		]
	}]
});
chart.render();


</script>