<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <link href="add tocart.css" rel="stylesheet">
  <title>SMCC QuickBite - Add to Cart</title>
</head>

<body>
  <header>
    <nav class="navbar">
      <div class="container-fluid">
        <img class="navbar-brand" src="png files\smcc logo.png" height="60">
        <div class="d-flex justify-content-center align-items-center pfp">
          <a href="order page(student).php"><i class="bi bi-bag-check" style="color:white;font-size:  2rem;" alt="go to your orders"></i></a>
          <span style="color:red;">
        <?php
        session_start();
          include('db.php');

          if (isset($_SESSION['num'])) {
            $id = $_SESSION['num'];
             $sql = "select count(*) from orders_history where id_number = $id;";

             $result = $conn->query($sql);

             if($result->num_rows > 0){
              while($row = $result->fetch_assoc()){
               echo $row['count(*)'];
              }
             }
          }
         
        ?></span>
          <a href="notification user.php"><i class="bi bi-bell" style="color:white; margin-left:25px;font-size: 2rem;" alt="go to your orders"></i></a>
          <span style="color:red;margin-right:25px;">
          <?php
          include('db.php');

          if (isset($_SESSION['num'])) {
            $id = $_SESSION['num'];
             $sql = "select count(*) from user_notification where id_number = $id;";

             $result = $conn->query($sql);

             if($result->num_rows > 0){
              while($row = $result->fetch_assoc()){
               echo $row['count(*)'];
              }
             }
          }
         
        ?>
          </span>
          <i class="bi bi-person-circle icons pfpIcon"></i>
          <a  href="profile (student).php" style="color: white; margin-left:4px;">Profile</a>
        </div>
      </div>
    </nav>
  </header>

  <div class="main">
    <div class="mainBody">
      <div class="container-fluid">
      <a href="student main.php" class="btn btn-danger">Go back to menu</a>
        <h1 style="font-size: 4rem;"><strong>Your Cart</strong></h1>
        <div class="tableSec">

          <table class="table table-striped">
            <thead>
              <tr>
                <th scope="col"></th>
                <th></th>
                <th scope="col">Product Name</th>

              </tr>
            </thead>
            <tbody>
              <?php
              if (isset($_SESSION['num'])) {
                $id = $_SESSION['num'];

                include('db.php');

                $sql = "select * from carts where student_id = $id;";

                $result = $conn->query($sql);

                $num = 0;
                if ($result->num_rows > 0) {
                  while ($row = $result->fetch_assoc()) {
                    $num += 1;
                    echo "<tr>";
                    echo "<td><button type='button' class='btn btn-danger' onclick='deleteCart(" . $row['id_row'] . ")'><i class='bi bi-trash'></i></button></td>";
                    echo " <td><img class='imgs' src='" . $row['product_img'] . "' alt='' height='90' width='140'></td>";
                    echo "<td class='detailTxt'>" . $row['product_name'] . " <br><span id='priceN" . $num . "'>&#8369; " . $row['amount'] . "</span> <br>";
                    echo "<button class='qtyBtn' onclick='addQty(" . $num . "," .  $row['product_price']  . "," . $row['qty'] . "," . $row['id_row'] . ")' >+</button><span style='margin: 5px;' id='qtyID" . $num . "'>" . $row['qty'] . "</span><button class='qtyBtn' onclick='decQty(" . $num . "," .  $row['product_price']  . "," . $row['qty'] . "," . $row['id_row'] . ")'>-</button><br>";
                    echo "<p style='font-style: italic; font-size: 10px; color: grey;''>Seller Name: " . $row['seller_name'] . "</p></td>";
                    echo "</tr>";
                  }
                }
              }
              ?>
              <input type="hidden" value="<?php echo $_SESSION['num']; ?>" id="inputID">
              <script>
                let deleteCart = (idRow) => {
                  let formD = new FormData();


                  formD.append('idRow', idRow);

                  let xhr = new XMLHttpRequest();

                  xhr.open('POST', 'delete cart.php', true);

                  xhr.onload = function() {
                    if (xhr.status == 200) {
                      console.log(xhr.responseText);
                      alert(xhr.responseText);

                    } else {
                      console.log(xhr.status);
                    }
                  }

                  xhr.send(formD);
                }
                let quantities = {};

                let addQty = (number, price, qty, idrow) => {
                  let fPrice = document.getElementById(`priceN${number}`);


                  if (!quantities[number]) {
                    quantities[number] = qty;
                  }


                  quantities[number] += 1;
                  let formD = new FormData();
                  formD.append('idRow', idrow);
                  formD.append('qty', quantities[number]);


                  let xhr = new XMLHttpRequest();
                  xhr.open('POST', 'qty.php', true);


                  xhr.onload = function() {
                    if (xhr.status == 200) {

                      fPrice.innerHTML = "&#8369; " + xhr.responseText;
                    } else {
                      console.log(xhr.status);
                    }
                  };
                  document.getElementById(`qtyID${number}`).innerHTML = quantities[number];

                  // Send the FormData
                  xhr.send(formD);

                };

                let decQty = (number, price, qty, idrow) => {
                  quantities[number] -= 1;
                  let fPrice = document.getElementById(`priceN${number}`);


                  if (!quantities[number]) {
                    quantities[number] = qty;
                  }

                  if (quantities[number] >= 1) {
                    let formD = new FormData();
                    formD.append('idRow', idrow);
                    formD.append('qty', quantities[number]);


                    let xhr = new XMLHttpRequest();
                    xhr.open('POST', 'qty.php', true);


                    xhr.onload = function() {
                      if (xhr.status == 200) {

                        fPrice.innerHTML = "&#8369; " + xhr.responseText;
                      } else {
                        console.log(xhr.status);
                      }
                    };
                    document.getElementById(`qtyID${number}`).innerHTML = quantities[number];

                    // Send the FormData
                    xhr.send(formD);

                  }
                };
              </script>

            </tbody>
          </table>
        </div>
        <div class="containers" style="border-radius: 1em;">
          <p><b>Cart totals</b></p>
          <hr>
          <table>
            <thead>
              <tr id="thz">
                <th>Total Amount</th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th><span id="totalAmtShow">&#8369;
                    <?php
                    include('db.php');

                    $sql = "select sum(amount) from carts where student_id = $id;";

                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                      while ($row = $result->fetch_assoc()) {
                        echo $row['sum(amount)'];
                      }
                    }

                    ?>
                  </span></th>
              </tr>
            </thead>
          </table>



          <div class="d-flex justify-content-center align-items-center" style="margin-top: 1em;">
            <button type="button" class="btn btn-success" id="confirmID" onclick="confirmIDs()"><i class="bi bi-bag-check" style="margin-right: 10px;"></i>Confirm Order</button>

          </div>

          <script>
            function confirmIDs() {
              let divConfirm = document.getElementById('mainConfirm');
              divConfirm.style.visibility = 'visible';

            }

            function noBtn() {
              let divConfirm = document.getElementById('mainConfirm');
              divConfirm.style.visibility = 'hidden';
            }

            function yesBtn() {
              let idNumber = document.getElementById('inputID').value;
              let divConfirm = document.getElementById('mainConfirm');
              let formD = new FormData();

              formD.append('id', idNumber);

              let xhr = new XMLHttpRequest();

              xhr.open('POST', 'order insert db.php', true);

              xhr.onload = function() {
                if (xhr.status == 200) {
                  alert('Cart ordered!')
                  console.log(xhr.responseText);
                } else {
                  console.log(xhr.status);
                }
              }

              xhr.send(formD);
              divConfirm.style.visibility = 'hidden';
              location.reload();

            }
          </script>

        </div>
      </div>
    </div>

  </div>
  <div>

  </div>

  <div class="mainConfirm" id="mainConfirm">
    <div class="bodyConf">
      <div class="bg-light p-5 text-center confM">
        <i class="bi bi-exclamation-circle"></i>
        <p>Are you sure to confirm order?</p>
        <div class="choicesBtn">
          <button onclick="yesBtn()" class="btn btn-success">Yes</button>
          <button onclick="noBtn()" class="btn btn-danger">No</button>
        </div>
      </div>

    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>


</body>

</html>