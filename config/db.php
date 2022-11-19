<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    
    $con = mysqli_connect("localhost" , "root" , "root" , "project_149");
    if(mysqli_connect_errno()){
        echo "Failed to connect to MySQL ".mysqli_connect_error();
        exit();
    }