<?php
if ($_SERVER['REQUEST_METHOD'] == "POST") {
  $value = $_POST['searchVal'];
  $idz = $_POST['num'];
  include('db.php');

  $sql = "select * from staff_datas inner join products_datas on staff_datas.staff_id = products_datas.seller_id WHERE products_datas.product_name LIKE '$value%'";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {

      echo "<div class='col-sm'>";
      echo "<div class='card cardx'>";
      echo "<img src='" . $row['product_image'] . "' class='card-img-top' alt='...' height= '300'>";
      echo "<hr>";
      echo "<div class='card-body'>";
      echo "<h5 class='card-title proName'>" . $row['product_name'] . "</h5>";
      echo " <p class='card-text proPr'>&#8369;" . $row['product_price'] . "</p>";
      echo " <p>Seller Name: " . $row['name'] . " - " . $row['location'] . "</p>";
      echo "<button onclick='addtoCart(" . $idz . ", \"" . addslashes($row['product_name']) . "\", " . $row['product_price'] . ", \"" . addslashes($row['product_image']) . "\", \"" . addslashes($row['name']) . "\", " . $row['seller_id'] . ")' class='btn btn-primary addTo'>Add to Cart</button>";

      echo "</div>";
      echo "</div>";
      echo "</div>";
    }
  }
}
