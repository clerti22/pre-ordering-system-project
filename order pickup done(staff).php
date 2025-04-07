<?php
if($_SERVER["REQUEST_METHOD"] == "POST"){
  $stud_id = $_POST['studId'];
  $sell_id = $_POST['sell_id'];
  $id_row = $_POST['id_row'];
  $sellName = $_POST['seller_name'];
  $productName =$_POST['product_name'];

  include('db.php');

  $sql = "update orders_history set status = 'Ordered Retrieved' WHERE seller_id = $sell_id AND id_number = $stud_id AND id_row = $id_row;
  INSERT INTO user_notification(id_number,message)VALUES($stud_id,'Your order $productName from $sellName has been retrieved!');";
  
  
    if ($conn->multi_query($sql)) {
      // Process the result of the SELECT query
      do {
          if ($result = $conn->store_result()) {
              while ($row = $result->fetch_assoc()) {
                  echo 'Order Retrieved';  // Output the 'amount' from the SELECT query
              }
              $result->free();
          }
      } while ($conn->next_result());  // Move to the next result set
    } else {
      echo "Error: " . $conn->error;
    }
}


?>