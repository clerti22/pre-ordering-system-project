<?php
include('db.php');

if(isset($_GET['ids'],$_GET['seller'])){
  $id = $_GET['ids'];
  $sell_id = $_GET['seller'];

  $sql = "DELETE FROM products_datas WHERE product_id = $id";

  if($conn->query($sql)===TRUE){
    echo"<script> alert('Product Deleted Successfully'); </script>";
    header("Location: staff main.php?num=$sell_id");
    exit();
  }

}
?>