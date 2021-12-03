<?php
session_start();

// initializing variables
$fullname = "";
$email    = "";
$errors = array(); 

// connect to the database
$db = mysqli_connect('localhost', 'root', '', 'security_registration');

// REGISTER USER
if (isset($_POST['reg_user'])) {
  // receive all input values from the form
  $fullname = mysqli_real_escape_string($db, $_POST['fullname']);
  $email = mysqli_real_escape_string($db, $_POST['email']);
  $password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
  $password_2 = mysqli_real_escape_string($db, $_POST['password_2']);
  $role = mysqli_real_escape_string($db, $_POST['role']);

  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
  if (empty($fullname)) { array_push($errors, "**fullname is required"); }
  if (empty($email)) { array_push($errors, "**Email is required"); }
  if (empty($password_1)) { array_push($errors, "**Password is required"); }
  if ($password_1 != $password_2) {
	array_push($errors, "**The two passwords do not match");
  }

  //validating email
  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) { 
    array_push($errors, "**Invalid email format");
  }

  // first check the database to make sure 
  // a user does not already exist with the same email
  $user_check_query = "SELECT * FROM users WHERE email='$email' LIMIT 1";
  $result = mysqli_query($db, $user_check_query);
  $user = mysqli_fetch_assoc($result);
  
  if ($user) { // if user exists
    if ($user['email'] === $email) {
      array_push($errors, "email already exists");
    }
  }

  // Finally, register user if there are no errors in the form
  if (count($errors) == 0) {
  	$password = md5($password_1);//encrypt the password before saving in the database

  	$query = "INSERT INTO users (fullname, email, password, role) 
  			  VALUES('$fullname', '$email', '$password', '$role')";
  	mysqli_query($db, $query);
  	$_SESSION['fullname'] = $fullname;
  	$_SESSION['success'] = "You are now logged in";
  	header('location: login.php');
  }
}
