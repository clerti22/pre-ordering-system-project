<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $valItem = $_POST['valueItem'];
  $id = $_POST['id'];
  include('db.php');

  $sql = "SELECT * FROM orders_history where seller_id = $id and product_name LIKE '$valItem%' ORDER BY id_row;";

  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
      if ($row['status'] == "Pending") {
        echo "<tr>";
        echo "<td><img src='" . $row['product_image'] . "' alt='' height='120' width='120'></td>";
        echo "<td>";
        echo "<span>" . $row['product_name'] . "</span><br>";
        echo "<span>Quantity: " . $row['product_qty'] . "</span><br>";
        echo "<span>Customer Name: " . $row['id_number'] . "</span><br>";
        echo "<div style='display:flex; gap:10px; flex-wrap:wrap;'>";
        echo "<button class='btn btn-success' onclick='approvedBtn(" . $id . "," . $row['id_number'] . "," . $row['id_row'] . ", \"" . addslashes($row['seller_name']) . "\",\"" . addslashes($row['product_name']) . "\")'>Order Ready</button>";
        echo "<button class='btn btn-danger'>Reject</button>";
        echo "</div>";
        echo "</td>";
        echo "<td>";
        echo "<span style='color:#FFD900;'>" . $row['status'] . "</span>";
        echo "</td>";
        echo "</tr>";
      } else if ($row['status'] == "Waiting for pickup") {
        echo "<tr>";
        echo "<td><img src='" . $row['product_image'] . "' alt='' height='120' width='120'></td>";
        echo "<td>";
        echo "<span>" . $row['product_name'] . "</span><br>";
        echo "<span>Quantity: " . $row['product_qty'] . "</span><br>";
        echo "<span>Customer Name: " . $row['id_number'] . "</span><br>";
        echo "<div style='display:flex; gap:10px; flex-wrap:wrap;'>";
        echo "<button class='btn btn-success' onclick='pickupBtn(" . $row['id_number'] . ", " . $id. "," . $row['id_row']  . ", \"" . addslashes($row['seller_name']) . "\",\"" . addslashes($row['product_name']) . "\")'>Pickup Done</button>";
        echo "<button class='btn btn-danger'>Reject</button>";
        echo "</div>";
        echo "</td>";
        echo "<td>";
        echo "<span style='color:blue;'> Waiting for pickup</span>";
        echo "</td>";
        echo "</tr>";
      } else {
        echo "<tr>";
        echo "<td><img src='" . $row['product_image'] . "' alt='' height='120' width='120'></td>";
        echo "<td>";
        echo "<span>" . $row['product_name'] . "</span><br>";
        echo "<span>Quantity: " . $row['product_qty'] . "</span><br>";
        echo "<span>Customer Name: " . $row['id_number'] . "</span><br>";
        echo "<div style='display:flex; gap:10px; flex-wrap:wrap;'>";

        echo "</div>";
        echo "</td>";
        echo "<td>";
        echo "<span style='color:green;'> Order Retrieved</span>";
        echo "</td>";
        echo "</tr>";
      }
    }
  }
}
?>