<?php
/**
 * Created by IntelliJ IDEA.
 * User: E
 * Date: 27/11/2017
 * Time: 17:38
 */
session_start();
header('Content-Type: text/');


//Connect to database
require_once "databaseConn.php";
$conn = connectToDatabase();

$user = $_GET['user'];
$project = $_SESSION['selectedProjectId'];

removeUserFromProject($conn, $user, $project);


function removeUserFromProject($conn, $user, $project){

    $result = $conn->query("DELETE FROM `UserProject` 
                            WHERE `user_id` = $user 
                            AND `project_id` = $project");

    if($result == TRUE){
        echo "Success";
    } else {
        echo $conn->error;
    }

}