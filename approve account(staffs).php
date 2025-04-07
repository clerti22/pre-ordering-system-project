<?php

if($_SERVER["REQUEST_METHOD"] == "POST"){
  $id = $_POST['id'];

  include('db.php');

  $sql = "UPDATE staff_datas set status_acc = 'APPROVED' where staff_id = $id";

  if($conn->query($sql) === TRUE){
    echo "APPROVED account";
  }
  else{
    echo "Error approving";
  }
}

?>