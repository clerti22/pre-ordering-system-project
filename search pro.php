<?php
error_reporting(0);
if (isset($_POST['searchItem'],$_POST['id_num'])) {
  $itemSearch = $_POST['searchItem'];
  $sell_id = $_POST['id_num'];
  include('db.php');
  $sql = "SELECT * FROM products_datas where seller_id = $sell_id AND product_name LIKE '$itemSearch%'; ";

  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
      echo "<tr>";
      echo "<td><img src='". $row['product_image'] ."' height='120' width='120' ></td>";
      echo "<td><span>Product Name: " . $row['product_name'] . "</span><br>";
      echo "<span>Product Price:" . $row['product_price'] . "</span><br>";
      echo "<span>Quantities: " . $row['product_qty'] . "</span></td>";

      echo "<td> <a class='btn btn-primary' style='background-color: gold;  border:none; color: black; margin-right: 10px'href='edit product.php?idpass=" . $row['product_id'] . "&seller=". $id_num ."&pro_name=". $row['product_name'] ."&pro_price=". $row['product_price'] . "&qty=". $row['product_qty'] ."&image=". $row['product_image'] ." '>Edit</a><a href='delete product.php?ids= ". $row['product_id']."&seller=". $id_num ."' class='btn btn-primary deleteBtn' style='background-color:red;  border:none; color: black;'>Delete</a></td>";
      echo "</tr>";
    }
  }
  else{
    echo "<h1>No results</h1>";
  }
}
