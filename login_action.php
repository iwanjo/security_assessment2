<?php
include("connect.php"); 
$tbl_name="user_levels";

session_start();

if(isset($_POST['logIn_user'])){
     $email=$_POST['email']; 
     $password=$_POST['password'];
     $password=md5($password);

     //To protect mysql injection
     $email = stripslashes($email);
     $password = stripslashes($password);
     $email = mysqli_real_escape_string($dbhandle,$email);
     $password = mysqli_real_escape_string($dbhandle,$password);

     $result = mysqli_query($dbhandle, "SELECT * FROM $tbl_name WHERE email='$email' AND password='$password'");

     if(mysqli_num_rows($result) != 1){
          echo "<script>alert(' Wrong Email or Password Access Denied !!! Try Again');
          window.location='login.php';
          </script>";
          }else{
               $_SESSION['login_user'] = $_POST['email'];
               $row = mysqli_fetch_assoc($result);
               if($row['role'] == 'Librarian'){
                    header('location: librarian.php');
               }
               else if($row['role'] == 'Faculty' ){
                    header("Location: faculty.php");
               }
               else if($row['role'] == 'Student' ){
                    header("Location: student.php");
               }
               else if($row['role'] == 'Admin' ){
                    header("Location: admin.php");
               }
               else{
                    echo "<script>alert('Wrong Email or Password Access Denied !!! Try Again');
                    window.location='index.php';
                    </script>";
               }
          }

}
?>