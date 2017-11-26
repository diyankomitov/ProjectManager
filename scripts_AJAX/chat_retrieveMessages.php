<?php
/**
 * This script retrieves all messages in a given chat
 * between the given dates and echos chat bubbles for them.
 *
 * Created by IntelliJ IDEA.
 * User: Ewan
 * Date: 14/11/2017
 * Time: 14:26
 */
session_start();
header('Content-Type: text/');

//Connect to database
require_once "databaseConn.php";
$conn = connectToDatabase();

include "Message.php";

//If the user has selected a project
if(isset($_SESSION['projectId']) && !empty($_SESSION['projectId'])){
    $projectId = $_SESSION["projectId"];
    $userId = $_SESSION['userId'];
    $dateFrom = $_GET["dateFrom"];
    $dateUpTo = $_GET["dateUpTo"];

    $messages = getMessages($conn, $projectId, $dateFrom, $dateUpTo);
    $returnString = buildReturnString($messages, $userId);

}else {
    $returnString = "<p>Click or create a project</p>";
}

echo $returnString;

//=============================================//
//              Functions below                //
//=============================================//

//This function returns an array of messages in the given project. From and upto are not currently used.
function getMessages($conn, $projectId, $from, $upTo){
    $messages = [];

    $result = $conn->query("SELECT `id`, `creator_id`, `message_body`, `create_date` 
                            FROM `Message` 
                            WHERE `project_id` = $projectId
                            /* AND `create_date` > $from */
                            /* AND `create_date` < $upTo */");
    if($result === FALSE){
        echo "CONN ERROR: " . $conn->error;
    } else {
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_array()) {
                array_push($messages, new Message($row[0], $row[1], $row[2], $row[3]));
            }
        }
    }

    return $messages;
}

//This function returns the html to be placed in the chat window.
function buildReturnString($messages, $userId){

    $string = "";

    foreach ($messages as $message) {
        $string = $string . $message->buildHTML($userId);
    };

    return $string;
}