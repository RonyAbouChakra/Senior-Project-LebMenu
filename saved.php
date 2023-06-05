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
    <title>Home</title>
  </head>
  <body>
   <?php  require 'navigation.php';?>
    
    <div class="container container3 my-2 py-2 border border-primary">
      <div class="row p-2">
    
      <?php 
        require 'connection.php';
        $query = "SELECT *
        FROM post
        RIGHT outer JOIN user_save_post ON post.id = user_save_post.post_id  where user_save_post.user_id = $userID ORDER BY id DESC";
        $result = $con->query($query); // put the data inside a query
        while($row = mysqli_fetch_array($result)) /*$row mean the row in the table == to the result inside
                                                    the query after fetching the array*/
        {
        ?>

        <div class="post mb-2 px-2 py-4 col-12 col-lg-5">
          <div class="row">
            <div class="col-md-4 py-1">
              <img
                src="./Assets/images/<?php echo $row['image_source'] ?>"
                alt=""
                class="w-100 h-100"
              />
            </div>
            <div class="col-md-5 d-flex flex-column justify-content-between">
              <h6>Name: <span><?php echo $row['name'] ?></span></h6> 
              <h6>Location: <span><?php echo $row['location'] ?></span></h6>
              <h6>Description: <span><?php echo $row['description'] ?></span></h6>
              <?php 
              $rateQuery = "SELECT * from user_rate_post where post_id = ".$row['id']; // select from the table save
              $rateResult = $con->query($rateQuery); // put the query in a variable result
              $totalRate = 0; // set the total to 0 
              $countRate = 0; // count from 0 
              while($rateRow = mysqli_fetch_array($rateResult)) // result found in the array 
              {
              $totalRate+=$rateRow['rating']; // update total 
              $countRate++; // increment countrate
              }
              if($countRate==0)$countRate=1;   // add all the rates entry in the table and divides them by the couutrate
              $averageRate = $totalRate/$countRate; // get average
              ?>
              <h6>Rate: <span><?php echo $averageRate ?></span></h6>
            </div>
            <div class="col-md-3 d-flex flex-column justify-content-between">
              <button type="button" class="btn btn-warning text-white m-2 border border-light"
              data-bs-toggle="modal" data-bs-target="#rate<?php echo $row['id'] ?>" 
              <?php if(empty($userID)) echo "disabled" ?> 
              >
                Rate
              </button>

              <form action="save.php" method="get">
              <?php // get from the save class
              $saveQuery = "SELECT * from user_save_post where user_id = $userID and post_id = ".$row['id'];
              $saveResult = $con->query($saveQuery); // save the result in a query
              if(mysqli_num_rows($saveResult) == 0) // there is nothing saved by users
              {
              ?>
              <button name="save" value="<?php echo $row['id'] ?>" type="submit" class="btn btn-primary m-2 border-light" <?php if(empty($userID)) echo "disabled" ?>>Save</button> 
               <!-- press the save button to save -->
             <?php } else { ?>
              <button name="unsave" value="<?php echo $row['id'] ?>" type="submit" class="btn btn-primary m-2 border-light" <?php if(empty($userID)) echo "disabled" ?>>Unsave</button> 
               <!-- press the unsave button to unsave -->
             <?php } ?>
              </form>
              <a href="<?php echo $row['menu_link'] ?>" class="btn btn-success m-2 border-light">Visit</a>
            </div>
          </div>
        </div>
        <div class="col-md-1 px-2 py-4"></div>
 
      <?php  }?>

      
      <?php 
       $query = "SELECT * from post ORDER BY id DESC";  // get the name and all other details about the restaurant
       $result = $con->query($query); // variable result and put inside it the query
       while($row = mysqli_fetch_array($result)) // $row all the row containing all attributes == result 
       {
      ?>
      <!-- Rate Modal -->
<div class="modal" id="rate<?php echo $row['id'] ?>">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal body -->
      <div class="modal-body">
        <form action="rate.php" method="get">
        <div class="row">
          <div class="col-6">
      <select class="form-select" name="rating">
  <option value="1">1</option>
  <option value="2">2</option>
  <option value="3">3</option>
  <option value="4">4</option>
  <option value="5">5</option>
</select> 
</div>
<button name="rate" class="btn btn-success col-6" value="<?php echo $row['id'] ?>">submit</button>
</div>
</form>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>
<?php } ?>
      
   
      </div>
    </div>
  </body>
</html>