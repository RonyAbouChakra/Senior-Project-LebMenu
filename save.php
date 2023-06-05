<?php 
require 'navigation.php';   // the presence of the navigation is necessary
if(isset($_GET['save']))   // get function is where the informations is visible to everyone
{   
    $postID = $_GET['save']; // variable postid and put the get informations is visible to everyone
    require 'connection.php';  // use the database
    $query = "INSERT into user_save_post values ($userID,$postID)"; // create a query to insert the userid and the postid
    $result = $con->query($query); // put the query in a variable result
}
if(isset($_GET['unsave']))   // delete post 
{   
    $postID = $_GET['unsave'];
    require 'connection.php';
    $query = "DELETE from user_save_post where user_id = $userID and post_id = $postID";
    $result = $con->query($query);
}
if($userID!=null) // the user already give a rate to this specific restaurant then get him to the page saved
header("Location:saved.php");  // go to saved page
else header("Location:home.php"); // can not rate because is not a user and keep the user skipped in the home page
?>