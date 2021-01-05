
<?php
/*
Name :Mohammad Mahmudur  Rahman
Date: 2020/1/01
Subject : CIS-2288
Practical: Part-1
This page is about providing functionality to user the whether logged in or not
*/



session_start();
class LoginHelper
{
    public static function isLoggedIn(){
        if(!isset($_SESSION['isLoggedIn'])){
            $_SESSION['isLoggedIn'] = false;
        }

        if ($_SESSION['isLoggedIn']){
            return true;
        }
        else{
            return false;
        }
    }
}