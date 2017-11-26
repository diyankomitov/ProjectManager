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
    "badInsert"=>"ERROR BAD INSERT"];

$userId = findUser($conn, $email);
if($userId < 0){
    echo $errors[strval($userId)];
} else if(addUserToProject($conn, $userId) === FALSE){
    echo $errors["badInsert"];
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