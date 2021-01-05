<?php
/*
Name :Mohammad Mahmudur  Rahman
Date: 2020/11/30
Subject : CIS-2288
Practical: Part-1
This page is about providing the user to login to the system
*/


$pageTitle = "login.php";

require_once ('./LoginHelper.php');


if (LoginHelper::isLoggedIn()){
    header("Location: ../../index.php");
}else{

    define("username", "siteAdminAccount");
    define("password", "CISpass");

    $_SESSION['sessionUserName'] = "";
    $_SESSION['sessionPass'] = "";


    $msg = "";

    require_once('../../util/Utilities.php');
    ?>


    <!doctype html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="../../css/bootstrap/bootstrap.min.css">
        <link rel="stylesheet" href="../../css/customStyle.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="../../js/bootstrap.min.js"></script>
        <title>Login</title>
    </head>
    <body>
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <a class="navbar-brand" href="../../index.php">Bookorama Management System</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="../../index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./login.php">Login</a>
                    </li>
                </ul>
            </div>
        </nav>
        <?php

        if (isset($_POST['submit'])){
            if (username==$_POST['userName'] && password==$_POST['pass']){
                $_SESSION['sessionUserName'] = username;
                $_SESSION['sessionPass'] = password;
                $msg = "<p class='alert alert-success'>Login credentials matched....! You are currently logged in</p>";
                $_SESSION['isLoggedIn'] = true;
                header("Location:../index.php");
            }
            elseif (empty($_POST['userName']) || empty($_POST['pass']))
            {
                if (empty($_POST['userName'])){
                    if (empty($_POST['pass'])){
                        $msg = "<p class='alert alert-danger'>Username and Password cannot be empty</p>";
                    }else{
                        $msg = "<p class='alert alert-danger'>Username cannot be empty</p>";
                    }
                }else{
                    $msg = "<p class='alert alert-danger'>Password cannot be empty</p>";
                }
            }
            else{
                $_SESSION['isLoggedIn'] = false;
                $msg = "<p class='alert alert-danger'>Invalid username and password combination....Try again</p>";
            }
        }else{
            header("login.php");
        }
        echo "<br>";
        if ($msg != ""){
            echo "<div class='login-form'>".$msg."</div>";
        }

        if (!($_SESSION['sessionUserName'] == username) && !($_SESSION['sessionPass'] == password)) {
            ?>


            <div class="login-form mt-2 mb-5">
                <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                    <fieldset class="scheduler-border">
                        <legend class="scheduler-border">Login</legend>
                        <div class="form-group">
                            <label for="userName">Username (siteAdminAccount)</label>
                            <input type="text" class="form-control" id="" placeholder="Enter Your Username" name="userName">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Password (CISpass)</label>
                            <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password"
                                   name="pass">
                        </div>
                        <input type="submit" class="btn btn-primary btn-block" name="submit" value="Login">
                    </fieldset>
                </form>
            </div>
            <?php
        }
        else{
            header('Location: ../../index.php');
        }
        ?>

        <?php include('../../layout/footer.php') ?>
    </div>
    </body>
    </html>
<?php } ?>