<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $value = $_POST['value'];

  include('db.php');
  if ($value == "Students") {
    echo "<thead>";
    echo "<tr>";
    echo "<th scope='col'>ID Number</th>";
    echo "<th scope='col'>Full Name</th>";
    echo "<th scope='col'>Gender</th>";
    echo "<th scope='col'>Grade Level</th>";
    echo "<th scope='col'>Section</th>";
    echo " <th scope='col'>Status</th>";
    echo "</tr></thead>";
    echo "<tbody>";

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
  } else if ($value == "Canteen Staffs") {
    echo "<thead>";
    echo "<tr>";
    echo "<th scope='col'>Staff ID</th>";
    echo "<th scope='col'>Email</th>";
    echo "<th scope='col'>Name</th>";
    echo "<th scope='col'>Address</th>";
    echo "<th scope='col'>Gender</th>";
    echo " <th scope='col'>Phone Number</th>";
    echo " <th scope='col'>Location</th>";
    echo " <th scope='col'>Status</th>";
    echo "</tr></thead>";
    echo "<tbody>";

    $sql = "SELECT * FROM staff_datas;";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        if ($row['status_acc'] == "NOT APPROVED") {
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
}
