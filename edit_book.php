<?php
    require 'includes/sanitize.php';
    include("header.php");
    include("connect.php");


	if(isset($_POST['edit_book'])){
        $id = sanitize(trim($_GET['id']));
		$title = sanitize(trim($_POST['title']));
        $author = sanitize(trim($_POST['author']));
        $date = sanitize(trim($_POST['date']));
        $bookCopies = sanitize(trim($_POST['bookCopies']));
        $category = sanitize(trim($_POST['category']));
        $sql = "UPDATE books SET BookTitle = $title, Author = $author, Date_Published = $date, Available_Copies = $bookCopies, Category = $category WHERE BookID=$id" or die(mysqli_error());

        $query = mysqli_query($dbhandle, $sql);

		
		if ($query) {
            echo "<script>alert('Book has been updated successfully ');
                        location.href ='librarian.php';
                        </script>";
        }
        else {
            echo "<script>alert('Book has not been updated!');
                        </script>";	
        }
	}


?>

<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <div class="container">
        <form action="edit_book.php" method="POST" enctype ="multipart/form-data">
          <div class="input-group">
  	        <label>Book Title</label>
  	        <input type="text" name="title" value=" " placeholder="Enter Book Title" required>
  	      </div>
        <div class="input-group">
          <label>Author</label>
          <input type="text" name="author" value=" " required placeholder = "Enter Author">
        </div>
          <div class="input-group">
        <label>Date Published</label>
            <input type="date" name="date" value=" " placeholder="Enter Date" required>

        </div>
        <div class="input-group">
          <label>Available Copies</label>
          <input type="number" name="bookCopies" min="0" required placeholder="Enter number of copies">
        </div>
        <div class="input-group">
          <label>Category</label>
          <input type="text" name="category" required placeholder="Enter book category">
        </div>
        <div class="input-group">
          <button type="edit_book" class="btn" name="edit_book" data-toggle="modal" data-target="#info">Edit Book</button>
        </div>
    </form>
        </div>
       
        
    </body>
</html>