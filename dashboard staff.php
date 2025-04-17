
<?php
session_start();
if(!isset($_SESSION['num'])){
 header('Location: logout.php');
 exit();

}else{
  $id_num = $_SESSION['num'];
  include('db.php');

  $sql = "SELECT 
           product_name,
            COUNT(*) as count 
        FROM orders_history
        WHERE seller_id = $id_num
        GROUP BY product_name";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
      $dataPoints[] = array("y" => $row['count'],"indexLabel" => $row['product_name']);
    }
  }
}

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
          text: "Your most ordered products"
        },
        axisY: {
          includeZero: true
        },
        data: [{
          type: "column", // Change type to bar, line, area, pie, etc.
          indexLabelFontColor: "#5A5757",
          indexLabelPlacement: "outside",
          dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
        }]
      });
      chart.render();
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
          <a href="staff main.php?" class="sidebar-link">
            <i class="bi bi-box-seam"></i>
            <span>Your Products</span>
          </a>
        </li>
        <li class="sidebar-item">
          <a href="orders staff.php" class="sidebar-link">
            <i class="bi bi-cart"></i>
            <span>Orders</span>
          </a>
        </li>
        <li class="sidebar-item">
          <a href="profile (staff).php" class="sidebar-link">
            <i class="lni lni-user"></i>
            <span>Profile</span>
          </a>
        </li>
      </ul>
      <div class="sidebar-footer">
        <a href="logout.php" class="sidebar-link">
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
        <div class="row">
          <div class="col-md-4">
            <div class="totalUSers">
              <p>Total Income</p>
              <i class="bi bi-cash-stack" style="font-size: 1.7rem;"></i>
              <span style="font-size: 1.7rem;">&#8369;
                <?php
                include('db.php');

                $sql = "SELECT SUM(amount) from orders_history where seller_id = $id_num";

                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                  while ($row = $result->fetch_assoc()) {
                    echo $row['SUM(amount)'];
                  }
                }

                ?>
              </span>
            </div>
          </div>
          <div class="col-md-4">
            <div class="totalUSers">
              <p>Total Products</p>
              <i class="bi bi-box-seam" style="font-size: 1.7rem;"></i>
              <span style="font-size: 1.7rem;"> <?php
                                                include('db.php');

                                                $sql = "SELECT COUNT(*) from products_datas where seller_id = $id_num";

                                                $result = $conn->query($sql);

                                                if ($result->num_rows > 0) {
                                                  while ($row = $result->fetch_assoc()) {
                                                    echo $row['COUNT(*)'];
                                                  }
                                                }

                                                ?></span>
            </div>
          </div>
          <div class="col-md-4">
            <div class="totalUSers">
              <p>Average Income</p>
              <i class="bi bi-cash-stack" style="font-size: 1.7rem;"></i>
              <span style="font-size: 1.7rem;">&#8369;
                <?php
                include('db.php');

                $sql = "SELECT  FORMAT(AVG(amount), 2) AS average_amount from orders_history where seller_id = $id_num";

                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                  while ($row = $result->fetch_assoc()) {
                    echo $row['average_amount'];
                  }
                }

                ?></span>
            </div>
          </div>

        </div>
        <div class="row" style="margin-top: 2em;">
          <div class="col-md">
            <div id="chartContainer1" style="height: 30vh; width: 100%;"></div>
            <div class="table-container">
            <table class="table table-striped" style="background-color: white; margin-top:1.5em;">
              <h2>Recent Orders</h2>
              <thead>
                <tr>
                  <th scope="col">Product Name</th>
                  <th scope="col">Buyer name</th>
                </tr>
              </thead>
              <tbody>
                <?php
                include('db.php');

                $sql = "SELECT * FROM orders_history INNER JOIN shs_students_data ON orders_history.id_number = shs_students_data.id_number 
                WHERE orders_history.seller_id = $id_num ORDER BY orders_history.id_row DESC;";

                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                  while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['product_name'] . "</td>";
                    echo "<td>" . $row['full_name'] . "</td>";
                    echo "</tr>";
                  }
                }
                ?>
              </tbody>
            </table>
            </div>
            
          </div>
          
        </div>

      
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