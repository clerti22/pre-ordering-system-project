<?php
session_start();
if(isset($_SESSION['num'])){
  $id = $_SESSION['num'];
  $email = $_POST['emailInpt'];
  $name = $_POST['nameInpt'];
  $address = $_POST['addInpt'];
  $gender = $_POST['genderInpt'];
  $phone = $_POST['phoneInpt'];
  $location = $_POST['locationInpt'];

  include('db.php');

  $sql = "UPDATE staff_datas set email = '$email',name = '$name',address = '$address',gender = '$gender',phone='$phone',location ='$location' WHERE staff_id = $id";

  if($conn->query($sql) === TRUE){
    header('Location: staff main.php');
    exit();

  }
  else{
    echo $conn->error;
  }

}

?>