<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $id = $_POST['idRow'];
  $qty = $_POST['qty'];

  include('db.php');

  // Prepare the SQL queries
  $sql =  "UPDATE carts SET qty = $qty WHERE id_row = $id;
           UPDATE carts SET amount = product_price * qty WHERE id_row = $id;
           SELECT amount FROM carts WHERE id_row = $id;";

  // Execute multiple queries
  if ($conn->multi_query($sql)) {
      // Process the result of the SELECT query
      do {
          if ($result = $conn->store_result()) {
              while ($row = $result->fetch_assoc()) {
                  echo $row['amount'];  // Output the 'amount' from the SELECT query
              }
              $result->free();
          }
      } while ($conn->next_result());  // Move to the next result set
  } else {
      echo "Error: " . $conn->error;
  }
}



?>