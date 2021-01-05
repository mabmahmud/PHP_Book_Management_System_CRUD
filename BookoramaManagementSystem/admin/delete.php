<?php
/*
Name :Mohammad Mahmudur  Rahman
Date: 2020/12/01
Subject : CIS-2288
Practical: Part-1
This page is about providing functionality to the user to delete book
*/

require ('./authentication/LoginHelper.php');

if (LoginHelper::isLoggedIn()) {

    require_once("../lib/config.php");
    $bookId = "";
    $msg = "";
// Process delete operation after confirmation
    if (isset($_GET["bookId"]) && !empty($_GET["bookId"])) {
        //Sanitize the parameter
        $bookId = $mysqli->real_escape_string($_GET['bookId']);
        // example UPDATE query
        $query = "DELETE FROM books WHERE books.id =$bookId ";
        $result = $mysqli->query($query);

        if ($result) {
            $msg = "Record deleted successfully. ".$mysqli->affected_rows . " book deleted from database. <a href='manageBooks.php'>View all Books</a>";

        } else {
            $msg = "Error deleting record: " . $mysqli->error;
        }

        $mysqli->close();

    }
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>View Record</title>
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

            <div class="collapse navbar-collapse" id="">
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

        <h2>CIS Book Inventory</h2>
        <p class="error"><?php echo $msg ?></p>

        <?php include ('../layout/footer.php') ?>

    </div>
    </body>
    </html>
    <?php
}else{
    header('Location: ./authentication/login.php');
}
?>