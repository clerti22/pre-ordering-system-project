<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SMCC QuickBite - Edit Product</title>
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.8.1/font/bootstrap-icons.min.css" rel="stylesheet">
  <link rel="stylesheet" href="edit product.css">
</head>

<body>

  <div class="main d-flex justify-content-center align-items-center">
    <img src="png files/smcc logo.png" alt="" height="208">
    <div class="mainBody">
      <div class="container">
        <h1>Edit Product</h1>
        <form action="samp1.php" method="POST" enctype="multipart/form-data" id="formID">
          <input type="hidden" name="productId" value="<?php if (isset($_GET['idpass'])) {
                                                          echo $_GET['idpass'];
                                                        } ?>">
          <input type="hidden" name="sellerId" value="<?php if (isset($_GET['seller'])) {
                                                        echo $_GET['seller'];
                                                      } ?>">
          <label for="">Product Name: </label>
          <div class="input-group input-group-sm mb-3">
            <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" name="productName" value="<?php if (isset($_GET['pro_name'])) {
                                                                                                                                                          echo $_GET['pro_name'];
                                                                                                                                                        } ?>">
          </div>
          <label for="">Product Price: </label>
          <div class="input-group input-group-sm mb-3">
            <input type="number" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" name="productPrice" value="<?php if (isset($_GET['pro_price'])) {
                                                                                                                                                              echo $_GET['pro_price'];
                                                                                                                                                            } ?>">
          </div>
          <label for="">Total Stock: </label>
          <div class="input-group input-group-sm mb-3">
            <input type="number" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" name="productStock" value="<?php if (isset($_GET['qty'])) {
                                                                                                                                                              echo $_GET['qty'];
                                                                                                                                                            } ?>">
          </div>
          <label for="">Image: </label>
          <div class="input-group input-group-sm mb-3 ">
            <input type="hidden" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" name="productImage" accept="image/*" id="hiddenImage">
            <a onclick="edit1()" class="btn btn-primary btn-sm" id="hiddenBtn" style="display: none;"><i class="bi bi-pencil-square"></i></a>
          </div>

          <?php if (isset($_GET['image'])): ?>


            <div class=" d-flex input-group input-group-sm ">
              <div>
                <fieldset disabled>
                  <input type="text" id="disabledTextInput" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" placeholder="Current Image: <?php echo htmlspecialchars($_GET['image']); ?>">
              </div>

              <a onclick="edit2()" class="btn btn-primary btn-sm" id="edit2btn"><i class="bi bi-pencil-square"></i></a>
            </div>

          <?php endif; ?>
         

          <button class="btn btn-primary submitBtn" type="submit" name="doneBtn">Done</button>


        </form>
<script>
    document.getElementById('formID').addEventListener("submit", function(event) {
      event.preventDefault();
      let xhr = new XMLHttpRequest();
      let inputH = document.getElementById('hiddenImage').type;
      xhr.open("POST", "samp1.php", true);

      xhr.onload = function() {
        if (xhr.status === 200) {
          console.log('Nice');
        } else {
          console.log('Error Bro: ' + xhr.status);
        }
      };

      xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

      xhr.send("data=" + encodeURIComponent(inputH));
    });
  </script>
      </div>
    </div>
    <script>
            let edit2 = () => {
              //hidden default
              let a1 = document.getElementById('hiddenImage');
              let a2 = document.getElementById('hiddenBtn');
              let b1 = document.getElementById('disabledTextInput');
              let b2 = document.getElementById('edit2btn');
              a1.type = 'file';
              a2.style.display = 'block';
              b1.type = 'hidden';
              b2.style.display = 'none';


            }

            let edit1 = () => {
              let a1 = document.getElementById('hiddenImage');
              let a2 = document.getElementById('hiddenBtn');
              let b1 = document.getElementById('disabledTextInput');
              let b2 = document.getElementById('edit2btn');
              a1.type = 'hidden';
              a2.style.display = 'none';
              b1.type = 'text';
              b2.style.display = 'block';
            }
          </script>
  </div>

  <script src="js/bootstrap.bundle.min.js"></script>
  
</body>

</html>

