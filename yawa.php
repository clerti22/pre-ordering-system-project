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
  if(isset($_POST["inputEmail"],$_POST["inputPass"],$_POST["fullName"],$_POST["inpudAdd"],$_POST["genders"],$_POST["phoneNum"],$_POST["location"])){

    $email = $_POST["inputEmail"];
    $pass = $_POST["inputPass"];
    $fullN = $_POST["fullName"];
    $address = $_POST["inpudAdd"];
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
?>