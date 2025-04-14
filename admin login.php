<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SMCC QuickBite - Admin Login</title>
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Roboto:ital,wght@0,100..900;1,100..900&display=swap');

    body {

      background-color: #13004A;
      font-family: "Montserrat", serif;
      width: 100%;
    }

    .main {
      flex-direction: column;
      padding: 2em;

    }



    .container {
      display: flex;
      flex-direction: column;
      margin-top: 1em;
      background-color: #D9D9D9;
      padding: 2em;
      border-radius: 10px;

    }


    .container h1 {
      text-align: center;
      font-weight: bold;
    }


    .submitBtn {
      margin-top: 4em;
      background-color: #13004A;
      border: none;
      width: 100%;
      margin-bottom: 1em;
    }


    .input-group {
      margin-bottom: 1em;
    }

    .gender {
      margin-left: 5em;

    }
  </style>
</head>

<body>
  <div class="main d-flex justify-content-center align-items-center">
    <img src="png files/smcc logo.png" alt="" height="208">
    <div class="mainBody">
      <div class="container">
        <h1>Admin Login</h1>
        <form method="POST" action="admin login.php">
          <label for="">Username: </label>
          <div class="input-group input-group-sm mb-3">
            <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" name="userVal" required>
          </div>
          <br>
          <label for="">Password:</label>
          <div class="input-group input-group-sm mb-3">
            <input type="password" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" name="passw" id="passw" required>
          </div>

          <input type="checkbox" id="checkboxz">
          <label for="">Show Password</label>
          <br><br>

          <input class="btn btn-primary submitBtn" type="submit" value="Login">

        </form>
      </div>
    </div>
  </div>

  <script src="js/bootstrap.bundle.min.js"></script>
  <script src="login_student.js"></script>
</body>

</html>

