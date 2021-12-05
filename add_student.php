<?php
require 'includes/sanitize.php';
include("header.php");
include("connect.php"); 

if (isset($_POST['submit'])) {

    $fullname = sanitize(trim($_POST['fullname']));
    $email = sanitize(trim($_POST['email']));
    $password = sanitize(trim($_POST['password']));
    $role = sanitize(trim($_POST['role']));

    $sql = "INSERT INTO `user_levels`(`fullname`, `email`, `password`, `role`)
    values ('$fullname', '$email', '$password', '$role')";

    $query = mysqli_query($dbhandle, $sql);

    if ($query) {
        echo "<script>alert('New Student has been added ');
					location.href ='admin_student.php';
					</script>";
    }
    else {
        echo "<script>alert('Student not added!');
					</script>";	
    }
}

?>

<html>

<head>
    <title> Add Student </title>
    <link rel="stylesheet" href="style.css">

<head>

<body>

<div class="container">
<form method="post" action="add_student.php">

  	<div class="input-group">
  	  <label>Full Name</label>
  	  <input type="text" name="fullname" value=" " required placeholder = "Enter Student's Full Name">
  	</div>
  	<div class="input-group">
  	  <label>Email Address</label>
  	  <input type="text" name="email" required placeholder="Enter student email address">
  	</div>
  	<div class="input-group">
  	  <label>Password</label>
  	  <input type="password" name="category" required placeholder="Enter Student Password">
  	</div>
      <div class="input-group">
  	  <label>Role</label>
  	  <input type="text" name="role" value=" " placeholder="Enter Role" required>
  	</div>
  	<div class="input-group">
  	  <button type="submit" class="btn" name="submit" data-toggle="modal" data-target="#info">Add Student</button>
  	</div>

  </form>


</div>

</body>

</html>