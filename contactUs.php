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
    <link rel="stylesheet" href="./Assets/CSS/home.css" />
    <link rel="stylesheet" href="./Assets/CSS/contact.css" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <title>Contact Us</title>
  </head>
  <body>
  <?php require 'navigation.php'?>
    <div class="container-fluid p-5">
      <div class="row">
        <div class="col-12 col-md-5 part1 text-center py-4 px-5 text-white">
            
                <i class="material-icons emailIcon " style="font-size: 200px;" >email</i>
                <h4 class="mt-4">
 If you have questions or you want to get in touch use the form.
 We look forward to hearing from you!
                </h4>
       
        </div>
        <div class="col-12 col-md-7 px-5 part2">
          <div class="px-5">
          <?php 
            $error = "";  // empty variable error
            if(isset($_POST['send'])) // informations is invisible to everyone and isset that there is a button to press from the user
            {   
              if($userID!=null) // userid that the user has already an account  
              {
                require 'functions.php'; // to get the data from the user 
                $message = test_input($_POST['message']); // create a variable message to put the message of the user
                if(!empty($message)) // if the variable $message is filled by the user
                {
                  require 'connection.php'; // database
                  $date = date('Y-m-d',time()); // the function date in php
                  $query = "INSERT into message (content,date,user_id) values ('$message','$date',$userID)";
                  $con->query($query);
                  $error = '<p class="text-success">message sent successfully!</p>'; // there is data
                }
                else 
                {
                 $error = '<p class="text-danger">You cannot send empty message!</p>'; // press the button send without any text
                }}
                else $error = '<p class="text-danger">you need to login first!</p>'; // if the user has not an account
            }
            ?>
            <form method="POST">
              <div class="mb-3 mt-3">
                <textarea
                  class="form-control"
                  rows="20"
                  id="comment"
                  name="message"
                ></textarea>
              </div>
              <div class="text-center">
                <?php echo $error ?>
              </div>
              <div class="text-center">
                <button type="submit" class="sendButton px-4 py-2" name="send">
                  Send
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>
