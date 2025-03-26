<?php
if($_SERVER["REQUEST_METHOD"] == "POST"){
  $id_row = $_POST['idRow'];
  include('db.php');

  $sql = "DELETE FROM carts WHERE id_row = $id_row";

  if($conn->query($sql) === TRUE){
    echo "Cart Deleted";
  }
}

?>