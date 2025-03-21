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
      <div class="container" id="container">
        <h1>Edit Product</h1>
        <form action="samp1.php" method="POST" enctype="multipart/form-data" id="formID">
          <input type="hidden" name="productId" id="productId" value="<?php if (isset($_GET['idpass'])) {
                                                                        echo $_GET['idpass'];
                                                                      } ?>">
          <input type="hidden" name="sellerId" id="sellerId" value="<?php if (isset($_GET['seller'])) {
                                                                      echo $_GET['seller'];
                                                                    } ?>">
          <label for="">Product Name: </label>
          <div class="input-group input-group-sm mb-3">
            <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" name="productName" id="productName" value="<?php if (isset($_GET['pro_name'])) {
                                                                                                                                                                            echo $_GET['pro_name'];
                                                                                                                                                                          } ?>">
          </div>
          <label for="">Product Price: </label>
          <div class="input-group input-group-sm mb-3">
            <input type="number" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" name="productPrice" id="productPrice" value="<?php if (isset($_GET['pro_price'])) {
                                                                                                                                                                                echo $_GET['pro_price'];
                                                                                                                                                                              } ?>" step="any">
          </div>
          <label for="">Total Stock: </label>
          <div class="input-group input-group-sm mb-3">
            <input type="number" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" name="productStock" id="productStock" value="<?php if (isset($_GET['qty'])) {
                                                                                                                                                                                echo $_GET['qty'];
                                                                                                                                                                              } ?>">
          </div>
          <label for="">Image: </label>
          <div class="input-group input-group-sm mb-3 ">
            <input type="hidden" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" name="productImage" accept="image/*" id="hiddenImage">
            <a onclick="edit1()" class="btn btn-primary btn-sm" id="hiddenBtn" style="display: none;"><i class="bi bi-pencil-square"></i></a>
          </div>

          <?php if (isset($_GET['image'])): ?>


            <div class="input-group input-group-sm ">
              <div>
                <fieldset disabled>
                  <input type="text" id="disabledTextInput" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" placeholder="Current Image: <?php echo htmlspecialchars($_GET['image']); ?>">
              </div>

              <a onclick="edit2()" class="btn btn-primary btn-sm" id="edit2btn"><i class="bi bi-pencil-square"></i></a>
            </div>

          <?php endif; ?>


          <button class="btn btn-primary submitBtn" type="submit" name="doneBtn">Done</button>
        </form>
      </div>
    </div>
    <div class="mainConfirm" id="mainConfirm">
      <div class="bodyConf">
        <div class="bg-light p-5 text-center confM">
          <i class="bi bi-exclamation-circle"></i>
          <p>Are you sure you want to update it?</p>
          <div class="choicesBtn">
            <button onclick="yesBtn()" class="btn btn-success">Yes</button>
            <button onclick="noBtn()" class="btn btn-danger">No</button>
          </div>
        </div>

      </div>
    </div>

    <script>
      document.getElementById('formID').addEventListener("submit", function(event) {
        event.preventDefault();
        let main_confirm = document.getElementById('mainConfirm');
        main_confirm.style.visibility = 'visible';
      });
    </script>

    <script>
      let yesBtn = () => {
        let imgs = document.getElementById('hiddenImage');
        let inputType = imgs.type;
        let proID = document.getElementById('productId').value;
        let sellID = document.getElementById('sellerId').value;
        let pName = document.getElementById('productName').value;
        let pPrice = document.getElementById('productPrice').value;
        let pStock = document.getElementById('productStock').value;
        let imgFile; 
        let formData = new FormData();
        formData.append('typeInput', inputType);
        formData.append('proID', proID);
        formData.append('sellID', sellID);
        formData.append('proName', pName);
        formData.append('price', pPrice);
        formData.append('qty', pStock);

        let xhr = new XMLHttpRequest();
        xhr.open("POST", "update pro.php", true);

        xhr.onload = function() {
          if (xhr.status === 200) {
            let main_confirm = document.getElementById('mainConfirm');
            main_confirm.style.visibility = 'hidden'; 
            if (xhr.responseText === 'UPDATED') {
              console.log('Product updated successfully!');
            } else {
              console.log('Product update failed, trying to upload image...');
       
              imgFile = imgs.files[0];
           
              if (imgFile) {
                formData.append('productImage', imgFile);
              }

              let imgXhr = new XMLHttpRequest();
              imgXhr.open("POST", "update pro.php", true); 
              imgXhr.onload = function() {
                if (imgXhr.status === 200) {
                  console.log('Image uploaded successfully');
                } else {
                  console.log('Image upload failed: ' + imgXhr.status);
                }
              };
              imgXhr.send(formData); 
            }
          } else {
            console.log('Error Bro: ' + xhr.status);
          }
        };

        xhr.send(formData);
      };


      let noBtn = () => {
        let main_confirm = document.getElementById('mainConfirm');
        main_confirm.style.visibility = 'hidden';
      }
    </script>

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