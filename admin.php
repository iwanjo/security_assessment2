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
    <title> Welcome Admin to the Library </title>
    <link rel="stylesheet" href="style.css">

 <head>
  
<body>
<ul>
  <li><a class="active" href="admin.php">Home</a></li>
  <li><a href="#news">Students</a></li>
  <li><a href="#news">Faculty</a></li>
  <li><a href="#news">Librarians</a></li>
  <li><a href="#contact">Borrowed Books</a></li>
  <li><a href="#about">Logout</a></li>
</ul>

  <div class="container">
    <div class="panel panel-default">
      <div class="panel-heading">
        <?php if(isset($error) === true) { ?>
          <div class="alert alert-success alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <strong>Record Deleted Successfully!</strong>
          </div>
        <?php } ?>

        <div class="row">
		  	  <a href="add_book.php"><button class="btn btn-success col-lg-3 col-md-4 col-sm-11 col-xs-11 button" style="margin-left: 15px;margin-bottom: 5px"><span class="glyphicon glyphicon-plus-sign"></span> Add Book</button></a>
			  <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 pull-right">
			  	<form method="post" action="admin.php" enctype="multipart/form-data">
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
                <form method = "POST" action="admin.php">
                  <input type='hidden' value="<?php echo $row['BookID']; ?>" name='id'>
                  <td>
                    <button name='del' type='submit' value='Delete' class='btn btn-warning' onclick='return Delete()'>DELETE</button>
                  </td>
                </form>
  
                <td>
                  <form action="edit_book.php" method="POST">
                  <input type='hidden' value="<?php echo $row['BookID']; ?>" name='id'>
                  <td>
                    <button name="edit" type="submit" class="edit-btn" >Edit</button>
                  </form>
                </td>
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
              <form method = "POST" action="admin.php">
                <input type='hidden' value="<?php echo $row['BookID']; ?>" name='id'>
                <td>
                  <button name='del' type='submit' value='Delete' class='btn btn-warning' onclick='return Delete()'>DELETE</button>
                </td>
              </form>

              <td>
                <form action="edit_book.php" method="POST">
                <input type='hidden' value="<?php echo $row['BookID']; ?>" name='id'>
                <td>
                  <button name="edit" type="submit" class="edit-btn" >Edit</button>
                </form>
              </td>
            </tbody>
          <?php
          }
        }

        ?>
        </table>
          
			</div>
      </div>

      

  </div>

  <script>
 function Delete() {
            return confirm('Would you like to delete the book?');
        }
</script>
    
</body>
</html>