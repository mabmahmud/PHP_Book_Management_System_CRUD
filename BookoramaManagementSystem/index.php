<?php
/*
Name :Mohammad Mahmudur  Rahman
Date: 2020/12/04
Subject : CIS-2288
Practical: Part-1
This page is about showing all the books from DB
*/


require('./admin/authentication/LoginHelper.php');
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="./css/bootstrap/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="./css/customStyle.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <title>Bookorama Application</title>
</head>
<body>
<div class="container">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="./index.php">Bookorama Management System</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="./index.php">Home</a>
                </li>
                <?php if (!LoginHelper::isLoggedIn()){ ?>
                    <li class="nav-item">
                        <a class="nav-link" href="./admin/authentication/login.php">Login</a>
                    </li>
                <?php }else {?>

                    <li class="nav-item">
                        <a class="nav-link" href="./admin/manageBooks.php">Admin Panel</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./admin/authentication/logout.php">Logout</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link loggedIn-text"><?php echo "| Logged In as- ".$_SESSION['sessionUserName']; ?></a>
                    </li>

                <?php } ?>
            </ul>
        </div>
    </nav>
    <div class="main-content">

        <?php
        // set up connection
        require("lib/config.php");

        //Sort type
        if (isset($_GET['author'])){
            $sortedBy = " author asc";
        }
        elseif (isset($_GET['price'])){
            $sortedBy = " price asc";
        }else{
            $sortedBy = " title asc";
        }
        $sort = " order by".$sortedBy;




        //Display book inventory
        $query = "SELECT id,isbn,author,title,price FROM books".$sort;


        // Here we use our $db object created above and run the query() method. We pass it our query from above.
        $result = $mysqli->query($query);

        $num_results = $result->num_rows;
        if(isset($_GET['msg'])) {
            echo "<p>{$_GET['msg']}</p>";
        }
        echo "<h2>CIS Book Inventory</h2>";
        echo "<p>Number of books found: " . $num_results . "</p>";
        echo "<table class='table table-bordered table-striped'>";
        echo "<thead>";
        if ($num_results > 0) {
            //  $result->fetch_all(MYSQLI_ASSOC) returns a numeric array of all the books retrieved with the query
            $books = $result->fetch_all(MYSQLI_ASSOC);
            echo "<table class='table table-hover'><thead><tr>";
            //This dynamically retrieves header names
            foreach ($books[0] as $k => $v) {
                if ($k=='author'){
                    echo "<th><a href='./index.php?author=".urldecode($k)."'>" . ucwords($k) . "<span>&#94;</span></a></th>";
                }
                elseif ($k=='price'){
                    echo "<th><a href='./index.php?price=".urldecode($k)."'>" . ucwords($k) . "<span>&#94;</span></a></th>";
                }
                else{
                    echo "<th>" . ucwords($k) . "</th>";
                }

            }
            if (LoginHelper::isLoggedIn()){
                echo "<th>Edit</th>";
                echo "<th>Delete</th>";
            }

            echo "</tr></thead>";
            echo "<tbody>";
            //Create a new row for each book
            foreach ($books as $book) {
                echo "<tr class=''>";
                $i = 0;

                foreach ($book as $k => $v) {

                    if ($k == 'id') {
                        echo "<td>" . $v . "</td>";
                        $bookId = $v;
                    } else {
                        if ($k == 'price'){
                            echo "<td>$" . $v . "</td>";
                        }
                        else{
                            echo "<td>" . $v . "</td>";
                        }

                    }
                    if (LoginHelper::isLoggedIn()){

                        if (($i == count($book) - 1)) {
                            echo "<td>";
                            //echo "<div class='btn-toolbar'>";
                            echo "<a href='./admin/edit.php?bookId=" . $bookId . "' title='Edit Record' class='btn btn-warning btn-xs btnMargin' data-toggle='tooltip'><i class='fa fa-edit'></i></a>";
                            echo "</td>";
                            echo "<td>";
                            echo "<a href='./admin/delete.php?bookId=" . $bookId . "' title='Delete Record' class='btn btn-danger btn-xs' data-toggle='tooltip'><i class='fa fa-trash'></i></a>";
                            //echo "</div>";
                            echo "</td>";
                        }
                    }
                    $i++;
                }
                echo "</tr>";
            }

            if (LoginHelper::isLoggedIn()){
                echo "<tr><td colspan='7'>";
                echo "<a href='./admin/newBook.php' title='View Record' class='btn btn-info' data-toggle='tooltip'><i class='fa fa-plus-circle'></i>Add A New Book</a>";
                echo "</td></tr>";
            }

            echo "</tbody>";
            echo "</table>";
        }
        // free result and disconnect
        $result->free();
        $mysqli->close();
        ?>
    </div>
    <?php include ('./layout/footer.php')?>
</div>
<script src="./js/bootstrap.min.js" crossorigin="anonymous"></script>
</body>
</html>