<?php
/**
 * Created by IntelliJ IDEA.
 * User: E
 * Date: 26/11/2017
 * Time: 14:31
 */
session_start();
header('Content-Type: text/');


require_once "databaseConn.php";
$conn = connectToDatabase();

$email = $conn->real_escape_string($_GET['email']);
$errors = ["-1"=>"ERROR QUERY MALFORMED",
    "-2"=>"There is no user by that address",
    "-3"=>"ERROR QUERY RETURNED MULTIPLE USERS",
    "badInsert"=>"ERROR BAD INSERT",
    "userAlreadyInProject"=>"This user is already in this project"];


$userId = findUser($conn, $email);

if(isUserInProject($conn, $userId)) {
    echo $errors["userAlreadyInProject"];
} else {
    if ($userId < 0) {
        echo $errors[strval($userId)];
    } else if (addUserToProject($conn, $userId) === FALSE) {
        echo $errors["badInsert"];
    }
}



function isUserInProject($conn, $userId){
    $result = $conn->query("SELECT `*` 
                            FROM `UserProject` 
                            WHERE `user_id` = $userId 
                            AND `project_id` =  " . $_SESSION['selectedProjectId']);

    if($result === FALSE){
        echo $conn->error;
    } else if($result->num_rows === 1){
        //Already in project
    } else if($result->num_rows > 1){
        echo "ERROR at chat_sendMessage.php :: userNotInProject(): Multiple instances of user and project in UserProject.";
    } else {
        return false;
    }

    return true;
}

function findUser($conn, $email){
    $result = $conn->query("SELECT `id` FROM `User` WHERE `email` = '$email';");

    if($result === FALSE)
        return -1;
    if($result->num_rows < 1)
        return -2;
    if ($result->num_rows > 1)
        return -3;
    else
        return $result->fetch_array()[0];

}

function addUserToProject($conn, $userId){
    $result = $conn->query("INSERT INTO `UserProject`(`user_id`, `project_id`, `is_read`) 
                          VALUES ('$userId', " . $_SESSION['selectedProjectId'] . ", 0)");

    return $result;
}