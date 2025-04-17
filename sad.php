<?php 

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "smcc_quickbiteDB";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);  // Output the actual error message
}
else{
    echo "Connected";
}



?>