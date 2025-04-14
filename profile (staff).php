<?php
session_start();
if (isset($_SESSION['num'])) {
  $id_num = $_SESSION['num'];
} ?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SMCC QuickBite - Staff Main</title>
  <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.8.1/font/bootstrap-icons.min.css" rel="stylesheet">
  <link rel="stylesheet" href="staff main.css">
</head>

<body>
  <div class="wrapper">
    <aside id="sidebar">
      <div class="d-flex">
        <button class="toggle-btn" type="button">
          <img src="png files/smcc logo.png" alt="" height="35" width="40">
        </button>
        <div class="sidebar-logo">
          <a href="#">SMCC QuickBite</a>
        </div>
      </div>
      <ul class="sidebar-nav">
        <li class="sidebar-item">
          <a href="dashboard staff.php" class="sidebar-link">
            <i class="bi bi-grid-fill"></i>
            <span>Dashboard</span>
          </a>

        </li>

        <li class="sidebar-item">
          <a href="staff main.php" class="sidebar-link">
            <i class="bi bi-box-seam"></i>
            <span>Your Products</span>
          </a>
        </li>
        <li class="sidebar-item">
          <a href="orders staff.php" class="sidebar-link">
            <i class="bi bi-cart"></i>
            <span>Orders</span>
          </a>
        </li>
        <li class="sidebar-item">
          <a href="#" class="sidebar-link">
            <i class="lni lni-user"></i>
            <span>Profile</span>
          </a>
        </li>
      </ul>
      <div class="sidebar-footer">
        <a href="logout.php" class="sidebar-link">
          <i class="lni lni-exit"></i>
          <span>Logout</span>
        </a>
      </div>
    </aside>
    <div class="main p-3">
      <div>
        <h1 style="font-size: 3rem; margin-top:1.7em;margin-bottom:2em;" class="text-center">
          Profile Status
        </h1>
      </div>


      <div class="container" style="background-color: white; padding:3em;border-radius:1em;">
        <form action="update staff.php" method="POST">
          <?php
          include('db.php');

          $sql = "SELECT * FROM staff_datas where staff_id = $id_num;";

          $result = $conn->query($sql);

          if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
              if ($row['status_acc'] == "APPROVED") {
                echo '<fieldset disabled>';
                echo '  <div class="row">';
                echo '    <div class="col-md">';
                echo '      <div class="mb-3">';
                echo '        <label for="disabledTextInput" class="form-label">ID Number: </label>';
                echo '        <input type="number" id="disabledTextInput" class="form-control" placeholder="' . $row['staff_id'] . '">';
                echo '      </div>';
                echo '    </div>';
                echo '    <div class="col-md">';
                echo '      <div class="mb-3">';
                echo '        <label for="disabledTextInput" class="form-label">Email:</label>';
                echo '        <input type="text" id="disabledTextInput" name="emailInpt" class="form-control" placeholder="' . $row['email'] . '">';
                echo '      </div>';
                echo '    </div>';
                echo '  </div>';
                echo '  <div class="row">';
                echo '    <div class="col-md">';
                echo '      <div class="mb-3">';
                echo '        <label for="disabledTextInput" class="form-label">Seller Name:</label>';
                echo '        <input type="text" id="disabledTextInput" name="nameInpt" class="form-control" placeholder="' . $row['name'] . '">';
                echo '      </div>';
                echo '    </div>';
                echo '    <div class="col-md">';
                echo '      <div class="mb-3">';
                echo '        <label for="disabledTextInput" class="form-label">Address:</label>';
                echo '        <input type="text" id="disabledTextInput" name="addInpt" class="form-control" placeholder="' . $row['address'] . '">';
                echo '      </div>';
                echo '    </div>';
                echo '  </div>';
                echo '  <div class="row">';
                echo '    <div class="col-md">';
                echo '      <div class="mb-3">';
                echo '        <label for="disabledTextInput" class="form-label">Gender:</label>';
                echo '        <input type="text" name="genderInpt" id="disabledTextInput" class="form-control" placeholder="' . $row['gender'] . '">';
                echo '      </div>';
                echo '    </div>';
                echo '    <div class="col-md">';
                echo '      <div class="mb-3">';
                echo '        <label for="disabledTextInput" class="form-label">Phone Number:</label>';
                echo '        <input type="number" id="disabledTextInput" class="form-control" name="phoneInpt" placeholder="' . $row['phone'] . '" style="color: green;">';
                echo '      </div>';
                echo '    </div>';
                echo '  </div>';
                echo '  <div class="row">';
                echo '    <div class="col-md">';
                echo '      <div class="mb-3">';
                echo '        <label for="disabledTextInput" class="form-label">Location:</label>';
                echo '        <input type="text" name="locationInpt" id="disabledTextInput" class="form-control" placeholder="' . $row['location'] . '">';
                echo '      </div>';
                echo '    </div>';
                echo '    <div class="col-md">';
                echo '      <div class="mb-3">';
                echo '        <label for="disabledTextInput" class="form-label">Status</label>';
                echo '        <input type="text" id="disabledTextInput" class="form-control" placeholder="APPROVED" style="color: green;">';
                echo '      </div>';
                echo '    </div>';
                echo '  </div>';
                echo '  <div class="row">';
                echo '    <div class="col">';
                echo '      <p class="text-center" style="color:red;">Cannot update profile, because your account has been approved by the admin, if you wish please approach the admin</p>';
                echo '    </div>';
                echo '  </div>';
                echo '</fieldset>';
              } else {
                echo '<fieldset>';
                echo '  <div class="row">';

                echo '    <div class="col-md">';
                echo '      <div class="mb-3">';
                echo '        <label for="disabledTextInput" class="form-label">ID Number: </label>';
                echo '    <fieldset disabled>';
                echo '        <input type="number" id="disabledTextInput" class="form-control" value="' . $row['staff_id'] . '">';
                echo '    </fieldset>';
                echo '      </div>';
                echo '    </div>';
                echo '    <div class="col-md">';
                echo '      <div class="mb-3">';
                echo '        <label for="disabledTextInput" class="form-label">Email:</label>';
                echo '        <input type="text" id="disabledTextInput" name="emailInpt" class="form-control" value="' . $row['email'] . '">';
                echo '      </div>';
                echo '    </div>';
                echo '  </div>';
                echo '  <div class="row">';
                echo '    <div class="col-md">';
                echo '      <div class="mb-3">';
                echo '        <label for="disabledTextInput" class="form-label">Seller Name:</label>';
                echo '        <input type="text" id="disabledTextInput" name="nameInpt" class="form-control" value="' . $row['name'] . '">';
                echo '      </div>';
                echo '    </div>';
                echo '    <div class="col-md">';
                echo '      <div class="mb-3">';
                echo '        <label for="disabledTextInput" class="form-label">Address:</label>';
                echo '        <input type="text" id="disabledTextInput" name="addInpt" class="form-control" value="' . $row['address'] . '">';
                echo '      </div>';
                echo '    </div>';
                echo '  </div>';
                echo '  <div class="row">';
                echo '    <div class="col-md">';
                echo '      <div class="mb-3">';
                echo '        <label for="disabledTextInput" class="form-label">Gender:</label>';
                echo '        <select name="genderInpt" id="disabledTextInput" class="form-control">';
                if ($row['gender'] == "Male") {
                  echo '<option value="Male" selected>Male</option>';
                  echo '<option value="Female">Female</option>';
                } else {
                  echo '<option value="Male">Male</option>';
                  echo '<option value="Female" selected>Female</option>';
                }
                echo '        </select>';
                echo '      </div>';
                echo '    </div>';
                echo '    <div class="col-md">';
                echo '      <div class="mb-3">';
                echo '        <label for="disabledsTextInput" class="form-label">Phone Number:</label>';
                echo '        <input type="number" id="phoneInpt" class="form-control" name="phoneInpt" value="' . $row['phone'] . '">';
                echo '<p id="warningText" style="color:red;display:none; font-size: 15px;">Phone number 11 digits only</p>';
                echo '      </div>';
                echo '    </div>';
                echo '  </div>';
                echo '  <div class="row">';
                echo '    <div class="col-md">';
                echo '      <div class="mb-3">';
                echo '        <label for="disabledTextInput" class="form-label">Location:</label>';
                echo '        <select name="locationInpt" id="disabledTextInput" class="form-control">';
                if ($row['location'] == "Triangulo") {
                  echo '<option value="Triangulo" selected>Triangulo</option>';
                  echo '<option value="Main Campus">Main Campus</option>';
                } else {
                  echo '<option value="Male">Triangulo</option>';
                  echo '<option value="Main Campus" selected>Main Campus</option>';
                }
                echo '</select>';
                echo '      </div>';
                echo '    </div>';
                echo '    <div class="col-md">';
                echo '      <div class="mb-3">';
                echo '        <label for="disabledTextInput" class="form-label">Status</label>';
                echo '        <fieldset disabled>';
                echo '        <input type="text" id="disabledTextInput" class="form-control" value="NOT APPROVED" style="color: red;">';
                echo '       </fieldset>';
                echo '      </div>';
                echo '    </div>';
                echo '  </div>';
               
                echo '  <div class="row">';
                echo '    <div class="col">';
                echo '      <input type="submit" class="btn btn-primary" style="width:100%; margin-top:2em;" value="Update" id="btnSub">';
                echo '    </div>';
                echo '  </div>';
                echo '</fieldset>';
              }
            }
          }

          ?>
        </form>
      </div>



    </div>
    <script>
      document.getElementById('phoneInpt').addEventListener('input',()=>{
        let textWarn = document.getElementById('warningText');
        let btn = document.getElementById('btnSub');
        if(document.getElementById('phoneInpt').value.length > 11 || document.getElementById('phoneInpt').value.length < 11){
          textWarn.style.display = 'block';
          btn.style.display = 'none';
        }
        else{
          textWarn.style.display = 'none';
          btn.style.display = 'block';
        }
      });

      document.getElementById('checkPass').addEventListener('change', function() {
        let pass = document.getElementById('passInpt');
        if (document.getElementById('checkPass').checked) {
          pass.type = "text";
        } else {
          pass.type = "password";
        }
      })
    </script>


  </div>


  <script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
    crossorigin="anonymous"></script>
  <script src="script.js"></script>
</body>

</html>