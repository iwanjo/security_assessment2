<?php

session_start();
require 'includes/sanitize.php';

include("header.php");
include("connect.php"); 


if (isset($_POST['del'])) {
  $id = sanitize(trim($_POST['id']));

  $sql_del = "DELETE from books where BookID = $id";
  $error = false;
  $result = mysqli_query($dbhandle, $sql_del);
    if ($result) {
      $error = true;
    }
}

?>

<html>
  <head>
    <title> Welcome Admin</title>
    <link rel="stylesheet" href="style.css">

 <head>
  
<body>
<ul>
  <li><a class="active" href="admin.php">Home</a></li>
  <li><a href="admin_student.php">Students</a></li>
  <li><a href="admin_faculty.php">Faculty</a></li>
  <li><a href="admin_librarian.php">Librarians</a></li>
  <li><a href="logout.php">Logout</a></li>
</ul>

  <div class="container">
    <h1>Welcome to the Admin Panel</h1>
    <h5>To manage students, faculty and Librarians, choose from the Navbar above</h5>
  </div>
    
</body>
</html>