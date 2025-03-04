<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SMCC QuickBite - Register Student</title>
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="register_student.css">
</head>

<body>
  <div class="main d-flex justify-content-center align-items-center">
    <img src="png files/smcc logo.png" alt="" height="208">
    <div class="mainBody">
      <div class="container">
        <h1>Student Register</h1>
        <form action="register_student.php" method="POST">
          <label for="">Student ID: </label>
          <div class="input-group input-group-sm mb-3">
            <input type="number" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" name="idNum" required>
          </div>
          <br>
          <label for="">Full Name: </label>
          <div class="input-group input-group-sm mb-3">
            <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" name="fullName" required>
          </div>
          <br>
          <label for="">Gender: </label><br>
          <input type="radio" class="gender" name="gender" id="male" value="Male" required>
          <label for="">Male</label>
          <input type="radio" class="gender" name="gender" id="female" value="Female" required>
          <label for="">Female</label>
          <br> <br>
          <label for="">Grade Level:</label>
          <select class="form-select" aria-label="Default select example" name="grade" required>
            <option value=""></option>
            <option value="7">7</option>
            <option value="8">8</option>
            <option value="9">9</option>
            <option value="10">10</option>
          </select>

          <br>
          <label for="">Section:</label>
          <select class="form-select" aria-label="Default select example" name="sectionOptions" required>
            <option selected></option>
            <option value="1">One</option>
            <option value="2">Two</option>
            <option value="3">Three</option>
          </select>

          <br>

          <label for="">Password:</label>
          <div class="input-group input-group-sm mb-3">
            <input type="password" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" name="passw" required>
          </div>

          <input type="checkbox">
          <label for="">Show Password</label>
          <br><br>

          <input class="btn btn-primary submitBtn" type="submit" value="Submit">
        </form>
      </div>
    </div>
  </div>

  <script src="js/bootstrap.bundle.min.js"></script>
  <script src="student_login.js"></script>
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

  try{
    if (isset($_POST["idNum"], $_POST["fullName"], $_POST["gender"], $_POST["grade"], $_POST["sectionOptions"], $_POST["passw"])) {

      $id = $_POST["idNum"];
      $name = $_POST["fullName"];
      $gender = $_POST["gender"];
      $lvl = $_POST["grade"];
      $sec = $_POST["sectionOptions"];
      $pass = $_POST["passw"];
  
  
      $sql = "INSERT INTO shs_students_data(id_number,full_name,gender,grade_level,section,password)values($id,'$name','$gender',$lvl,'$sec','$pass')";
  
      if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Wait for the admin to approve your account'); </script>"; 
        header("Location: login_student.php");
        exit();
      } else {
        echo "Error";
      }
    }
  }catch(mysqli_sql_exception $e){
    echo "<script>alert('Account cannot register, ID number already exist!'); </script>";  
  }
  

  
}
?>