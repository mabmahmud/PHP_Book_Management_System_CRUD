<?php

/*
Name :Mohammad Mahmudur  Rahman
Date: 2020/12/01
Subject : CIS-2288
Practical: Part-1
This page is about providing functionality to the user to insert and edit book information
*/

$pageTitle = "edit.php";

require ('./authentication/LoginHelper.php');

if (LoginHelper::isLoggedIn()) {


    if(isset($_GET['bookId'])) {

        //they have an isbn in the url
        $bookId = $_GET['bookId'];

        // connect to db
        require("../lib/config.php");

        $bookId = $mysqli->real_escape_string($bookId);

        // get the data for just the book we want to edit!
        $query = "SELECT * FROM books WHERE books.id = $bookId";
        $result = $mysqli->query($query);

        $num_results = $result->num_rows;

        if ($num_results == 0) {
            $message = "Book not found.";
        } else {
            $row = $result->fetch_assoc();
            $isbn = $row['isbn'];
            $title = $row['title'];
            $author = $row['author'];
            $price = $row['price'];
        }

        $result->free();
        $mysqli->close();
    } else {
        //the id is not provided
        $message = "Sorry, no id provided.";
    }
    ?>
    <!doctype html>
    <html>
    <head>
        <title>Edit Book Entry</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="../css/bootstrap/bootstrap.min.css">
        <link rel="stylesheet" href="../css/customStyle.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="../js/bootstrap.min.js"></script>
    </head>
    <body>
    <div class="container">

        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <a class="navbar-brand" href="../index.php">Bookorama Management System</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="../index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./authentication/logout.php">Logout</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link loggedIn-text"><?php echo "| Logged In as- ".$_SESSION['sessionUserName']; ?></a>
                    </li>
                </ul>
            </div>
        </nav>

        <h1>Edit Book Entry</h1>
        <?php
        // if message gets set above it means there is a problem and we don't have a book with that id to edit or it isn't provided
        if (isset($message)) {
            echo $message;
        } else {
            // we have all we need so let's display the book
            ?>

            <div class="form-content">
                <form action="update.php" method="post">
                    <fieldset  class="scheduler-border">
                        <legend  class="scheduler-border">Update Book</legend>


                        <div class="form-group">
                            <label for="isbn">ISBN (format 0-672-31509-2):</label>
                            <input type="text" class="form-control" id="isbn" value='<?php echo $isbn ?>' placeholder="Enter book isbn" name="isbn">
                        </div>
                        <div class="form-group">
                            <label for="author">Author:</label>
                            <input type="text" class="form-control" id="author" value='<?php echo $author ?>' placeholder="Enter book author" name="author">
                        </div>
                        <div class="form-group">
                            <label for="title">Title:</label>
                            <input type="text" class="form-control" id="title" value='<?php echo $title ?>' placeholder="Enter book title" name="title">
                        </div>
                        <div class="form-group">
                            <label for="price">Price $</label>
                            <input type="text" class="form-control" id="price" value='<?php echo $price ?>' placeholder="Enter book price" name="price">
                        </div>
                        <div class="form-group">
                            <input type="hidden" class="form-control" id="bookId" value='<?php echo $bookId ?>'  name="bookId">
                            <button type="submit" name="submit" class="btn btn-primary btn-block">Update</button>
                        </div>
                    </fieldset>
                </form>
            </div>
            <?php
        } // close the if no book found $message above
        include ('../layout/footer.php');
        ?>
    </body>
    </html>
    <?php
}else{
    header('Location: ./authentication/login.php');
}
?>