<?php
session_start();

include("connect.php");

// initializing variables
$fullname = "";
$email    = "";
$errors = array();

$tbl_name="user_levels";

// Register User
if (isset ($_POST['reg_user'])) {
    // receive all input values from the form
    $fullname = mysqli_real_escape_string($dbhandle, $_POST['fullname']);
    $email = mysqli_real_escape_string($dbhandle, $_POST['email']);
    $password_1 = mysqli_real_escape_string($dbhandle, $_POST['password_1']);
    $password_2 = mysqli_real_escape_string($dbhandle, $_POST['password_2']);
    $role = mysqli_real_escape_string($dbhandle, $_POST['role']);


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

    //validating password strength
    if (strlen($password_1) < 8){
        array_push($errors, "**Password should be >=8 characters");
    }
    if (!preg_match("@[0-9]@", $password_1)){
        array_push($errors, "**Password must include at least one number");
    }
    if (!preg_match("#[a-zA-Z]+#", $password_1)){
        array_push($errors, "**Password must include at least one letter");
    }
    if (!preg_match("@[^\w]@", $password_1)){
        array_push($errors, "**Password must include at least one special character");
    }
    if (!preg_match("@[A-Z]@", $password_1)){
        array_push($errors, "**Password must include at least one upper case letter");
    }

    // first check the database to make sure 
    // a user does not already exist with the same email
    $user_check_query = "SELECT * FROM user_levels WHERE email='$email' LIMIT 1";
    $res = mysqli_query($dbhandle, $user_check_query);
    $user = mysqli_fetch_assoc($res);
    if ($user) { // if user exists
        if ($user['email'] === $email) {
            array_push($errors, "**Email already exists");
        }
    }

    // Finally, register user if there are no errors in the form
    if (count($errors) == 0) {
        $password = md5($password_1);//encrypt the password before saving in the database
        
        $result = mysqli_query($dbhandle, "INSERT INTO $tbl_name (fullname,email,password,role) VALUES ('$fullname','$email','$password','$role')");
        if($result===TRUE)
        {
            echo "<script>alert('User Account has been saved in the database.');
            window.location='login.php';
            </script>";
        }      
        else
        {
            echo"The query did not run";
        }
    }

}


?>