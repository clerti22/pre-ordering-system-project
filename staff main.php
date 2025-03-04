<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SMCC QuickBite - Canteen Staff Main Page</title>
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.8.1/font/bootstrap-icons.min.css" rel="stylesheet">
  <link rel="stylesheet" href="staff main.css">

</head>

<body>

  <div class="sidebar">
    <p><img src="png files/smcc logo.png" alt="" height="50" width="50"> <span class="smccText">SMCC QuickBite</span></p>
    <nav class="nav flex-column">

      <hr>
      <a class="nav-link" href="#">
        <span class="icon"><i class="bi bi-box-seam"></i></span>
        <span class="description">Your Products</span>
      </a>
      <hr>

      <a class="nav-link" href="#">
        <span class="icon"><i class="bi bi-cart3"></i></span>
        <span class="description">Orders</span>
      </a>
      <hr>

      <a class="nav-link" href="#">
        <span class="icon"><i class="bi bi-people"></i></span>
        <span class="description">Customers Management</span>
      </a>
      <hr>

      <a class="nav-link" href="#">
        <span class="icon"><i class="bi bi-clipboard-data"></i></span>
        <span class="description">Reports</span>
      </a>
      <hr>

    </nav>
  </div>


  <div class="main">
    <nav class="navbar">
      <div class="container-fluid">
        <a class="navbar-brand" href="#">
          <i class="bi bi-person-circle"></i>

          <?php
          $servername = "127.0.0.1:3307";
          $username = "root";
          $password = "";
          $dbname = "smcc_quickbiteDB";

          $conn = new mysqli($servername, $username, $password, $dbname);


          if ($conn->connect_error) {
            die("Error Connection");
          } else {
            if (isset($_GET['num'])) {
              $id_num = $_GET['num'];

              $sql = "SELECT name FROM staff_datas WHERE staff_id = '$id_num'";

              $result = $conn->query($sql);


              if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                  $nameF = $row["name"];
                  echo "$nameF";
                }
              }
            }
          }
          ?>

        </a>
      </div>
    </nav>
    <div class="mainBody">
      <div class="container-fluid">
        <h3 class="headText">All Your Products</h3>
        <div class="searchArea">
          <input type="text">
          <button class="searchBtn">Search</button>

          <a href="add_product.php?id=<?php echo urlencode($id_num); ?>" class="addBtn">Add Product</a>


        </div>


        <article class="tableSec">
          <table class="table table-striped">
            <thead>
              <tr>
                <th scope="col">Product ID</th>
                <th scope="col">Product Name</th>
                <th scope="col">Product Price</th>
                <th scope="col">Product Quantity</th>
                <th scope="col">Product Image</th>
                <th scope="col">Actions</th>
              </tr>
            </thead>
            <tbody>

              <?php
              include('db.php');


              $sql = "SELECT product_id,product_name,product_price,product_qty,product_image from products_datas WHERE seller_id = $id_num";

              $result = $conn->query($sql);

              if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                  echo "<tr>";
                  echo "<td> " . $row['product_id'] . "</td>";
                  echo "<td> " . $row['product_name'] . "</td>";
                  echo "<td> " . $row['product_price'] . "</td>";
                  echo "<td> " . $row['product_qty'] . "</td>";
                  echo "<td> <button onclick=\"showAttachment('" . $row['product_image'] . "')\" class='btn btn-primary'><i class='bi bi-eye'></i> Show Picture</button> </td>";
                  echo "<td> <a class='btn btn-primary' style='background-color: gold;  border:none; color: black; margin-right: 10px'>Edit</a><a href='delete product.php?ids= ". $row['product_id']."&seller=". $id_num ."' class='btn btn-primary deleteBtn' style='background-color:red;  border:none; color: black;'>Delete</a></td>";
                  echo "</tr>";
                }
              }

              ?>
            </tbody>
          </table>

          
          <div class="showPicture" style="display: none; position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); background: white; padding: 20px; box-shadow: 0 0 10px rgba(0,0,0,0.5);">
            <img id="attachmentImage" src="" alt="Attachment" style="max-width: 500px; max-height: 500px;">
            <button onclick="hideAttachment()" style="display: block; margin: 20px auto 0; padding: 10px 20px; background: #13004A; color: white; border: none; border-radius: 5px;">Close</button>
          </div>
        </article>

      </div>
    </div>
  </div>

  <script src="js/bootstrap.bundle.min.js"></script>
  <script>
    function showAttachment(src) {
        document.getElementById('attachmentImage').src = src;
        document.querySelector('.showPicture').style.display = 'block';
    }

    function hideAttachment() {
        document.querySelector('.showPicture').style.display = 'none';
    }
  </script>

</body>

</html>