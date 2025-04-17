<?php
session_start();
if (isset($_SESSION['num'])) {
  $id = $_SESSION['num'];
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <link href="add tocart.css" rel="stylesheet">
  <title>SMCC QuickBite - Notification</title>
</head>

<body>
  <header>
    <nav class="navbar">
      <div class="container-fluid">
        <img class="navbar-brand" src="png files\smcc logo.png" height="60">
        <div class="d-flex justify-content-center align-items-center pfp">
          <a href="order page(student).php"><i class="bi bi-bag-check" style="color:white; font-size: 1.7rem;" alt="go to your orders"></i></a><span style="margin-right:25px; color:red;">
            <?php
             
            include('db.php');

            $sql = "SELECT COUNT(*) from orders_history where id_number = $id";

            $result = $conn->query($sql);

            if($result->num_rows > 0){
              while($row = $result->fetch_assoc()){
                echo $row['COUNT(*)'];
              }
            }
          
            
            ?>
          </span>
          <i class="bi bi-person-circle icons pfpIcon"></i>
          
          <a href="profile (student).php" style="color: white; margin-left:4px;">Profile</a>
        </div>
      </div>
    </nav>
  </header>

  <div class="main">
    <div class="mainBody">
      <div class="container-fluid">
        <a href="student main.php" class="btn btn-danger">Go back to menu</a>
        <h1 class="h1Text"><strong>Notifications</strong></h1>
        <div class="tableSec">
          <table class="table table-striped">
            <thead>
              <tr>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
              </tr>
            </thead>

            <tbody>

              <?php
              
                include('db.php');

                  $sql = "select 
                              id_number,
                              message,
                              DATE_FORMAT(created_at, '%M %d, %Y') AS formatted_date 
                              from user_notification
                              WHERE id_number = $id 
                              ORDER BY id_row DESC";

                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                  while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td></td>";
                    echo "<td></td>";
                    echo "<td></td>";
                    echo "<td><i class='bi bi-bell' style='color: black;font-size:1.7rem;'></i></td>";
                    echo "<td></td>";
                    echo "<td></td>";
                    echo "<td><span>" . $row['message'] . "</span><br>
                              <span style='font-size:0.7rem;color:gray;font-style:italic'> ".$row['formatted_date']." </span></td>";
                    echo "</tr>";
                  }
                }
              
              ?>
            </tbody>

          </table>
        </div>
      </div>
    </div>

  </div>




  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>


</body>

</html>