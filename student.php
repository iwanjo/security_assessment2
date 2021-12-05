<?php

session_start();
require 'includes/sanitize.php';

include("header.php");
include("connect.php"); 


?>

<html>
  <head>
    <title> Welcome to the ALU Library </title>
    <link rel="stylesheet" href="style.css">

 <head>
  
<body>
<ul>
  <li><a class="active" href="student.php">Home</a></li>
  <li><a href="#news">My Borrowed Books</a></li>
  <li><a href="#news">Profile</a></li>
  <li><a href="#about">Logout</a></li>
</ul>

  <div class="container">
    <div class="panel panel-default">
      <div class="panel-heading">
			  <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 pull-right">
			  	<form method="post" action="student.php" enctype="multipart/form-data">
			  		<div class="input-group pull-right">
				      <span class="input-group-addon">
				        <button type="submit" class="btn btn-success" name="search">Search</button> 
				      </span>
				      <input type="text" class="form-control" name="text" required>
			      </div>
			  	</form>
			    
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>BookTitle</th>
            <th>Author</th>
            <th>Date Published</th>
            <th>Available</th>
            <th>Category</th>
            <th>Action</th>
          </tr>
        </thead>

        <?php

        if (isset($_POST['search'])) {
          $query = mysqli_query($dbhandle, "SELECT * FROM books where BookTitle like '%$_POST[text]%'");

          if (mysqli_num_rows($query)==0) {
            echo "Sorry. Books not available. Try searching again!";
          }
          else {
            while($row = mysqli_fetch_array($query)){ ?>
              <tbody class="table-elements">
                <td><?php echo $row['BookTitle']; ?></td>
                <td><?php echo $row['Author']; ?></td>
                <td><?php echo $row['Date_Published']; ?></td>
                <td><?php echo $row['Available_Copies']; ?></td>
                <td><?php echo $row['Category']; ?></td>
                <form method = "POST" action="student.php">
                  <input type='hidden' value="<?php echo $row['BookID']; ?>" name='id'>
                  <td>
                    <button name='borrow' type='submit' value='Borrow' class='btn btn-warning'>Borrow</button>
                  </td>
                </form>
              </tbody>
            <?php
            }
        }
      }
      
      else{
          $sql2 ="SELECT * from books";
          $query2 = mysqli_query($dbhandle, $sql2);
          $counter = 1;
          while($row = mysqli_fetch_array($query2)){ ?>
            <tbody class="table-elements">
              <td><?php echo $row['BookTitle']; ?></td>
              <td><?php echo $row['Author']; ?></td>
              <td><?php echo $row['Date_Published']; ?></td>
              <td><?php echo $row['Available_Copies']; ?></td>
              <td><?php echo $row['Category']; ?></td>
              <form method = "POST" action="student.php">
                <input type='hidden' value="<?php echo $row['BookID']; ?>" name='id'>
                <td>
                  <button name='borrow' type='submit' value='Borrow' class='btn btn-warning'>Borrow</button>
                </td>
              </form>
            </tbody>
          <?php
          }
        }

        ?>
        </table>
          
			</div>
      </div>

      

  </div>
    
</body>
</html>