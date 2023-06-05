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
   
   <?php require 'navigation.php'?>
    <div class="container"></div>

    <div class="container container2 py-2 my-2">
      <form method="GET">
        <div class="row">
          <div class="d-inline-flex align-items-center col-8 col-md-4 my-2">
            <label for="location" class="form-label mx-1"
              >Location:</label
            >
            <input
              type="text"
              class="form-control mx-1 border border-primary"
              id="location"
              placeholder="location"
              name="location"
            />
          </div>
          <!-- <div class="d-inline-flex align-items-center col-4 col-md-3 my-2 row">
            <div class="col-6">
            <label for="exampleInputEmail1" class="form-label mx-1 float-end"
              >rating up to:</label
            >
            </div>
            <div class="col-6">
            <select class="form-select mx-1 border border-primary float-start">
              <option value="4">4</option>
              <option value="3">3</option>
              <option value="2">2</option>
              <option value="1">1</option>
            </select>
            </div>
          </div> -->
          <div class="d-inline-flex align-items-center col-12 col-md-4 my-2">
            <input
              type="text"
              class="form-control mx-1 border border-primary"
              id="name"
              placeholder="name"
              name="name"
            />
            <button type="submit" class="search mx-1" name="search">Search</button>
          </div>
        </div>
      </form>
    </div>
    <div class="container container3 my-2 py-2 border border-primary">
      <div class="row p-2">

        <?php 
        require 'connection.php'; // database
        if(isset($_GET['search'])&&(!empty($_GET['name'])||!empty($_GET['location']))) // get all informations
        { require 'functions.php';  // necessary to include the functions.php to get the new data from the user
          $location = test_input($_GET['location']); // get location putting by the user
          $name = test_input($_GET['name']); // get name
          $queryLocation=""; // empty variable to any location putting by the user
          $queryName=""; // empty query to get the name putting by the user
          if(!empty($name)&&!empty($location)) // if the name and the location is not empty
          { // if both are not empty we have to check the database and get name and location
            $query = "SELECT * from post where name = '$name' and location = '$location' ORDER BY id DESC";
          }
          if(!empty($name)&&empty($location)) // get only name
          {
            $query = "SELECT * from post where name = '$name' ORDER BY id DESC";
          }
          if(empty($name)&&empty(!$location)) // get location 
          {
            $query = "SELECT * from post where location = '$location' ORDER BY id DESC";
          }

        }
        else // the user does not make any search here the data and the details to each restaurant will appear in the home page normally
        // in the else the user does not make any search and then bring all the data to all restaurant saved in the database
        $query = "SELECT * from post ORDER BY id DESC";  // if name and location were empty get the data for each restaurant from the database
        $result = $con->query($query); // put the query in a variable result
        while($row = mysqli_fetch_array($result)) // all the attribute in the row = to the result found
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
              $rateQuery = "SELECT * from user_rate_post where post_id = ".$row['id'];
              $rateResult = $con->query($rateQuery);
              $totalRate = 0;
              $countRate = 0;
              while($rateRow = mysqli_fetch_array($rateResult))
              {
              $totalRate+=$rateRow['rating'];
              $countRate++;
              }
              if($countRate==0)$countRate=1;
              $averageRate = $totalRate/$countRate;
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
              <?php 
              if($userID!=null)  // already a user logged-in and save a restaurant
              $saveQuery = "SELECT * from user_save_post where user_id = $userID and post_id = ".$row['id'];
              else $saveQuery = "SELECT * from user_save_post where user_id = 0";
              $saveResult = $con->query($saveQuery);
              if(mysqli_num_rows($saveResult)==0)
              {
              ?>
              <button name="save" value="<?php echo $row['id'] ?>" type="submit" class="btn btn-primary m-2 border-light" <?php if(empty($userID)) echo "disabled" ?>>Save</button> 
             <?php } else { ?>
              <button name="unsave" value="<?php echo $row['id'] ?>" type="submit" class="btn btn-primary m-2 border-light">Unsave</button> 
             <?php } ?>
              </form>
              <a href="<?php echo $row['menu_link'] ?>" class="btn btn-success m-2 border-light">Visit</a>
            </div>
          </div>
        </div>
        <div class="col-md-1 px-2 py-4"></div>
 
      <?php  }?>

      
      <?php 
       $query = "SELECT * from post ORDER BY id DESC";
       $result = $con->query($query);
       while($row = mysqli_fetch_array($result))
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
