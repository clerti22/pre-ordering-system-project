<?php

if($_SERVER["REQUEST_METHOD"] == "POST"){
  $sells_id = $_POST['sell_id'];
  $studs_id = $_POST['stud_id'];
  $id_row = $_POST['id_row'];
  $sellerName = $_POST['seller_name'];
  $pro_name = $_POST['product_name'];

  include('db.php');

  $sql = "update orders_history set status = 'Waiting for pickup' WHERE seller_id = $sells_id AND id_number = $studs_id AND id_row = $id_row;
INSERT INTO user_notification(id_number,message)VALUES($studs_id,'Your order $pro_name from $sellerName is ready to pickup!,You have 1 hour and 30 minutes to retrieve it!');";


  if ($conn->multi_query($sql)) {
    // Process the result of the SELECT query
    do {
        if ($result = $conn->store_result()) {
            while ($row = $result->fetch_assoc()) {
                echo 'Order Ready';  // Output the 'amount' from the SELECT query
            }
            $result->free();
        }
    } while ($conn->next_result());  // Move to the next result set
  } else {
    echo "Error: " . $conn->error;
  }
}

?>