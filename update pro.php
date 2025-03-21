<?php
error_reporting(0);
if ($_SERVER["REQUEST_METHOD"] == 'POST') {

  $type  = $_POST['typeInput'];
  $prodId  = $_POST['proID'];
  $sellId  = $_POST['sellID'];
  $product_N  = $_POST['proName'];
  $product_P  = $_POST['price'];
  $product_QTY  = $_POST['qty'];
  $img = $_FILES["productImage"];


  if ($type === 'hidden') {
    include('db.php');
    $sql = "UPDATE products_datas SET product_name = '$product_N', product_price = $product_P,product_qty = $product_QTY WHERE product_id = $prodId AND seller_id = $sellId;";
    if ($conn->query($sql) === TRUE) {
      echo "UPDATED";
    }
  } else {
    include('db.php');
    $target_dir = "uploads/";
    $target_file = $target_dir . basename( $img["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    
    $check = getimagesize ($img["tmp_name"]);
    if ($check === false) {
      echo "File is not an image.";
      $uploadOk = 0;
    }

  
    if ( $img["size"] > 10485760) {
      echo "Sorry, your file is too large.";
      $uploadOk = 0;
    }

    if (!in_array($imageFileType, ['jpg', 'jpeg', 'png', 'gif'])) {
      echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
      $uploadOk = 0;
    }

 
    if ($uploadOk === 0) {
      echo "Sorry, your file was not uploaded.";
    } else {
      if (move_uploaded_file($img["tmp_name"], $target_file)) {
        
        $sql = "UPDATE products_datas SET product_name = '$product_N', product_price = $product_P,product_qty = $product_QTY, product_image = '$target_file' WHERE product_id = $prodId AND seller_id = $sellId;";

        if($conn->query($sql) === TRUE){
          echo "UPDATED!";
        }
      } else {
        echo "Sorry, there was an error uploading your file.";
      }
    }

  }
  
} else {
  echo "No data received.";
}
