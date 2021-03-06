<html>
 <?php
 include("header.php");
 include("insert.php");
 
 ?>
 <!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>ALU Library Registration</title>
        <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="alu-full-logo.png" rel="icon" />
        <link rel="stylesheet" href="styleform.css">
</head>
<body>
<a href='index.php'> 
<img src="alu-full-logo.png" alt="African Leadership University Logo" class="logo">
</a>
  <div class="header">
  	<h2>ALU Library</h2>
	  <h2>Registration</h2>
  </div>
  <form method="post" action="register.php">
  <?php include('errors.php'); ?>
	<div class="input-group">
  	  <label>Fullname</label>
  	  <input type="text" name="fullname" value=" ">
  	</div>
  	<div class="input-group">
  	  <label>Email</label>
  	  <input type="email" name="email" value=" " required>
  	</div>
      <div class="input-group">
		<label>Role</label>
        <select name="role" required>
            <option value="Student">Student</option>
            <option value="Faculty">Faculty</option>
            <option value="Librarian">Librarian</option>
        </select>
    </div>
  	<div class="input-group">
  	  <label>Password</label>
  	  <input type="password" name="password_1" required>
  	</div>
  	<div class="input-group">
  	  <label>Confirm password</label>
  	  <input type="password" name="password_2" required>
  	</div>
  	<div class="input-group">
  	  <button type="submit" class="btn" name="reg_user">Register</button>
  	</div>
  	<p>
  		Already have an account? <a href="login.php">Sign in</a>
  	</p>
  </form>
</body>
</html>