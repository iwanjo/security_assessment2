<?php
$username="root";  
$password="";  
$hostname = "localhost"; 

//connection string with database  
$dbhandle = mysqli_connect($hostname, $username, $password)  
or die("Unable to connect to MySQL");  
echo "";  

// connect with database  
$selected = mysqli_select_db($dbhandle, "security")  
or die("Could not connect to database"); 

?>