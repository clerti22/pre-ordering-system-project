<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SMCC QuickBite - Login Student</title>
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <style>
    body{
  background-color: #13004A;
  font-family: "Montserrat", serif;
  width: 100%;
}

.main{
  flex-direction: column;
  padding: 2em;
 
}



.container{
  display: flex;
  flex-direction: column;
  margin-top: 1em;
  background-color: #D9D9D9;
  padding:2em;
  border-radius: 10px;

}


.container h1{
  text-align: center;
  font-weight: bold;
}


.submitBtn{
  margin-top: 4em;
  background-color: #13004A;
  border: none;
  width: 100%;
  margin-bottom: 1em;
}


.input-group{
  margin-bottom: 1em;
}

.gender{
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
        <form  method="POST">
          <label for="">Username: </label>
          <div class="input-group input-group-sm mb-3">
            <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" name="idNum" required>
          </div>
          <br>
          <label for="">Password:</label>
          <div class="input-group input-group-sm mb-3">
            <input type="password" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" name="passw" id="passw" required>
          </div>

          <input type="checkbox" id="checkboxz">
          <label for="">Show Password</label>
          <br><br>

          <input class="btn btn-primary submitBtn" type="submit" value="Submit">

         


        </form>
      </div>
    </div>
  </div>

  <script src="js/bootstrap.bundle.min.js"></script>
  <script src="login_student.js"></script>
</body>

</html>


