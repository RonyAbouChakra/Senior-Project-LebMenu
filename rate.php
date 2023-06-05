<?php 
require 'navigation.php';
if(isset($_GET['rate']))    // the user choose the rate -- visible to everyone 
{
    $postID = $_GET['rate']; // the variable postid here is to get the id of the restaurant that we want to rate 
    $rating = $_GET['rating']; // the attribute rating from the table user_rate_post
    require 'connection.php';
    $query = "SELECT * from user_rate_post where user_id = $userID and post_id = $postID";
    $result = $con->query($query);
    if(mysqli_num_rows($result)== 1) // if the same user change the rate here we update only to the new rate / old user 
    {
        $query = "UPDATE user_rate_post SET rating = $rating where user_id = $userID and post_id = $postID";
        $con->query($query); // same user do a rate to the same post then here only we update
    }
    else
    {
        $query = "INSERT into user_rate_post values ($userID,$postID,$rating)"; /* old user or new user do a rate 
        for the first time 
    
        */
        $con->query($query);
    }
     header("Location:home.php");
}
?>