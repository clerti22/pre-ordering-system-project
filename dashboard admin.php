<?php

$dataPoints = array(
  array("x" => 10, "y" => 41),
  array("x" => 20, "y" => 35, "indexLabel" => "Lowest"),
  array("x" => 30, "y" => 50),
  array("x" => 40, "y" => 45),
  array("x" => 50, "y" => 52),
  array("x" => 60, "y" => 68),
  array("x" => 70, "y" => 38),
  array("x" => 80, "y" => 71, "indexLabel" => "Highest"),
  array("x" => 90, "y" => 52),
  array("x" => 100, "y" => 60),
  array("x" => 110, "y" => 36),
  array("x" => 120, "y" => 49),
  array("x" => 130, "y" => 41)
);

?>

<?php
if (isset($_GET['num'])) {
  $id_num = $_GET['num'];
} ?>

<?php

$totalVisitors = 883000;

$newVsReturningVisitorsDataPoints = array(
  array("y" => 519960, "name" => "New Visitors", "color" => "#E7823A"),
  array("y" => 363040, "name" => "Returning Visitors", "color" => "#546BC1")
);

$newVisitorsDataPoints = array(
  array("x" => 1420050600000, "y" => 33000),
  array("x" => 1422729000000, "y" => 35960),
  array("x" => 1425148200000, "y" => 42160),
  array("x" => 1427826600000, "y" => 42240),
  array("x" => 1430418600000, "y" => 43200),
  array("x" => 1433097000000, "y" => 40600),
  array("x" => 1435689000000, "y" => 42560),
  array("x" => 1438367400000, "y" => 44280),
  array("x" => 1441045800000, "y" => 44800),
  array("x" => 1443637800000, "y" => 48720),
  array("x" => 1446316200000, "y" => 50840),
  array("x" => 1448908200000, "y" => 51600)
);

$returningVisitorsDataPoints = array(
  array("x" => 1420050600000, "y" => 22000),
  array("x" => 1422729000000, "y" => 26040),
  array("x" => 1425148200000, "y" => 25840),
  array("x" => 1427826600000, "y" => 23760),
  array("x" => 1430418600000, "y" => 28800),
  array("x" => 1433097000000, "y" => 29400),
  array("x" => 1435689000000, "y" => 33440),
  array("x" => 1438367400000, "y" => 37720),
  array("x" => 1441045800000, "y" => 35200),
  array("x" => 1443637800000, "y" => 35280),
  array("x" => 1446316200000, "y" => 31160),
  array("x" => 1448908200000, "y" => 34400)
);

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SMCC QuickBite - Staff Main</title>
  <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.8.1/font/bootstrap-icons.min.css" rel="stylesheet">
  <link rel="stylesheet" href="staff main.css">

  <script>
    window.onload = function() {

      var chart = new CanvasJS.Chart("chartContainer1", {
        animationEnabled: true,
        exportEnabled: true,
        theme: "light1", // "light1", "light2", "dark1", "dark2"
        title: {
          text: "Simple Column Chart with Index Labels"
        },
        axisY: {
          includeZero: true
        },
        data: [{
          type: "column", //change type to bar, line, area, pie, etc
          //indexLabel: "{y}", //Shows y value on all Data Points
          indexLabelFontColor: "#5A5757",
          indexLabelPlacement: "outside",
          dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
        }]
      });
      chart.render();





      var totalVisitors = <?php echo $totalVisitors ?>;
      var visitorsData = {
        "New vs Returning Visitors": [{
          click: visitorsChartDrilldownHandler,
          cursor: "pointer",
          explodeOnClick: false,
          innerRadius: "75%",
          legendMarkerType: "square",
          name: "New vs Returning Visitors",
          radius: "100%",
          showInLegend: true,
          startAngle: 90,
          type: "doughnut",
          dataPoints: <?php echo json_encode($newVsReturningVisitorsDataPoints, JSON_NUMERIC_CHECK); ?>
        }],
        "New Visitors": [{
          color: "#E7823A",
          name: "New Visitors",
          type: "column",
          xValueType: "dateTime",
          dataPoints: <?php echo json_encode($newVisitorsDataPoints, JSON_NUMERIC_CHECK); ?>
        }],
        "Returning Visitors": [{
          color: "#546BC1",
          name: "Returning Visitors",
          type: "column",
          xValueType: "dateTime",
          dataPoints: <?php echo json_encode($returningVisitorsDataPoints, JSON_NUMERIC_CHECK); ?>
        }]
      };

      var newVSReturningVisitorsOptions = {
        animationEnabled: true,
        theme: "light2",
        title: {
          text: "New VS Returning Visitors"
        },
        subtitles: [{
          text: "Click on Any Segment to Drilldown",
          backgroundColor: "#2eacd1",
          fontSize: 16,
          fontColor: "white",
          padding: 5
        }],
        legend: {
          fontFamily: "calibri",
          fontSize: 14,
          itemTextFormatter: function(e) {
            return e.dataPoint.name + ": " + Math.round(e.dataPoint.y / totalVisitors * 100) + "%";
          }
        },
        data: []
      };

      var visitorsDrilldownedChartOptions = {
        animationEnabled: true,
        theme: "light2",
        axisX: {
          labelFontColor: "#717171",
          lineColor: "#a2a2a2",
          tickColor: "#a2a2a2"
        },
        axisY: {
          gridThickness: 0,
          includeZero: false,
          labelFontColor: "#717171",
          lineColor: "#a2a2a2",
          tickColor: "#a2a2a2",
          lineThickness: 1
        },
        data: []
      };

      var chart2 = new CanvasJS.Chart("chartContainer", newVSReturningVisitorsOptions);
      chart2.options.data = visitorsData["New vs Returning Visitors"];
      chart2.render();

      function visitorsChartDrilldownHandler(e) {
        chart2 = new CanvasJS.Chart("chartContainer", visitorsDrilldownedChartOptions);
        chart2.options.data = visitorsData[e.dataPoint.name];
        chart2.options.title = {
          text: e.dataPoint.name
        }
        chart2.render();
        $("#backButton").toggleClass("invisible");
      }

      $("#backButton").click(function() {
        $(this).toggleClass("invisible");
        chart2 = new CanvasJS.Chart("chartContainer", newVSReturningVisitorsOptions);
        chart2.options.data = visitorsData["New vs Returning Visitors"];
        chart2.render();
      });

    }
  </script>
