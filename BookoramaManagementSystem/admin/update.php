<?php

/*
Name :Mohammad Mahmudur  Rahman
Date: 2020/12/03
Subject : CIS-2288
Practical: Part-1
This page is about inserting and updating records with PHP and MySql
*/

require ('./authentication/LoginHelper.php');

if (LoginHelper::isLoggedIn()) {
    ?>
    <!doctype html>
    <html>
    <head>
        <title>Update</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="../css/bootstrap/bootstrap.min.css">
        <link rel="stylesheet" href="../css/customStyle.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="../js/bootstrap.min.js"></script>
    </head>
    <body>
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <a class="navbar-brand" href="../index.php">Bookorama Management System</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
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
        <h1>Book-O-Rama</h1>

        <?php
        if(isset($_POST['submit'])) {
            // create short variable names
            $bookId = $_POST['bookId'];
            $isbn = $_POST['isbn'];
            $author = $_POST['author'];
            $title = $_POST['title'];
            $price = $_POST['price'];

            if (empty($isbn) || empty($author) || empty($title) || empty($price)) {
                echo "You have not entered all the required details.<br />"
                    . "Please go back and try again.</body></html>";
                exit;
            }

            require("../lib/config.php");
            //$bookId=$mysqli->real_escape_string($bookId);
            $isbn = $mysqli->real_escape_string($isbn);
            $author = $mysqli->real_escape_string($author);
            $title = $mysqli->real_escape_string($title);
            $price = $mysqli->real_escape_string(doubleval($price));

            // example UPDATE query
            $query = "UPDATE books SET isbn='$isbn', title='$title', author='$author', price=$price WHERE books.id=$bookId LIMIT 1";
            $result = $mysqli->query($query);

            if ($result) {
                echo "<p class='alert alert-success'>".$mysqli->affected_rows . " book updated in database. <a href='../index.php'>View all Books</a></p>";
                //select book
                //Order Detail Report Query
                $query = "SELECT * FROM `books` where books.id=$bookId";


                // Here we use our $db object created above and run the query() method. We pass it our query from above.
                $result = $mysqli->query($query);

                // Here we 'get' the num_rows attribute of our $result object - this is key to knowing if we should show the results or
                // display an error message, or perhaps just to say we don't have any results.
                $num_results = $result->num_rows;


                if ($num_results > 0) {
                    //  $result->fetch_all(MYSQLI_ASSOC) returns a numeric array of all the books retrieved with the query
                    $books = $result->fetch_all(MYSQLI_ASSOC);

                    echo "<table class='table table-bordered'><tr>";
                    //This dynamically retrieves header names
                    foreach ($books[0] as $k => $v) {
                        echo "<th>" . $k . "</th>";
                    }
                    echo "</tr>";
                    //Create a new row for each book
                    foreach ($books as $book) {
                        echo "<tr>";
                        foreach ($book as $k => $v) {
                            echo "<td>" . $v . "</td>";
                        }
                        echo "</tr>";
                    }
                    echo "</table>";
                } else {
                    // if no results
                    echo "<p>Sorry there are no entries in the database.</p>";
                }
                $result->free();
                $mysqli->close();

            } else {
                echo "<p class='alert alert-danger'>An error has occurred.  The item was not updated.</p>";
            }
        }else{
            header("location:manageBooks.php");
            exit();

        }
        include('../layout/footer.php')
        ?>
    </div>
    </body>
    </html>
    <?php
}else{
    header('Location: ./authentication/login.php');
}
?>