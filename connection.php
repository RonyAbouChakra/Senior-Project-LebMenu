<?php     // for the database
$con = mysqli_connect("localhost", "root","")
Or die("<p>The database server is not
available.</p>");
@mysqli_select_db($con, "lebmenudb")
Or die("<p>The database is not
available.</p>");