</head>

<body>
  <div class="wrapper">
    <aside id="sidebar">
      <div class="d-flex">
        <button class="toggle-btn" type="button">
          <img src="png files/smcc logo.png" alt="" height="35" width="40">
        </button>
        <div class="sidebar-logo">
          <a href="#">SMCC QuickBite</a>
        </div>
      </div>
      <ul class="sidebar-nav">
        <li class="sidebar-item">
          <a href="#" class="sidebar-link">
            <i class="bi bi-grid-fill"></i>
            <span>Dashboard</span>
          </a>

        </li>

        <li class="sidebar-item">
          <a href="#" class="sidebar-link">
            <i class="bi bi-people"></i>
            <span>Users Management</span>
          </a>
        </li>

        <li class="sidebar-item">
          <a href="#" class="sidebar-link">
            <i class="bi bi-clipboard-data"></i>
            <span>Reports</span>
          </a>
        </li>
        <li class="sidebar-item">
          <a href="#" class="sidebar-link">
            <i class="lni lni-user"></i>
            <span>Profile</span>
          </a>
        </li>
      </ul>
      <div class="sidebar-footer">
        <a href="#" class="sidebar-link">
          <i class="lni lni-exit"></i>
          <span>Logout</span>
        </a>
      </div>
    </aside>
    <div class="main p-3">
      <div>
        <h1 style="font-size: 2.3rem;">
          Dashboard
        </h1>
      </div>
      <div class="container-fluid">
        <div class="row" style="margin-top:1em; margin-bottom:1em;">
          <div class="col-md-4">
            <div class="totalUSers">
              <p>Total Users</p>
              <i class="bi bi-people" style="font-size: 1.7rem;"></i>
              <span style="font-size: 1.7rem;">141</span>
            </div>
          </div>
          <div class="col-md-4">
            <div class="totalUSers">
              <p>Total Verified Users</p>
              <i class="bi bi-people" style="font-size: 1.7rem;"></i>
              <span style="font-size: 1.7rem;">120</span>
            </div>
          </div>
          <div class="col-md-4">
            <div class="totalUSers">
              <p>Total unverified users</p>
              <i class="bi bi-people" style="font-size: 1.7rem;"></i>
              <span style="font-size: 1.7rem;">21</span>
            </div>
          </div>

        </div>
        <div class="row" style="margin-top: 2em;">
          <div class="col-md-6" >
            <div id="chartContainer1" style="height: 70vh; width: 100%;"></div>

          </div>
          <div class="col-md-6" >
            <div id="chartContainer" style="height: 70vh; width: 100%;"></div>

          </div>
        </div>

        <div class="row"></div>
      </div>

    </div>
  </div>
  <script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
    crossorigin="anonymous"></script>
  <script src="script.js"></script>
</body>

</html>