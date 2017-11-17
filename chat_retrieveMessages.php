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

header('Content-Type: text/');

require_once "databaseConn.php";
$conn = connectToDatabase();

include "Message.php";

$projectId = $_GET["project"];
$userId = $_GET["user"];
$dateFrom = $_GET["dateFrom"];
$dateUpTo = $_GET["dateUpTo"];


$messages = getMessages($conn, $projectId);
$returnString = buildReturnString($messages, $userId);


echo $returnString;

//=============================================//
//              Functions below                //
//=============================================//

function getMessages($conn, $projectId){
    $messages = [];

    $result = $conn->query("SELECT `id`, `creator_id`, `message_body`, `create_date` FROM `Message` WHERE `project_id` = $projectId");
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

function buildReturnString($messages, $userId){

    $string = "";

    foreach ($messages as $message) {
        $string = $string . $message->buildHTMLMessage($userId);
    };

    return $string;
}