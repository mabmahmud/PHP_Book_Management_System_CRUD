<?php
/*
Name :Mohammad Mahmudur  Rahman
Date: 2020/12/01
Subject : CIS-2288
Practical: Part-1
This page is about providing functionality to the user to logout
*/


session_start();
session_unset();


session_destroy();
header("Location: ../../index.php");
die();
