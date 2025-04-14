<?php
session_start();
if (!isset($_SESSION['num'])) {
  header('Location: logout.php');
  exit();
 
} 
else{
  $id_num = $_SESSION['num'];
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
          <a href="dashboard staff.php?" class="sidebar-link">
            <i class="bi bi-grid-fill"></i>
            <span>Dashboard</span>
          </a>

        </li>

        <li class="sidebar-item">
          <a href="#" class="sidebar-link">
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
      <div class="text-center">
        <h1 style="font-size: 2.3rem;">
          All your Products
        </h1>
      </div>
      <div class="searchArea">
        <input type="text" id="searchInpt" name="searchInpt" class="inptSearch" placeholder="Search Product">
        <input type="hidden" id="idSeller" name="searchInpt" class="inptSearch" value="<?php echo $id_num ?>">
        <button class="btn btn-outline-success searchBtn" id="searchBtn">Search</button>

        <a href="add_product.php?id=<?php echo urlencode($id_num); ?>" class="addBtn btn btn-primary">Add Product</a>
      </div>
      <script>
        document.getElementById('searchBtn').addEventListener("click", function() {
          let staff_id = document.getElementById('idSeller').value;
          let searchBar = document.getElementById('searchInpt').value;
          let table = document.getElementById('tableSec');
          let formD = new FormData();


          formD.append('searchItem', searchBar);
          formD.append('id_num', staff_id);
          let xhr = new XMLHttpRequest();

          xhr.open("POST", "search pro.php", true);

          xhr.onload = function() {
            if (xhr.status == 200) {
              table.innerHTML = xhr.responseText;
              console.log('Data Sent\nProcessing...');

            } else {
              console.log(xhr.status);
            }
          }


          xhr.send(formD);
        });
      </script>
      <article class="tableSec">
        <table class="table table-striped" style="background-color: white;">
          <thead>
            <tr>
              <th scope="col"></th>
              <th scope="col">Product Details</th>
              <th scope="col"></th>

            </tr>
          </thead>
          <tbody id="tableSec">

            <?php
            include('db.php');

           
            $sql = "SELECT product_id,product_name,product_price,product_qty,product_image from products_datas WHERE seller_id = $id_num";

            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
              while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td><img src='" . $row['product_image'] . "' height='120' width='120' ></td>";
                echo "<td><span>Product Name: " . $row['product_name'] . "</span><br>";
                echo "<span>Product Price: " . $row['product_price'] . "</span><br>";
                echo "<span>Quantity: " . $row['product_qty'] . "</span></td>";

                echo "<td> <a class='btn btn-primary' style='background-color: gold;  border:none; color: black; margin-right: 10px'href='edit product.php?idpass=" . $row['product_id'] . "&seller=" . $id_num . "&pro_name=" . $row['product_name'] . "&pro_price=" . $row['product_price'] . "&qty=" . $row['product_qty'] . "&image=" . $row['product_image'] . " '>Edit</a><a href='delete product.php?ids= " . $row['product_id'] . "&seller=" . $id_num . "' class='btn btn-primary deleteBtn' style='background-color:red;  border:none; color: black;'>Delete</a></td>";
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
  <script>
    function showAttachment(src) {
      document.getElementById('attachmentImage').src = src;
      console.log(src);
      document.querySelector('.showPicture').style.display = 'block';
    }

    function hideAttachment() {
      document.querySelector('.showPicture').style.display = 'none';
    }
  </script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
    crossorigin="anonymous"></script>
  <script src="script.js"></script>
</body>

</html>