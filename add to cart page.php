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
          <i class="bi bi-person-circle icons pfpIcon"></i>
          <span style="color: white; margin-left:4px;">Profile</span>
        </div>
      </div>
    </nav>
  </header>

  <div class="main">
    <div class="mainBody">
      <div class="container-fluid">
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
              if (isset($_GET['num'])) {
                $id = $_GET['num'];

                include('db.php');

                $sql = "select * from carts where student_id = $id;";

                $result = $conn->query($sql);

                $num = 0;
                if ($result->num_rows > 0) {
                  while ($row = $result->fetch_assoc()) {
                    $num += 1;
                    echo "<tr>";
                    echo "<td><button type='button' class='btn btn-danger' onclick='deleteCart(" . $row['id_row'] . ")'><i class='bi bi-trash'></i></button></td>";
                    echo " <td><img src='" . $row['product_img'] . "' alt='' height='90' width='140'></td>";
                    echo "<td>" . $row['product_name'] . " <br><span id='priceN" . $num . "'>&#8369; " . $row['amount'] . "</span> <br>";
                    echo "<button class='qtyBtn' onclick='addQty(" . $num . "," .  $row['product_price']  . "," . $row['qty'] . "," . $row['id_row'] . ")' >+</button><span style='margin: 5px;' id='qtyID" . $num . "'>" . $row['qty'] . "</span><button class='qtyBtn' onclick='decQty(" . $num . "," .  $row['product_price']  . "," . $row['qty'] . "," . $row['id_row'] . ")'>-</button><br>";
                    echo "<p style='font-style: italic; font-size: 10px; color: grey;''>Seller Name: " . $row['seller_name'] . "</p></td>";
                    echo "</tr>";
                  }
                }
              }
              ?>

              <script>
                let num = 0;
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


                let decQty = (number, price,qty,idrow) => {
                  quantities[number] -= 1;
                  let fPrice = document.getElementById(`priceN${number}`);

          
                  if (!quantities[number]) {
                    quantities[number] = qty;
                  }

                  if(quantities[number] >= 1){
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

                if($result->num_rows > 0){
                  while($row = $result->fetch_assoc()){
                    echo $row['sum(amount)'];
                  }
                }

                ?>
              </span></th>
              </tr>
            </thead>
          </table>

          <script>
            let formD = new FormData();

            formD.append('id',)
          </script>
         
          <div class="d-flex justify-content-center align-items-center" style="margin-top: 1em;">
            <button type="button" class="btn btn-success"><i class="bi bi-bag-check" style="margin-right: 10px;"></i>Confirm Order</button>
          </div>

        </div>
      </div>
    </div>
   
  </div>

  
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>