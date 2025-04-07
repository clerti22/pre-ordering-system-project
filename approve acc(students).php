<?php
if($_SERVER["REQUEST_METHOD"] == "POST"){
  $id = $_POST['id'];

  include('db.php');

  $sql = "UPDATE shs_students_data set status = 'APPROVED' where id_number = $id";

  if($conn->query($sql) === TRUE){
    echo "Approved";
  }
  else{
    echo "Error";
  }
}
?>