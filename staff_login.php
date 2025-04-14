<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SMCC QuickBite - Canteen Staff Login</title>
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="staff_login.css">
</head>

<body>
  <div class="main d-flex justify-content-center align-items-center">
    <img src="png files/smcc logo.png" alt="" height="208">
    <div class="mainBody">

      <div class="container-fluid ">
        <div class="con">
          <form action="staff_login.php" method="POST" class="">
            <h1 class="text-center">Staff Login</h1>
            <label for="">Email: </label>
            <div class="input-group input-group-sm mb-3">
              <input type="email" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" name="emailz" required>
            </div>
            <br>
            <label for="">Password:</label>
            <div class="input-group input-group-sm mb-3">
              <input type="password" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" name="passw" id="passw" required>
            </div>

            <input type="checkbox" id="checkboxz">
            <label for="">Show Password</label>
            <br><br>

            <input class="btn btn-primary submitBtn" type="submit" value="Submit">

            <div class="bottom text text-center">
              <p>Don't have account? <a href="staff_register.php" style="color: #2EB56B; text-decoration: none;">Register Here</a></p>
            </div>


          </form>
        </div>

      </div>
    </div>
  </div>
  <script src="js/bootstrap.bundle.min.js"></script>
  <script src="login_student.js"></script>
</body>

</html>



<?php
session_start();
$servername = "127.0.0.1:3307";
$username = "root";
$password = "";
$dbname = "smcc_quickbiteDB";

$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
  die("Error Connection");
} else {
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["emailz"], $_POST["passw"])) {
      $email = $_POST["emailz"];
      $pass = $_POST["passw"];

      $sql = "SELECT staff_id FROM staff_datas WHERE email = '$email' AND password = '$pass';";
      $result = $conn->query($sql);

      if ($result == FALSE) {
        throw new Exception("SQL ERROR: " . $conn->error);
      }

      if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
           $_SESSION['num'] = $row["staff_id"];

          echo "<script> console.log('$id_num'); </script>";
          echo "<script> alert('Logged In!'); </script>";
          header("Location: staff main.php");
          exit();
        }
      } else {
        echo "<script> alert('Wrong email or password'); </script>";
      }
    }
  }
}
?>