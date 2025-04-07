<?php
if($_SERVER["REQUEST_METHOD"] == "POST"){
  include('db.php');

  $idNum = $_POST['studID'];
  $prName = $_POST['prName'];
  $prPrice= $_POST['prPrice'];
  $prImg = $_POST['prImg'];
  $sellName = $_POST['sellName'];
  $seller_id = $_POST['sell_id'];


  $sql = "INSERT INTO carts(student_id,product_name,product_price,qty,amount,product_img,seller_name,seller_id)VALUES($idNum,'$prName',$prPrice,1,$prPrice,'$prImg','$sellName',$seller_id);";

  if($conn->query($sql) == TRUE){
    echo "Added to cart";
  }
  else{
    echo "Error";
  }
}
?>