<?php
/**
 * Created by IntelliJ IDEA.
 * User: E
 * Date: 17/11/2017
 * Time: 23:56
 */

header('Content-Type: text/');

require_once "databaseConn.php";
$conn = connectToDatabase();

include "Project.php";

$userId = $_GET["user"];


$projects = getProjects($conn, $userId);
$returnString = buildReturnString($projects);


echo $returnString;

//=============================================//
//              Functions below                //
//=============================================//

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
        }
    }

    return $projects;
}

function buildReturnString($projects){

    $string = "";

    foreach ($projects as $project) {
        $string = $string . $project->buildHTMLMessage();
    };

    return $string;
}