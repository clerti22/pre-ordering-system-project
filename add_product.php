<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SMCC QuickBite - Add Product</title>
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.8.1/font/bootstrap-icons.min.css" rel="stylesheet">
  <link rel="stylesheet" href="add_product.css">
</head>

<body>


  <div class="main d-flex justify-content-center align-items-center">
    <img src="png files/smcc logo.png" alt="" height="208">
    <div class="mainBody">
      <div class="container">
        <h1>Add Product</h1>
        <form action="add_product.php" method="POST" enctype="multipart/form-data">
          <input type="hidden" name="productId" value="<?php


                                                        if (isset($_GET['id'])) {
                                                          $id_n = $_GET['id'];
                                                        } else {
                                                          $id_n = null;
                                                        }
                                                        echo htmlspecialchars($id_n); ?>">
          <label for="">Product Name: </label>
          <div class="input-group input-group-sm mb-3">
            <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" name="productName" required>
          </div>
          <label for="">Product Price: </label>
          <div class="input-group input-group-sm mb-3">
            <input type="number" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" name="productPrice" required>
          </div>
          <label for="">Total Stock: </label>
          <div class="input-group input-group-sm mb-3">
            <input type="number" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" name="productStock" required>
          </div>
          <label for="">Image: </label>
          <div class="input-group input-group-sm mb-3">
            <input type="file" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" name="productImage" accept="image/*" required>
          </div>

          <input class="btn btn-primary submitBtn" type="submit" value="Done" name="doneBtn">



        </form>
      </div>
    </div>

  </div>

  <script src="js/bootstrap.bundle.min.js"></script>
</body>

</html>


<?php
error_reporting(0);

if (isset($_POST['doneBtn'])) {
  $id_n = $_POST['productId'];
  $pro_name = $_POST['productName'];
  $pro_price = $_POST['productPrice'];
  $pro_stk = $_POST['productStock'];

  include('db.php');


  // File upload handling
  $target_dir = "uploads/";
  $target_file = $target_dir . basename($_FILES["productImage"]["name"]);
  $uploadOk = 1;
  $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

  // Check if file is an actual image
  $check = getimagesize($_FILES["productImage"]["tmp_name"]);
  if ($check === false) {
    echo "File is not an image.";
    $uploadOk = 0;
  }

  // Check file size
  if ($_FILES["productImage"]["size"] > 10485760) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
  }

  // Allow certain file formats
  if (!in_array($imageFileType, ['jpg', 'jpeg', 'png', 'gif'])) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
  }

  // Check if $uploadOk is set to 0 by an error
  if ($uploadOk === 0) {
    echo "Sorry, your file was not uploaded.";
  } else {
    if (move_uploaded_file($_FILES["productImage"]["tmp_name"], $target_file)) {

      $sql = "INSERT INTO products_datas(seller_id,product_name,product_price,product_qty,product_image)VALUES($id_n,'$pro_name',$pro_price,$pro_stk,'$target_file');";

      if ($conn->query($sql) === TRUE) {
        echo "<script> console.log('Inserted Successfully'); </script>";
        header("Location: staff main.php?num=$id_n");
        exit();
      }
    } else {
      echo "Sorry, there was an error uploading your file.";
    }
  }
}


?>