<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SMCC QuickBite</title>
  <link href="css\bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <link rel="stylesheet" href="student main.css">
</head>

<body>
  <header>
    <nav class="navbar navbar-expand-lg  navbars">
      <div class="container-fluid">
        <img src="png files/smcc logo.png" alt="" height="60" class="logo">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <form class="d-flex ">
            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success searchBtn" type="submit">Search</button>
          </form>
        </div>
      </div>
      <div class="collapse navbar-collapse cartI" id="navbarSupportedContent">
        <a href="add to cart page.php?num=<?php echo $_GET['num']; ?>"><i class="bi bi-cart-fill icons" id="icons"></i></a><br>
        <span style="color:white;"> 
          <?php
          include('db.php');

          if (isset($_GET['num'])) {
            $id = $_GET['num'];
             $sql = "select count(*) from carts where student_id = $id;";

             $result = $conn->query($sql);

             if($result->num_rows > 0){
              while($row = $result->fetch_assoc()){
               echo $row['count(*)'];
              }
             }
          }
         
        ?></span>
      </div>
     
      <div class="collapse navbar-collapse pfp" id="navbarSupportedContent">
        <i class="bi bi-person-circle icons"></i>
        <?php
        include('db.php');



        if (isset($_GET['num'])) {
          $idz = $_GET['num'];
          $sql = "SELECT full_name FROM shs_students_data WHERE id_number = $idz;";

          $result = $conn->query($sql);

          if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
              echo " <a style='color: white; margin-left:4px;'>" . $row['full_name'] . "</a>";
            }
          }
        }
        ?>

      </div>
      <button type="button" class="btn btn-danger">Logout</button>
    </nav>
  </header>

  <div class="main">
    <div class="mainBody">
      <div class="container-fluid">
        <h1 class="menuTxt">Menu</h1>
        <hr>
        <div class="container-fluid products">
          <div class="container contP">
            <div class="row productRow">

              <?php
              include('db.php');

              $sql = "select * from staff_datas inner join products_datas on staff_datas.staff_id = products_datas.seller_id;";
              $result = $conn->query($sql);
              $id = 1;
              if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                  $id += 1;
                  echo "<div class='col'>";
                  echo "<div class='card cardx'>";
                  echo "<img src='" . $row['product_image'] . "' class='card-img-top' alt='...' height= '300'>";
                  echo "<hr>";
                  echo "<div class='card-body'>";
                  echo "<h5 class='card-title proName'>" . $row['product_name'] . "</h5>";
                  echo " <p class='card-text proPr'>&#8369;" . $row['product_price'] . "</p>";
                  echo " <p>Seller Name: " . $row['name'] . " - " . $row['location'] . "</p>";
                  echo "<button onclick='addtoCart(" . $idz . ", \"" . addslashes($row['product_name']) . "\", " . $row['product_price'] . ", \"" . addslashes($row['product_image']) . "\", \"" . addslashes($row['name']) . "\")' class='btn btn-primary addTo'>Add to Cart</button>";

                  echo "</div>";
                  echo "</div>";
                  echo "</div>";
                }
              }
              ?>

              <script>
                function addtoCart(studentID, proName, proPrice, proImg, sellerName) {
                  let formD = new FormData();

                  formD.append('studID', studentID);
                  formD.append('prName', proName);
                  formD.append('prPrice', proPrice);
                  formD.append('prImg', proImg);
                  formD.append('sellName', sellerName);

                  let xhr = new XMLHttpRequest();

                  xhr.open("POST", "add to cart db.php", true);

                  xhr.onload = function() {
                    if (xhr.status == 200) {
                      alert(xhr.responseText);
                    } else {
                      console.log(xhr.status);
                    }
                  }
                  xhr.send(formD);
                }
              </script>
            </div>
          </div>
        </div>


        
      </div>
    </div>

  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>