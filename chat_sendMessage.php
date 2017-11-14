<?php
/**
 * Created by IntelliJ IDEA.
 * User: Ewan
 * Date: 09/11/2017
 * Time: 18:52
 */


require_once "databaseConn.php";
$conn = connectToDatabase();

$projectId = $_GET["project"];
$userId = $_GET["user"];
$messageBody = $_GET["messageBody"];

$newMessageId = getNewMessageId($conn);
createMessageEntry($conn, $newMessageId, $userId, $messageBody);
createReceivedMessageEntries($conn, $userId, $newMessageId, $projectId);

//=============================================//
//              Functions below                //
//=============================================//

function getNewMessageId($conn){

    $newMessageId = -1;

    //Find the max id in messages. The new id is the max plus one.
    $result = $conn->query("SELECT max(`id`) FROM `Message`");
    if($result->num_rows  === 1) {

        $newMessageId = $result->fetch_array()[0] + 1;

        //If there are no rows, set it to 1. //FIXME: I dont know why this works.
        if($newMessageId < 0 || $newMessageId == ""){
            $newMessageId = 1;
        }
    } else {
        echo $conn->error;
    }

    return $newMessageId;
}

function createMessageEntry($conn, $newMessageId, $userId, $messageBody){
    $conn->query("INSERT INTO `Message` (`id`, `creator_id`, `message_body`) 
                  VALUES ('$newMessageId', '$userId', '$messageBody');");
    if($conn->error){
        echo $conn->error;
    }
}

function createReceivedMessageEntries($conn, $currentUserId, $newMessageId, $projectID){

    //Get all OTHER userIds in projectId
    $otherUserIds = [];
    $result = $conn->query("SELECT `user_id` FROM `UserProject` WHERE `project_id` = '$projectID'");
    if($result->num_rows  > 0) {
        while ($row = $result->fetch_array()){
            if($row[0] != $currentUserId)
                array_push($otherUserIds, $row[0]);
        }
    } else {
        echo "CONN ERROR: " . $conn->error;
    }

    if(empty($otherUserIds)){
        echo "------------ERROR: userIds is empty in createReceivedMessageEntries ----------------";
    }

    //Loop through each userId and insert a row into ReceivedMessage
    foreach ($otherUserIds as $otherUserId) {
        $conn->query("INSERT INTO `ReceivedMessage` (`id`, `recipient_id`, `project_id`, `message_id`, `is_read`) 
                      VALUES (NULL, '$otherUserId', '$projectID', '$newMessageId', '0')");
        if($conn->error){
            echo $conn->error;
        }
    }

}