<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $val = $_POST["val"];

  include('db.php');

 

  $sql = "SELECT * FROM shs_students_data WHERE full_name LIKE '$val%';";
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
}
