<?php
/**
 * Created by IntelliJ IDEA.
 * User: E
 * Date: 09/11/2017
 * Time: 18:56
 */

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