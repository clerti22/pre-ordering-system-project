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
          <a href="#" class="sidebar-link">
            <i class="bi bi-grid-fill"></i>
            <span>Dashboard</span>
          </a>

        </li>

        <li class="sidebar-item">
          <a href="#" class="sidebar-link">
            <i class="bi bi-people"></i>
            <span>Users Management</span>
          </a>
        </li>

        <li class="sidebar-item">
          <a href="#" class="sidebar-link">
            <i class="bi bi-clipboard-data"></i>
            <span>Reports</span>
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
        <a href="#" class="sidebar-link">
          <i class="lni lni-exit"></i>
          <span>Logout</span>
        </a>
      </div>
    </aside>
    <div class="main p-3">
      <div style="margin-bottom: 3em; margin-top:3em;">
        <h1 style="font-size: 3rem;" class="text-center">
          Users management
        </h1>
      </div>

      <div class="searchArea">

        <input type="text" id="searchInpt" name="searchInpt" class="inptSearch" placeholder="Search Name">
        <button class="btn btn-outline-success searchBtn" id="searchBtn">Search</button>

        <select class="form-select form-select-sm select-P" aria-label="Small select example" id="rolesSelect">
          <option>-- Please Select --</option>
          <option value="Students">Students</option>
          <option value="Personnels">Personnels</option>
          <option value="Canteen Staffs">Canteen Staffs</option>
        </select>

      </div>
    

      <script>
        document.getElementById('rolesSelect').addEventListener("change", (event) => {
          let tbody = document.getElementById('tableSec');
          let selectedVal = '';

          if (event.target.value === "Students") {
            selectedVal = 'Students';
          } else if (event.target.value === "Personnels") {
            selectedVal = "Non-Personnels";
          } else if (event.target.value === "Canteen Staffs") {
            selectedVal = "Canteen Staffs";
          } else {
            console.log('Please select option');
          }

          let formD = new FormData();

          formD.append('value', selectedVal);

          let xhr = new XMLHttpRequest();

          xhr.open('POST', 'roles options(user management).php', true);

          xhr.onload = () => {
            if (xhr.status == 200) {
              tbody.innerHTML = xhr.responseText;
            } else {
              console.log(xhr.status);
            }
          }

          xhr.send(formD);
        });
      </script>

      <div class="tableSec" style="background-color: white;">
        <table class="table table-striped" id="tableSec"></table>
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
    <script src="script.js"></script>
</body>

</html>