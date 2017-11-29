<?php
/**
 * Created by IntelliJ IDEA.
 * User: E
 * Date: 17/11/2017
 * Time: 23:56
 */
require  "Project.php";
session_start();
header('Content-Type: text/');

//Connect to database
require_once "databaseConn.php";
$conn = connectToDatabase();

$userId = $_SESSION['userId'];

$projects = getProjects($conn, $userId);
$returnString = buildReturnString($projects);
echo $returnString;

//=============================================//
//              Functions below                //
//=============================================//

//This function returns an array of projects belonging to the given user.
function getProjects($conn, $userId){
    $projects = [];

    $result = $conn->query("SELECT `Project`.* 
                            FROM `Project`, `UserProject` 
                            WHERE `Project`.`id` = `UserProject`.`project_id` 
                            AND `user_id` = $userId ; ");

    if($result === FALSE){
        echo "CONN ERROR: " . $conn->error;
    } else {
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_array()) {
                array_push($projects, new Project($row[0], $row[1], $row[2], $row[3], $row[4], $row[5], $row[6]));
            }
        } else{
            echo "ahhhhh";
        }
    }

    foreach ($projects as $project){
        $_SESSION['projects'][$project->getId()] = $project;
    }

    return $projects;
}

//This function returns the html to be placed in the projects nav.
function buildReturnString($projects){

    $string = "";

    foreach ($projects as $project) {
        $string = $string . $project->buildNavHTML();
    };

    return $string;
}