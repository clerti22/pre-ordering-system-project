<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SMCC QuickBite - Users Management</title>
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
          <a href="dashboard admin.php" class="sidebar-link">
            <i class="bi bi-grid-fill"></i>
            <span>Dashboard</span>
          </a>

        </li>
        <li class="sidebar-item">
          <a href="#" class="sidebar-link collapsed has-dropdown" data-bs-toggle="collapse"
            data-bs-target="#auth" aria-expanded="false" aria-controls="auth">
            <i class="bi bi-people"></i>
            <span>Users Management</span>
          </a>
          <ul id="auth" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
            <li class="sidebar-item">
              <a href="#" class="sidebar-link">Student</a>
            </li>
            <li class="sidebar-item">
              <a href="staff management.php" class="sidebar-link">Staff</a>
            </li>
          </ul>
        </li>

        
      </ul>
      <div class="sidebar-footer">
        <a href="#" class="sidebar-link">
          <i class="lni lni-exit"></i>
          <span>Logout</span>
        </a>
      </div>
    </aside>
    <div class="main p-3">
      <div style="margin-bottom: 3em; margin-top:3em;">
        <h1 style="font-size: 3rem;" class="text-center">
          Students management
        </h1>
      </div>

      <div class="searchArea">

        <input type="text" id="searchInpt" name="searchInpt" class="inptSearch" placeholder="Search Name">
        <button class="btn btn-outline-success searchBtn" id="searchBtn">Search</button>
       

      </div>


      <script>
        document.getElementById('searchBtn').addEventListener("click",(event) => {
          let val = document.getElementById('searchInpt').value;
          let table = document.getElementById('tableBody');

          let formD = new FormData();

          formD.append('val',val);

          let xhr = new XMLHttpRequest();

          xhr.open('POST','search student.php',true);

          xhr.onload = ()=>{
            if(xhr.status == 200){
              table.innerHTML = xhr.responseText;
            }
            else{
              console.log(xhr.status);
            }
          }

          xhr.send(formD);
        });
      </script>


      <div class="tableSec" style="background-color: white;">
        <table class="table table-striped" id="tableSec">
          <?php
          include('db.php');

          echo "<thead>";
              echo "<tr>";
              echo "<th scope='col'>ID Number</th>";
              echo "<th scope='col'>Full Name</th>";
              echo "<th scope='col'>Gender</th>";
              echo "<th scope='col'>Grade Level</th>";
              echo "<th scope='col'>Section</th>";
              echo " <th scope='col'>Status</th>";
              echo "</tr></thead>";
              echo "<tbody id='tableBody'>";
          
              $sql = "SELECT * FROM shs_students_data;";
              $result = $conn->query($sql);
          
              if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                  if ($row['status'] == "NOT APPROVED") {
                    echo "<tr>";
                    echo "<td>" . $row['id_number'] . "</td>";
                    echo "<td>" . $row['full_name'] . "</td>";
                    echo "<td>" . $row['gender'] . "</td>";
                    echo "<td>" . $row['grade_level'] . "</td>";
                    echo "<td>" . $row['section'] . "</td>";
                    echo "<td><button type='button' class='btn btn-success' onclick='verifyAcc(" . $row['id_number'] . ")' >Approve Account</button></td>";
                    echo "</tr>";
                  } else {
                    echo "<tr>";
                    echo "<td>" . $row['id_number'] . "</td>";
                    echo "<td>" . $row['full_name'] . "</td>";
                    echo "<td>" . $row['gender'] . "</td>";
                    echo "<td>" . $row['grade_level'] . "</td>";
                    echo "<td>" . $row['section'] . "</td>";
                    echo "<td><span style='color:green;'>Approved Account</span></td>";
                    echo "</tr>";
                  }
                }
              }
              echo "</tbody>";
          
          
          
          ?>

        </table>
      </div>
    </div>
    <script>
      function verifyAcc(id) {

        let formD = new FormData();

        formD.append('id', id);

        let xhr = new XMLHttpRequest();

        xhr.open('POST', 'approve acc(students).php', true);

        xhr.onload = function() {
          if (xhr.status == 200) {
            console.log(xhr.responseText);
          } else {
            console.log(xhr.status);
          }
        }
        xhr.send(formD);
        location.reload();
      }

      function verifyAccStaff(id) {
        let formD = new FormData();

        formD.append('id', id);

        let xhr = new XMLHttpRequest();

        xhr.open('POST', 'approve account(staffs).php', true);

        xhr.onload = function() {
          if (xhr.status == 200) {
            console.log(xhr.responseText);
          } else {
            console.log(xhr.status);
          }
        }
        xhr.send(formD);
        location.reload();
      }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
      crossorigin="anonymous"></script>
    <script src="script.js"></script>
</body>

</html>


<?php






?>