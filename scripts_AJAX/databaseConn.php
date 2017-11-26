<?php


function connectToDatabase(){
    $host = "devweb2017.cis.strath.ac.uk";
    $user = "cs312_h";
    $pass = "Phith9ahfiye";
    $database = "cs312_h";

    $conn = new mysqli($host, $user, $pass, $database);
    if($conn->connect_error)
        die("conn failed: ".$conn->connect_error);

    return $conn;
}