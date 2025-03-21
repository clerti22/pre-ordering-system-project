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
        <div class="tableSec" >
          <table class="table table-striped" >
            <thead>
              <tr>
                <th scope="col"></th>
                <th></th>
                <th scope="col">Product Name</th>
 
              </tr>
            </thead>
            <tbody>
              <tr>
                <td><button type="button" class="btn btn-danger"><i class="bi bi-trash"></i></button></td>
                <td><img src="uploads\burger.jpeg" alt="" height="90"></td>
                <td>Burger <br>&#8369;15.00 <br>
                <button class="qtyBtn">+</button><span style="margin: 5px;">2</span><button class="qtyBtn">-</button></td>


              </tr>
              <tr>
              <td><button type="button" class="btn btn-danger"><i class="bi bi-trash"></i></button></td>
                <td><img src="uploads\burger.jpeg" alt="" height="90"></td>
                <td>Burger <br>&#8369;15.00 <br>
                <button class="qtyBtn">+</button><span style="margin: 5px;">2</span><button class="qtyBtn">-</button></td>

              

              </tr>
              <tr>
              <td><button type="button" class="btn btn-danger"><i class="bi bi-trash"></i></button></td>
                <td><img src="uploads\burger.jpeg" alt="" height="90"></td>
                <td>Burger <br>&#8369;15.00 <br>
                <button class="qtyBtn">+</button><span style="margin: 5px;">2</span><button class="qtyBtn">-</button></td>


              </tr>
            </tbody>
          </table>
        </div>
        <div class="containers" style="border-radius: 1em;">
          <p><b>Cart totals</b></p>
          <hr>
          <table>
            <thead>
              <tr id="thz">
                <th >Subtotals</th>
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
                <th>&#8369;15.00</th>
              </tr>
            </thead>
          </table>
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