<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SMCC QuickBite - Login Student</title>
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="login_student.css">
</head>

<body>
  <div class="main d-flex justify-content-center align-items-center">
    <img src="png files/smcc logo.png" alt="" height="208">
    <div class="mainBody">
      <div class="container">
        <h1>Student Register</h1>
        <form action="login_student.php" method="POST">
          <label for="">Student ID: </label>
          <div class="input-group input-group-sm mb-3">
            <input type="number" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" name="idNum" required>
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
            <p>Don't have account? <a href="register_student.php" style="color: #2EB56B; text-decoration: none;">Register Here</a></p>
          </div>


        </form>
      </div>
    </div>
  </div>

  <script src="js/bootstrap.bundle.min.js"></script>
  <script src="login_student.js"></script>
</body>

</html>


<?php

$servername = "127.0.0.1:3307";
$username = "root";
$password = "";
$dbname = "smcc_quickbiteDB";

$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
  die("Error Connection");
} else {

  if (isset($_POST["idNum"], $_POST["passw"])) {
    $id_num = $_POST["idNum"];
    $pass = $_POST["passw"];

    $sql = "SELECT id FROM shs_students_data WHERE id_number = $id_num AND password ='$pass';";
    $result = $conn->query($sql);

    if($result === FALSE){
      throw new Exception("SQL ERROR: " . $conn->error); 
    }

    if($result->fetch_assoc()){
      header("Location: student main.php?num=$id_num");
    }
    else{
      echo "<script> alert('Wrong id number or password'); </script>";
    }
  }
}

?>