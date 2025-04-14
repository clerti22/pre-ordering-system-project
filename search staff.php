<?php

if($_SERVER["REQUEST_METHOD"] == "POST"){
  $val = $_POST["val"];

  include('db.php');

  $sql = "SELECT * FROM staff_datas WHERE name LIKE '$val%'";

  $result = $conn->query($sql);

  if($result->num_rows > 0){
    while($row = $result->fetch_assoc()){
      if($row['status_acc'] == "NOT APPROVED"){
      echo "<tr>";
      echo "<td>" . $row['staff_id'] . "</td>";
      echo "<td>" . $row['email'] . "</td>";
      echo "<td>" . $row['name'] . "</td>";
      echo "<td>" . $row['address'] . "</td>";
      echo "<td>" . $row['gender'] . "</td>";
      echo "<td>" . $row['phone'] . "</td>";
      echo "<td>" . $row['location'] . "</td>";
      echo "<td><button type='button' class='btn btn-success' onclick='verifyAccStaff(" . $row['staff_id'] . ")' >Approve Account</button></td>";
      echo "</tr>";
    } else if ($row['status_acc'] == "APPROVED") {
      echo "<tr>";
      echo "<td>" . $row['staff_id'] . "</td>";
      echo "<td>" . $row['email'] . "</td>";
      echo "<td>" . $row['name'] . "</td>";
      echo "<td>" . $row['address'] . "</td>";
      echo "<td>" . $row['gender'] . "</td>";
      echo "<td>" . $row['phone'] . "</td>";
      echo "<td>" . $row['location'] . "</td>";
      echo "<td><span style='color:green;'>Approved Account</span></td>";
      echo "</tr>";
    }
  }
}
}

?>