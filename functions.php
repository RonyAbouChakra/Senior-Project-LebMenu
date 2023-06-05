<?php   // code to get the data from the user
function test_input($data) // check the data entered from the user before putting the data inside the database
{
    $data = trim($data); // remove the spaces between strings - the data or the informations enterd by the user 
    $data = stripslashes($data); // remove /(slash) to avoid a problem in the database
    $data = htmlspecialchars($data); // remove special html characters 
    if(empty($data)) // if there is no data from the user
    $data = 0;
    return $data;

}
