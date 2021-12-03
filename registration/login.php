<?php
    include('server.php')
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
<img src="alu-full-logo.png" alt="African Leadership University Logo" class="logo">
  <div class="header">
  	<h2>ALU Library</h2>
      <h2>Log In</h2>
  </div>
  <form method="post" action="login.php">
  	<?php include('errors.php'); ?>
  	<div class="input-group">
  	  <label>Email</label>
  	  <input type="email" name="email" value="<?php echo $email; ?>">
  	</div>
	<div class="input-group">
		<label>Role</label>
        <select name="role">
			<option value="keeper">Select role</option>
            <option value="Librarian">Librarian</option>
            <option value="Faculty">Faculty</option>
            <option value="Student">Student</option>
        </select>
    </div>
  	<div class="input-group">
  	  <label>Password</label>
  	  <input type="password" name="password_1">
  	</div>
  	  <button type="submit" class="btn" name="logIn_user">Log In</button>
  	</div>
  	<p>
  		Don't have an account? <a href="register.php">Sign Up</a>
  	</p>
  </form>
</body>
</html>