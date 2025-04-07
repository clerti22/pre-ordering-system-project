<?php
if (isset($_GET['id'])) {
  $id_num = $_GET['id'];
} ?>

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
          <a href="staff main.php?num=<?php echo $id_num ?>" class="sidebar-link">
            <i class="bi bi-box-seam"></i>
            <span>Your Products</span>
          </a>
        </li>
        <li class="sidebar-item">
          <a href="orders staff.php?id=<?php echo $id_num ?>" class="sidebar-link">
            <i class="bi bi-cart"></i>
            <span>Orders</span>
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
        <a href="staff_login.php" class="sidebar-link">
          <i class="lni lni-exit"></i>
          <span>Logout</span>
        </a>
      </div>
    </aside>
    <div class="main p-3">
      <div>
        <h1 style="font-size: 3rem; margin-top:1.3em;" class="text-center">
          Profile Status
        </h1>
      </div>


      <div class="container">
        <?php
        include('db.php');

        $sql = "SELECT * FROM staff_datas where staff_id = $id_num;";

        $result = $conn->query($sql);

        if($result->num_rows > 0 ){
          while($row = $result->fetch_assoc()){
           
            
          }
        }
        
        ?>        

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