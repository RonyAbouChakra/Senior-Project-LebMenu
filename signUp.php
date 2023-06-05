<!DOCTYPE html>
<html lang="en">
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
    <title>Register</title>
  </head>
  <body>
    <?php 
    $error="";
    if(isset($_POST['signUp']))
    {
      require 'functions.php'; // file obligatory
      $name = test_input($_POST['name']);   // user post name invisible to everyone
      $email = test_input($_POST['email']);  // post email invisible to everyone
      $pswd = test_input($_POST['pswd']);
      $cpswd = test_input($_POST['cpswd']);
      if(empty($name)||empty($email)||empty($pswd)||empty($cpswd))
      {
        $error = "Empty field or fields!";
      }
      else
      {
          if($pswd!=$cpswd)  // the first password not equal to the saecond password
          {
            $error = "wrong confirmation password!";
          }
          else{
      require 'connection.php'; // connection to get the email of the user if he has already an account
      $query =  "SELECT * from user where email = '$email' ";
      $result = $con->query($query);
      if(mysqli_num_rows($result)!= 0) // if the email entered by the new user is already used by an old user
      {
        $error = "email already used!";
      }
      else  // if the user does not have an account already
      {
        $query = "INSERT into user (email,password,name) values ('$email','$pswd','$name')"; 
        $con->query($query);
        header("location:login.php"); // go to home page
      }}
      }
    }
    ?>
    <div class="formContainer">
      <h4 class="mb-5">Sign up with <span>LebMenu</span></h4>
      <form method="POST">
        <div class="mb-3 mt-3">
          <label for="name" class="form-label">Name:</label>
          <input
            type="text"
            class="form-control"
            id="name"
            placeholder="Enter name"
            name="name"
          />
        </div>
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
        <div class="mb-3">
          <label for="cpwd" class="form-label">Confirm Password:</label>
          <input
            type="password"
            class="form-control"
            id="cpwd"
            placeholder="Enter password"
            name="cpswd"
          />
        </div>
        <div>
          <p class="text-danger">
          <?php echo $error ?>
          </p>
        </div>
        <div class="mb-3">
          <button type="submit" name="signUp">Sign In</button>
        </div>
        <div class="form-check mb-3">
          <p>Back to <a href="login.php">Login</a></p>
        </div>
      </form>
    </div>
  </body>
</html>
