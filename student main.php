<?php
session_start();
if (!isset($_SESSION['num'])) {
  header('Location: logout student.php');
  exit();
  
}
else{
  $idz = $_SESSION['num'];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SMCC QuickBite</title>
  <link rel="stylesheet" href="css/bootstrap.min.css">
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
          <div class="d-flex searchArea">
            <input class="form-control me-2" type="text" placeholder="Search Product Name" aria-label="Search" id="searchInpt">
            <?php
            echo '<button class="btn btn-outline-success searchBtn" onclick="searchProduct('. $idz .')">Search</button>';
            ?>
          </div>
        </div>
      </div>

      <script>
        function searchProduct(id){
          let searchVal = document.getElementById('searchInpt').value;
          let divM = document.getElementById('productRow');

          let formD = new FormData();

          formD.append('searchVal',searchVal);
          formD.append('num',id);

          let xhr = new XMLHttpRequest();

          xhr.open('POST','search product(student).php',true);

          xhr.onload = () => {
            if(xhr.status == 200){
              divM.innerHTML = xhr.responseText;
            }
            else{
              console.log(xhr.status);
            }
          }
          xhr.send(formD);
        }
      </script>
      <div class="collapse navbar-collapse cartI" id="navbarSupportedContent" style="margin-left: 1em;">
        <a href="add to cart page.php"><i class="bi bi-cart icons" id="icons"></i></a><br>
        <span style="color:red;">
          <?php
          include('db.php');

            $sql = "select count(*) from carts where student_id = $idz;";

            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
              while ($row = $result->fetch_assoc()) {
                echo $row['count(*)'];
              }
            }
          

          ?></span>
        <a href="notification user.php"><i class="bi bi-bell icons" id="icons" style="margin-left: 10px;"></i></a>
        <span style="color:red;"> <?php
                                  include('db.php');

                              
                                    $sql = "select count(*) from user_notification where id_number = $idz;";

                                    $result = $conn->query($sql);

                                    if ($result->num_rows > 0) {
                                      while ($row = $result->fetch_assoc()) {
                                        echo $row['count(*)'];
                                      }
                                    }
                                  

                                  ?></span>
      

      <div class="collapse navbar-collapse pfp" id="navbarSupportedContent">
        <i class="bi bi-person-circle icons"></i>
        <a href="profile (student).php" style="text-decoration:none; margin-left:0.5em; color:white;"> Profile</a>  
        
     
        </div><br>
       
      </div>
      <a href="logout student.php" class="btn btn-danger">Logout</a>
    </nav>
  </header>

  <div class="main">
    <div class="mainBody">
      <div class="container-fluid">
        <h1 class="menuTxt">Menu</h1>
        <hr>
        <div class="container-fluid products">
          <div class="container contP">
            <div class="row productRow" id="productRow">

              <?php
              include('db.php');

              $sql = "select * from staff_datas inner join products_datas on staff_datas.staff_id = products_datas.seller_id;";
              $result = $conn->query($sql);
              $id = 1;
              if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                  $id += 1;
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
              ?>

              <script>
                function addtoCart(studentID, proName, proPrice, proImg, sellerName, seller_id) {
                  let formD = new FormData();

                  formD.append('studID', studentID);
                  formD.append('prName', proName);
                  formD.append('prPrice', proPrice);
                  formD.append('prImg', proImg);
                  formD.append('sellName', sellerName);
                  formD.append('sell_id', seller_id);

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

                  location.reload();
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