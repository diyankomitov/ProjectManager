<?php
/**
 * Created by IntelliJ IDEA.
 * User: E
 * Date: 18/11/2017
 * Time: 23:45
 */
session_start();

//Connect to database
require_once "databaseConn.php";
$conn = connectToDatabase();
header('Content-Type: text/');

$userId = $_SESSION['userId'];


function sanitizeValues($conn, $value){
    if(isset($_POST[$value])){
        return $conn->real_escape_string($_POST[$value]);
    } else {
        return "";
    }
}


$class = sanitizeValues($conn,"class");
$name = sanitizeValues($conn,"name");
$description = sanitizeValues($conn,"description") === "" ? null : sanitizeValues($conn,"description");
$deadline = sanitizeValues($conn,"deadline") === "" ? null : sanitizeValues($conn,"deadline");


$newProjectId = getNewProjectId($conn);
$success = createProjectEntry($conn, $newProjectId, $class, $name, $description, 0, $deadline)
    && createUserProjectEntries($conn, $userId, $newProjectId);

if($success) echo $newProjectId;

echo ($conn->error);

//=============================================//
//              Functions below                //
//=============================================//

//This function finds the most recent project's id and returns that id + 1.
//This is necessary because we need a reference to the new id to create the UserProject entry
function getNewProjectId($conn){

    //Find the max id in projects. The new id is the max plus one.
    $newProjectId = 1;
    $result = $conn->query("SELECT max(`id`) FROM `Project`");
    if($result->num_rows  > 0) {
        $newProjectId = $result->fetch_array()[0] + 1;
    } else if($conn->error) {
        echo "ERROR at id:" . $conn->error;
    }

    return $newProjectId;
}

//Creates a new row in the Project table.
function createProjectEntry($conn, $id, $class, $name, $description, $isComplete, $deadline){

    //The query dependent on whether description and deadline are null or not.
    $sql = "";
    if($description === null && $deadline === null){
        $sql = "INSERT INTO `Project` (`id`, `class`, `name`, `is_complete`) 
                VALUES ('$id', '$class', '$name', '$isComplete');";
    } else if($description === null && $deadline !== null) {
        $sql = "INSERT INTO `Project` (`id`, `class`, `name`, `is_complete`, `deadline`) 
                VALUES ('$id', '$class', '$name', '$isComplete', '$deadline');";
    } else if($description !== null && $deadline === null ){
        $sql = "INSERT INTO `Project` (`id`, `class`, `name`, `description`, `is_complete`) 
                VALUES ('$id', '$class', '$name', '$description', '$isComplete');";
    } else{
        $sql = "INSERT INTO `Project` (`id`, `class`, `name`, `description`, `is_complete`, `deadline`) 
                VALUES ('$id', '$class', '$name', '$description', '$isComplete', '$deadline');";
    }

    if($conn->query($sql) === FALSE) {
        echo "ERROR at project:" . $sql ;//$conn->error;
        return false;
    } else{
        return true;
    }

}

//Creates a new row in the UserProject table.
function createUserProjectEntries($conn, $userId, $projectId){

    $sql = "INSERT INTO `UserProject` (`user_id`, `project_id`, `is_read`) 
                      VALUES ('$userId', '$projectId', '0')";

    if($conn->query($sql) === FALSE){
        echo "ERROR at userproject:" . $conn->error;
        return false;
    } else {
        return true;
    }
}