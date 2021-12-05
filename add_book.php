<?php
require 'includes/sanitize.php';
include("header.php");
include("connect.php"); 

if (isset($_POST['submit'])) {

    $title = sanitize(trim($_POST['title']));
    $author = sanitize(trim($_POST['author']));
    $date = sanitize(trim($_POST['date']));
    $bookCopies = sanitize(trim($_POST['bookCopies']));
    $category = sanitize(trim($_POST['category']));

    $sql = "INSERT INTO books(BookTitle, Author, Date_Published, Available_Copies, Category)
    values ('$title', '$author', '$date', '$bookCopies', '$category')";

    $query = mysqli_query($dbhandle, $sql);

    if ($query) {
        echo "<script>alert('New Book has been added ');
					location.href ='librarian.php';
					</script>";
    }
    else {
        echo "<script>alert('Book not added!');
					</script>";	
    }
}

?>

<html>

<head>
    <title> Add Book </title>
    <link rel="stylesheet" href="style.css">

<head>

<body>

<div class="container">
<form method="post" action="add_book.php">
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
  	  <button type="submit" class="btn" name="submit" data-toggle="modal" data-target="#info">Add Book</button>
  	</div>

  </form>


</div>

</body>

</html>