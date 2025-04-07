<?php

if($_SERVER["REQUEST_METHOD"] == "POST"){
  $id = $_POST['id'];

  include('db.php');

  $sql = "INSERT INTO orders_history(id_number,product_name,product_price,product_qty,amount,product_image,seller_name,seller_id)
  SELECT student_id,product_name,product_price,qty,amount,product_img,seller_name,seller_id from carts WHERE student_id = $id; 
  INSERT INTO user_notification(id_number,message)VALUES($id,'Your order is being prepared, the sellers will update you again if your order is ready,Please wait.');
  DELETE from carts where student_id = $id;";

if ($conn->multi_query($sql)) {
  // Process the result of the SELECT query
  do {
      if ($result = $conn->store_result()) {
          while ($row = $result->fetch_assoc()) {
              echo 'Cart ordered';  // Output the 'amount' from the SELECT query
          }
          $result->free();
      }
  } while ($conn->next_result());  // Move to the next result set
} else {
  echo "Error: " . $conn->error;
}
}


?>