<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <link href="add tocart.css" rel="stylesheet">
  <title>SMCC QuickBite - Profile</title>
</head>

<body>
  <header>
    <nav class="navbar">
      <div class="container-fluid">
        <img class="navbar-brand" src="png files\smcc logo.png" height="60">
        <div class="d-flex justify-content-center align-items-center pfp">
          <a href=""><i class="bi bi-bag-check" style="color:white; margin-right:25px;font-size: 1.7rem;" alt="go to your orders"></i></a>
          <i class="bi bi-person-circle icons pfpIcon"></i>
          <span style="color: white; margin-left:4px;">Profile</span>
        </div>
      </div>
    </nav>
  </header>

  <div class="main">
    <div class="mainBody">
      <div class="container-fluid">
        <button type="button" class="btn btn-danger">Go back to menu</button>
        <h1 style="font-size: 4rem;" class="text-center"><strong>Profile Status</strong></h1>

        <div class="container" style="margin-top: 2em; background-color: white; padding: 3em; border-radius: 1.4em;">
          <form action="samp.php" method="POST">
            <?php
            if (isset($_GET['id'])) {
              $id = $_GET['id'];
            }
            ?>

            <?php
            include('db.php');

            $sql = "SELECT * FROM shs_students_data WHERE id_number = $id;";

            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
              while ($row = $result->fetch_assoc()) {
                if ($row['status'] == 'APPROVED') {
                  echo '<fieldset disabled>';
                  echo '<div class="row">';
                  echo '<div class="col">';
                  echo '<div class="mb-3">';
                  echo '<label for="disabledTextInput" class="form-label">ID Number: </label>';
                  echo '<input type="number" id="disabledTextInput"  class="form-control" placeholder="' . $row['id_number'] . '" >';
                  echo '</div>';
                  echo '</div>';
                  echo '<div class="col">';
                  echo '<div class="mb-3">';
                  echo '<label for="disabledTextInput" class="form-label">Full Name:</label>';
                  echo '<input type="text" id="disabledTextInput" class="form-control" placeholder="' . $row['full_name'] . '" >';
                  echo '</div>';
                  echo '</div>';
                  echo '</div>';
                  echo '<div class="row">';
                  echo '<div class="col">';
                  echo '<div class="mb-3">';
                  echo '<label for="disabledTextInput" class="form-label">Gender:</label>';
                  echo '<input type="text" id="disabledTextInput" class="form-control" placeholder="' . $row['gender'] . '" >';
                  echo '</div>';
                  echo '</div>';
                  echo '<div class="col">';
                  echo '<div class="mb-3">';
                  echo '<label for="disabledTextInput" class="form-label">Grade Level:</label>';
                  echo '<input type="text" id="disabledTextInput" class="form-control" placeholder="' . $row['grade_level'] . '" >';
                  echo '</div>';
                  echo '</div>';
                  echo '</div>';
                  echo '<div class="row">';
                  echo '<div class="col">';
                  echo '<div class="mb-3">';
                  echo '<label for="disabledTextInput" class="form-label">Section:</label>';
                  echo '<input type="text" id="disabledTextInput" class="form-control" placeholder="' . $row['section'] . '" >';
                  echo '</div>';
                  echo '</div>';
                  echo '<div class="col">';
                  echo '<div class="mb-3">';
                  echo '<label for="disabledTextInput" class="form-label">Status</label>';
                  echo '<input type="text" id="disabledTextInput" class="form-control" placeholder="APPROVED" style="color: green;" >';
                  echo '</div>';
                  echo '</div>';
                  echo '</div>';
                  echo '<div class="row">';
                  echo '<div class="col">';
                  echo '<p class="text-center" style="color:red;">Cannot update profile, because your account has been approved by the admin, if you wish please approach the admin</p>';
                  echo '</div>';
                  echo '</div>';
                  echo '</fieldset>';
                } 
                
                else {
                  echo '<fieldset>';
                  echo '<div class="row">';
                  echo '<div class="col">';
                  echo '<div class="mb-3">';
                  echo '<label for="disabledTextInput" class="form-label">ID Number: </label>';
                  echo '<input type="hidden" id="disabledTextInput" name="idOrig" class="form-control" value="' . $id . '" >';
                  echo '<input type="number" id="disabledTextInput" name="idNum" class="form-control" value="' . $row['id_number'] . '" >';
                  echo '</div>';
                  echo '</div>';
                  echo '<div class="col">';
                  echo '<div class="mb-3">';
                  echo '<label for="disabledTextInput" class="form-label">Full Name:</label>';
                  echo '<input type="text" id="disabledTextInput" name="fullName" class="form-control"  value="' . $row['full_name'] . '" >';
                  echo '</div>';
                  echo '</div>';
                  echo '</div>';
                  echo '<div class="row">';
                  echo '<div class="col">';
                  echo '<div class="mb-3">';
                  echo '<label for="disabledTextInput" class="form-label">Gender:</label>';
                  echo '<input type="text" id="disabledTextInput" name="gender" class="form-control"  value="' . $row['gender'] . '" >';
                  echo '</div>';
                  echo '</div>';
                  echo '<div class="col">';
                  echo '<div class="mb-3">';
                  echo '<label for="disabledTextInput" class="form-label">Grade Level:</label>';
                  echo '<input type="number" id="disabledTextInput" name="gradelvl" class="form-control" value="' . $row['grade_level'] . '" >';
                  echo '</div>';
                  echo '</div>';
                  echo '</div>';
                  echo '<div class="row">';
                  echo '<div class="col">';
                  echo '<div class="mb-3">';
                  echo '<label for="disabledTextInput" class="form-label">Section:</label>';
                  echo '<input type="text" id="disabledTextInput" name="section" class="form-control"  value="' . $row['section'] . '" >';
                  echo '</div>';
                  echo '</div>';
                  echo '<div class="col">';
                  echo '<fieldset disabled>';
                  echo '<div class="mb-3">';
                  echo '<label for="disabledTextInput" class="form-label">Status</label>';
                  echo '<input type="text" id="disabledTextInput" class="form-control" placeholder="NOT APPROVED" style="color: green;" >';
                  echo '</div>';
                  echo '</fieldset>';
                  echo '</div>';
                  echo '</div>';
                  echo '<div class="row">';
                  echo '<div class="col">';
                  echo '<input type="submit" class="btn btn-primary" style="width: 100%;" value="Update Profile">';
                  echo '</div>';
                  echo '</div>';
                  echo '</fieldset>';
                }
              }
            }
            ?>

          </form>
        </div>


      </div>
    </div>
  </div>





  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>


</body>

</html>
