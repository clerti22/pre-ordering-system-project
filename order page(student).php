<?php
session_start();
if (isset($_SESSION['num'])) {
  $id = $_SESSION['num'];
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
            <a href="add to cart page.php"><i class="bi bi-cart" style="color: white;font-size:1.7rem;"></i></a>
            <span style="color: red;"><?php
                                      include('db.php');


                                      $sql = "select count(*) from carts where student_id = $id;";

                                      $result = $conn->query($sql);

                                      if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                          echo $row['count(*)'];
                                        }
                                      }


                                      ?></span>
            <a href="notification user.php"><i class="bi bi-bell" style="color: white;font-size:1.7rem;"></i></a>
            <span style="color: red;"><?php
                                      include('db.php');


                                      $sql = "select count(*) from user_notification where id_number = $id;";

                                      $result = $conn->query($sql);

                                      if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                          echo $row['count(*)'];
                                        }
                                      }


                                      ?></span>
          </div>
          <i class="bi bi-person-circle icons pfpIcon"></i>
          <a href="profile (student).php" style="color: white; margin-left:4px;">Profile</a>
        </div>
      </div>
    </nav>
  </header>

  <div class="main">
    <div class="mainBody">
      <div class="container-fluid">

        <a href="student main.php" class="btn btn-danger">Go back to menu</a>
        <h1 style="font-size: 4rem;"><strong>Your Orders</strong></h1>
        <div class="tableSec">
          <table class="table table-striped">
            <thead>
              <tr>
                <th scope="col" class="headC"></th>
                <th></th>
                <th scope="col" class="headC">Product Name</th>
                <th scope="col" class="headC">Status</th>

              </tr>
            </thead>
            <tbody>

              <!-- this displays the ordered items from the student, it has conditional statement to check if status its pending,waiting for pickup or order retrieved -->
              <?php


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
                    echo " <span style='font-style: italic; font-size: 10px; color: grey;'> Date Ordered: " . $row['formatted_date']  . " </span>";
                    echo "</td>";
                    echo " <td><span style='color:orange;font-weight:bold;' class='status'>Pending</span><br>
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
                    echo " <td><span style='color:blue;font-weight:bold;' class='status'>Waiting for pickup</span><br>";
                    echo "</td>";
                  } else {
                    echo "<tr>";
                    echo "<td></td>";
                    echo "<td><img src='" . $row['product_image'] . "' alt='' height='130' width='120'></td>";
                    echo " <td><span>" . $row['product_name'] . "</span><br><span>&#8369; " . $row['amount'] . "</span>";
                    echo " <br><span >Quantity: " . $row['product_qty'] . "</span> <br>";
                    echo "  <span style='font-style: italic; font-size: 10px; color: grey;'>Seller Name: " . $row['seller_name'] . " </span><br>";
                    echo " <span style='font-style: italic; font-size: 10px; color: grey;'> Date Ordered: " . $row['formatted_date']  . " </span>";
                    echo "</td>";
                    echo " <td><span style='color:green;font-weight:bold;' class='status'>Order Retrieved</span><br>
                </td>";
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