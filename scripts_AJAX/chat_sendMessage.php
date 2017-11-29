<?php
/**
 * Created by IntelliJ IDEA.
 * User: Ewan
 * Date: 09/11/2017
 * Time: 18:52
 */
session_start();
header('Content-Type: text/');

//Connect to database
require_once "databaseConn.php";
$conn = connectToDatabase();

$projectId = $_SESSION['selectedProjectId'];
$userId = $_SESSION['userId'];
$messageBody = $conn->real_escape_string($_GET["messageBody"]);

$response = userNotInProject($conn, $userId, $projectId);
if($response == "") { // If there is no response then the user is in the project, so continue.
    $newMessageId = getNewMessageId($conn);
    createMessageEntry($conn, $newMessageId, $userId, $projectId, $messageBody);
}

echo $response;


//=============================================//
//              Functions below                //
//=============================================//

function userNotInProject($conn, $userId, $projectId){
    $result = $conn->query("SELECT `*` 
                            FROM `UserProject` 
                            WHERE `user_id` = $userId 
                            AND `project_id` = $projectId");

    if($result === FALSE){
        return $conn->error;
    } else if($result->num_rows < 1){
        return "You are no longer part of this project.";
    } else if($result->num_rows > 1){
        return "ERROR at chat_sendMessage.php :: userNotInProject(): Multiple instances of user and project in UserProject.";
    } else {
        return "";
    }

    return "AHHHHHHHHHHHH";
}

//This function finds the most recent message's id and returns that id + 1.
function getNewMessageId($conn){

    //Find the max id in messages. The new id is the max plus one.
    $newMessageId = 1;
    $result = $conn->query("SELECT max(`id`) FROM `Message`");
    if($result->num_rows  > 0) {
        $newMessageId = $result->fetch_array()[0] + 1;
    } else if($conn->error) {
        echo $conn->error;
    }

    return $newMessageId;
}

//Creates a new row in the Message table.
function createMessageEntry($conn, $newMessageId, $userId, $projectId, $messageBody){
    if(
        $conn->query("INSERT INTO `Message` (`id`, `creator_id`, `project_id`, `message_body`) 
                VALUES ('$newMessageId', '$userId', '$projectId', '$messageBody');")
        === FALSE) {
        echo $conn->error;
    }
}