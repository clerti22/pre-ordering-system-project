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
  <title>SMCC QuickBite - Dashboard Admin</title>
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
          <a href="#" class="sidebar-link collapsed has-dropdown" data-bs-toggle="collapse"
            data-bs-target="#auth" aria-expanded="false" aria-controls="auth">
            <i class="bi bi-people"></i>
            <span>Users Management</span>
          </a>
          <ul id="auth" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
            <li class="sidebar-item">
              <a href="student management.php" class="sidebar-link">Student</a>
            </li>
            <li class="sidebar-item">
              <a href="staff management.php" class="sidebar-link">Staff</a>
            </li>
          </ul>
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
              <span style="font-size: 1.7rem;">

                <?php
                include('db.php');

                $num1 = 0;

                $sql1 = "SELECT COUNT(*) as count_stud from shs_students_data;";
                
                $result1 = $conn->query($sql1);
              

                if($result1->num_rows > 0){
                  while($row1 = $result1->fetch_assoc()){
                    $num1 = $row1['count_stud'];
                  }
                }

                $num2 = 0;

                $sql2 = "SELECT COUNT(*) as count_staff from staff_datas;";
                
                $result2 = $conn->query($sql2);
              

                if($result2->num_rows > 0){
                  while($row2 = $result2->fetch_assoc()){
                    $num2 = $row2['count_staff'];
                  }
                }

                $sum = $num1 + $num2;

                echo $sum;

                ?>
              </span>
            </div>
          </div>
          <div class="col-md-4">
            <div class="totalUSers">
              <p>Total Verified Users</p>
              <i class="bi bi-people" style="font-size: 1.7rem;"></i>
              <span style="font-size: 1.7rem;">

              <?php
                include('db.php');

                $num1 = 0;

                $sql1 = "SELECT COUNT(*) as count_stud from shs_students_data where status = 'APPROVED';";
                
                $result1 = $conn->query($sql1);
              

                if($result1->num_rows > 0){
                  while($row1 = $result1->fetch_assoc()){
                    $num1 = $row1['count_stud'];
                  }
                }

                $num2 = 0;

                $sql2 = "SELECT COUNT(*) as count_staff from staff_datas where status_acc = 'APPROVED';";
                
                $result2 = $conn->query($sql2);
              

                if($result2->num_rows > 0){
                  while($row2 = $result2->fetch_assoc()){
                    $num2 = $row2['count_staff'];
                  }
                }

                $sum = $num1 + $num2;

                echo $sum;

                ?>
              </span>
            </div>
          </div>
          <div class="col-md-4">
            <div class="totalUSers">
              <p>Total unverified users</p>
              <i class="bi bi-people" style="font-size: 1.7rem;"></i>
              <span style="font-size: 1.7rem;">
              <?php
                include('db.php');

                $num1 = 0;

                $sql1 = "SELECT COUNT(*) as count_stud from shs_students_data where status = 'NOT APPROVED';";
                
                $result1 = $conn->query($sql1);
              

                if($result1->num_rows > 0){
                  while($row1 = $result1->fetch_assoc()){
                    $num1 = $row1['count_stud'];
                  }
                }

                $num2 = 0;

                $sql2 = "SELECT COUNT(*) as count_staff from staff_datas where status_acc = 'NOT APPROVED';";
                
                $result2 = $conn->query($sql2);
              

                if($result2->num_rows > 0){
                  while($row2 = $result2->fetch_assoc()){
                    $num2 = $row2['count_staff'];
                  }
                }

                $sum = $num1 + $num2;

                echo $sum;

                ?>
              </span>
            </div>
          </div>

        </div>
        <div class="row" style="margin-top: 2em;">
          <div class="col-md-6">
          <h3>Students Data</h3>
            <div  style="height: 70vh; width: 100%; background-color: white;">
              
            <table class="table table-striped">
                <thead>
                  <tr>
                    <th scope="col">ID Number</th>
                    <th scope="col">Name</th>
                    <th scope="col">Grade</th>
                    <th scope="col">Section</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  
                  include('db.php');

                  $sql = "SELECT * FROM shs_students_data";

                  $result = $conn->query($sql);

                  if($result->num_rows > 0){
                    while($row = $result->fetch_assoc()){
                      echo '<tr>';
                      echo '<td>'. $row['id_number'] .'</td>';
                      echo '<td>'. $row['full_name'] .'</td>';
                      echo '<td>'. $row['grade_level'] .'</td>';
                      echo '<td>'. $row['section'] .'</td>';
                      echo '</tr>';
                    }
                  }
                  
                  ?>
                  
                </tbody>
              </table>
            </div>

          </div>
          <div class="col-md-6">
          <h3>Staffs Data</h3>
            <div style="height: 70vh; width: 100%;background-color:white;">

            
            <table class="table table-striped">
                <thead>
                  <tr>
                    <th scope="col">ID Number</th>
                    <th scope="col">Name</th>
                    <th scope="col">Phone Number</th>
                    <th scope="col">Location</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  
                  include('db.php');

                  $sql = "SELECT * FROM staff_datas";

                  $result = $conn->query($sql);

                  if($result->num_rows > 0){
                    while($row = $result->fetch_assoc()){
                      echo '<tr>';
                      echo '<td>'. $row['staff_id'] .'</td>';
                      echo '<td>'. $row['name'] .'</td>';
                      echo '<td>'. $row['phone'] .'</td>';
                      echo '<td>'. $row['location'] .'</td>';
                      echo '</tr>';
                    }
                  }
                  
                  ?>
                  
                </tbody>
              </table>

            </div>

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