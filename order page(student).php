<?php

if (isset($_GET['num'])) {
  $id = $_GET['num'];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <link href="add tocart.css" rel="stylesheet">
  <title>SMCC QuickBite - Add to Cart</title>
</head>

<body>
  <header>
    <nav class="navbar">
      <div class="container-fluid">
        <img class="navbar-brand" src="png files\smcc logo.png" height="60">
        <div class="d-flex justify-content-center align-items-center pfp">
          <div style="margin-right: 20px;">
            <a href="add to cart page.php?num=<?php echo $id ?>"><i class="bi bi-cart" style="color: white;font-size:1.7rem;"></i></a>
            <span style="color: red;"><?php
                                      include('db.php');

                                      if (isset($_GET['num'])) {
                                        $id = $_GET['num'];
                                        $sql = "select count(*) from carts where student_id = $id;";

                                        $result = $conn->query($sql);

                                        if ($result->num_rows > 0) {
                                          while ($row = $result->fetch_assoc()) {
                                            echo $row['count(*)'];
                                          }
                                        }
                                      }

                                      ?></span>
            <a href="notification user.php?num=<?php echo $id ?>"><i class="bi bi-bell" style="color: white;font-size:1.7rem;"></i></a>
            <span style="color: red;"><?php
                                      include('db.php');

                                      if (isset($_GET['num'])) {
                                        $id = $_GET['num'];
                                        $sql = "select count(*) from user_notification where id_number = $id;";

                                        $result = $conn->query($sql);

                                        if ($result->num_rows > 0) {
                                          while ($row = $result->fetch_assoc()) {
                                            echo $row['count(*)'];
                                          }
                                        }
                                      }

                                      ?></span>
          </div>
          <i class="bi bi-person-circle icons pfpIcon"></i>
          <a href="profile (student).php?id=<?php echo $id ?>" style="color: white; margin-left:4px;">Profile</a>
        </div>
      </div>
    </nav>
  </header>

  <div class="main">
    <div class="mainBody">
      <div class="container-fluid">

        <button type="button" class="btn btn-danger">Go back to menu</button>
        <h1 style="font-size: 4rem;"><strong>Your Orders</strong></h1>
        <div class="tableSec">
          <table class="table table-striped">
            <thead>
              <tr>
                <th scope="col"></th>
                <th></th>
                <th scope="col">Product Name</th>
                <th scope="col">Status</th>

              </tr>
            </thead>
            <tbody>


              <!-- 
              <tr>
                <td></td>
                <td><img src="png files\smcc logo.png" alt='' height='130' width='120'></td>
                <td><span>Burger</span><br><span id='priceN" . $num . "'>&#8369; 20.00</span>
                  <br><span id='priceN" . $num . "'>Quantity: 3</span> <br>
                  <span style='font-style: italic; font-size: 10px; color: grey;'>Seller Name: SMCC </span><br>
                  <span style='font-style: italic; font-size: 10px; color: grey;'> Date Ordered: 3/26/25 </span>
                </td>
                <td><span style="color:#2B33C6;font-weight:bold;">Ready to Pickup</span><br>
                  <span style="color:red;">1:30:00 Left</span>
                </td>
              </tr>

              <tr>
                <td></td>
                <td><img src="png files\smcc logo.png" alt='' height='130' width='120'></td>
                <td><span>Burger</span><br><span id='priceN" . $num . "'>&#8369; 20.00</span>
                  <br><span id='priceN" . $num . "'>Quantity: 3</span> <br>
                  <span style='font-style: italic; font-size: 10px; color: grey;'>Seller Name: SMCC </span><br>
                  <span style='font-style: italic; font-size: 10px; color: grey;'> Date Ordered: 3/26/25 </span>
                </td>
                <td><span style="color:green;font-weight:bold;">Completed</span><br>
                 
                </td>
              </tr> -->

              <?php
              if (isset($_GET['num'])) {
                $id = $_GET['num'];

                include('db.php');

                $sql = "SELECT 
                        id_row,
                        id_number,
                        product_name,
                        product_price,
                        product_qty,
                        amount,
                        product_image,
                        seller_name,
                        seller_id,
                        status,
                        DATE_FORMAT(created_at, '%M %d, %Y') AS formatted_date
                        FROM orders_history WHERE id_number = $id  ORDER BY id_row DESC;
                    ";

                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                  while ($row = $result->fetch_assoc()) {
                    if ($row['status'] === "Pending") {
                      echo "<tr>";
                      echo "<td></td>";
                      echo "<td><img src='" . $row['product_image'] . "' alt='' height='130' width='120'></td>";
                      echo " <td><span>" . $row['product_name'] . "</span><br><span>&#8369; " . $row['amount'] . "</span>";
                      echo " <br><span >Quantity: " . $row['product_qty'] . "</span> <br>";
                      echo "  <span style='font-style: italic; font-size: 10px; color: grey;'>Seller Name: " . $row['seller_name'] . " </span><br>";
                      echo " <span style='font-style: italic; font-size: 10px; color: grey;'> Date Ordered: ". $row['formatted_date']  ." </span>";
                      echo "</td>";
                      echo " <td><span style='color:#FFD900;font-weight:bold;'>Pending</span><br>
                </td>";
                    } else if ($row['status'] == "Waiting for pickup") {
                      echo "<tr>";
                      echo "<td></td>";
                      echo "<td><img src='" . $row['product_image'] . "' alt='' height='130' width='120'></td>";
                      echo " <td><span>" . $row['product_name'] . "</span><br><span>&#8369; " . $row['amount'] . "</span>";
                      echo " <br><span >Quantity: " . $row['product_qty'] . "</span> <br>";
                      echo "  <span style='font-style: italic; font-size: 10px; color: grey;'>Seller Name: " . $row['seller_name'] . " </span><br>";
                      echo " <span style='font-style: italic; font-size: 10px; color: grey;'> Date Ordered: 3/26/25 </span>";
                      echo "</td>";
                      echo " <td><span style='color:blue;font-weight:bold;'>Waiting for pickup</span><br>";
                      echo "</td>";
                    }
                    else{
                      echo "<tr>";
                      echo "<td></td>";
                      echo "<td><img src='" . $row['product_image'] . "' alt='' height='130' width='120'></td>";
                      echo " <td><span>" . $row['product_name'] . "</span><br><span>&#8369; " . $row['amount'] . "</span>";
                      echo " <br><span >Quantity: " . $row['product_qty'] . "</span> <br>";
                      echo "  <span style='font-style: italic; font-size: 10px; color: grey;'>Seller Name: " . $row['seller_name'] . " </span><br>";
                      echo " <span style='font-style: italic; font-size: 10px; color: grey;'> Date Ordered: ". $row['formatted_date']  ." </span>";
                      echo "</td>";
                      echo " <td><span style='color:green;font-weight:bold;'>Order Retrieved</span><br>
                </td>";
                    }
                  }
                }
              }
              ?>
              </tr>
            </tbody>
          </table>
        </div>




      </div>
    </div>
  </div>

  </div>


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>