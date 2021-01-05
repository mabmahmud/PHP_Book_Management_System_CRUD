<?php
/*
Name :Mohammad Mahmudur  Rahman
Date: 2020/12/03
Subject : CIS-2288
Practical: Part-1
This page is about providing functionality to the page delete to prepare to delete
*/


require ('./authentication/LoginHelper.php');

if (LoginHelper::isLoggedIn()) {
    $bookId = "";
    $msg="";
// Process delete operation after confirmation
    if (isset($_GET["bookId"]) && !empty($_GET["bookId"])){
        //Create DB connection object
        require_once("../lib/config.php");
        //Sanitize the parameter
        $bookId = $mysqli->real_escape_string($_GET['bookId']);
        // Prepare a delete statement
        if ($stmt = $mysqli->prepare("DELETE FROM books WHERE books.id = ?")) {
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("i", $bookId);

            //Set parameter and execute
            $bookId = $mysqli->real_escape_string($_GET["bookId"]);
            // Attempt to execute the prepared statement
            if ($stmt->execute()) {

                // Close statement
                $stmt->close();

                $msg= "Book ".$bookId." deleted";
                // Records deleted successfully. Redirect to landing page
                header("location: viewBooks.php?msg=".$msg);
                exit();
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
        // Close connection
        $mysqli->close();

    } else{

        $msg = "Deletion Error" ;}
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
    <div id="container">

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