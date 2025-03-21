<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SMCC QuickBite - Canteen Staff Register</title>
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="staff_register.css">
</head>

<body>
  <div class="main">
    <div class="d-flex justify-content-center align-items-center">
      <img src="png files/smcc logo.png" alt="" height="208">
    </div>

    <div class="mainBody">
      <div class="container">
        <h1>Staff Register</h1>
        <form action="staff_register.php" method="POST" class="row g-3">
          <div class="col-md-6">
            <label for="inputEmail4" class="form-label">Email</label>
            <input type="email" class="form-control" id="inputEmail4" name="inputEmail">
          </div>
          <div class="col-md-6">
            <label for="inputPassword4" class="form-label">Password</label>
            <input type="password" class="form-control" id="inputPassword4" name="inputPass">
          </div>
          <div class="col-md-12">
            <label for="inputEmail4" class="form-label">Full Name</label>
            <input type="text" class="form-control" id="inputEmail4" name="fullName">
          </div>
          <div class="col-md-12">
            <label for="inputAddress" class="form-label">Address</label>
            <input type="text" class="form-control" id="inputAddress" name="inputAdd">
          </div>
          <div class="col-md-6 ">
            <label for="inputPassword4" class="form-label">Gender</label>
            <div class="d-flex">
              <div class="form-check" style="margin-right: 1em;">
                <input class="form-check-input" type="radio" name="genders" id="flexRadioDefault1">
                <label class="form-check-label" for="flexRadioDefault1">
                  Male
                </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="genders" id="flexRadioDefault2">
                <label class="form-check-label" for="flexRadioDefault2">
                  Female
                </label>
              </div>
            </div>

          </div>
          <div class="col-md-6">
            <label for="">Phone Number</label>
            <div class="input-group flex-nowrap">
              <span class="input-group-text" id="addon-wrapping">+63</span>
              <input type="numbers" class="form-control" aria-describedby="addon-wrapping" name="phoneNum">
            </div>
          </div>
          <div class="col-md-12">
            <label for="inputState" class="form-label">Campus Location</label>
            <select id="inputState" class="form-select" name="location">
              <option selected>Choose...</option>
              <option value="Main Campus">Main Campus</option>
              <option value="Triangulo">Triangulo</option>
            </select>
          </div>
          <div class="col-12 d-flex justify-content-center align-items-center">
            <input type="submit" class="btn btn-primary subBtn" value="Register"> 
          </div>
        </form>
      </div>
    </div>
  </div>

  <script src="js/bootstrap.bundle.min.js"></script>
</body>

</html>


<?php
$servername = "127.0.0.1:3307";
$username = "root";
$password = "";
$dbname = "smcc_quickbiteDB";

$conn = new mysqli($servername, $username, $password, $dbname);


if($conn->connect_error){
  die("Error Connection");
}
else{

if($_SERVER["REQUEST_METHOD"] == "POST"){
  if(isset($_POST['inputEmail'],$_POST["inputPass"],$_POST["fullName"],$_POST["inputAdd"],$_POST["genders"],$_POST["phoneNum"],$_POST["location"])){

    $email = htmlspecialchars($_POST['inputEmail']);
    $pass = $_POST["inputPass"];
    $fullN = $_POST["fullName"];
    $address = $_POST["inputAdd"];
    $gender = $_POST["genders"];
    $phone = $_POST["phoneNum"];
    $local = $_POST["location"];

    $sql = "INSERT INTO staff_datas(email,password,name,address,gender,phone,location)VALUES('$email','$pass','$fullN','$address','$gender','$phone','$local');";

    if($conn->query($sql) === TRUE){
      echo "<script> alert('Please approach the admin to get approved'); </script>";
    }
    else{
      echo "Error";
    }
  }
}
}
?>