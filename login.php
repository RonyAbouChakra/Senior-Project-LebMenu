<!DOCTYPE html>
<html lang="en">
  <?php session_start(); // session start
  $_SESSION['user_id']=null;
  ?>
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css"
      rel="stylesheet"
    />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="Assets/CSS/login&signUp.css" />
    <title>login</title>
  </head>
  <body>
    <?php 
    $error =  " ";    // empty variable error
    if(isset($_POST['login'])) // POST where information sent is invisible to everyone
    {
      require 'functions.php';   /* the use of the functions is necessary to get the data from the user
       require function we mean that the data is bringed usually from the GET and POST 
       if in the form the method is GET , then when we do a submit the data is bringing from the GET method
       if in the form the method is POST , then when we do a submit the data is bringing from the POST method*/
      $email = test_input($_POST['email']);   // the user post the email invisible to everyone
      $pswd = test_input($_POST['pswd']);    // the user post password invisible to everyone
      if(empty($email)||empty($pswd))    // empty - blanc error
      {
      $error = "Enter Email and Password"; //  if empty email and password
      } 
      else
      {
        require 'connection.php'; // the file connection is used here to get the data from the database when the user enter 
        $query = "SELECT * from user where email = '$email' and password = '$pswd'"; // create query 
        $result = $con->query($query); // put the query in a variable result
        if(mysqli_num_rows($result) > 0)   
        {
          while($row = mysqli_fetch_array($result)) // the row in the database is equal to result
          $_SESSION['user_id'] = $row['id'];   // account already exist and start session
       header("Location:home.php");  // go to home page when the user login
        }
        else{   // admin page
          $query = "SELECT * from admin where email = '$email' and password = '$pswd'";
          $result = $con->query($query);
          if(mysqli_num_rows($result)>0)
          {
            while($row = mysqli_fetch_array($result))
            $_SESSION['admin_id'] = $row['id'];
         header("Location:admin/home.php"); // go to home admin

          }
          else {

            $error = "Invalid Email or Password";
          }

        }
      }
    }
    ?>
    <div class="formContainer">
      <h4 class="mb-5">Welcome to <span>LebMenu</span></h4>
      <form method="POST">
        <div class="mb-3 mt-3">
          <label for="email" class="form-label">Email:</label>
          <input
            type="email"
            class="form-control"
            id="email"
            placeholder="Enter email"
            name="email"
          />
        </div>
        <div class="mb-3">
          <label for="pwd" class="form-label">Password:</label>
          <input
            type="password"
            class="form-control"
            id="pwd"
            placeholder="Enter password"
            name="pswd"
          />
        </div>
        <div>
          <p class="text-danger">
          <?php echo $error ?>
          </p>
        </div>
        <div class="mb-3">
          <button type="submit" name="login">Login</button>
        </div>
        <div class="form-check mb-3">
          <p>
            <a href="home.php">Skip</a> Or <a href="signUp.php">Sign up</a> if you don't have an
            account
          </p>
        </div>
      </form>
    </div>
  </body>
</html>
