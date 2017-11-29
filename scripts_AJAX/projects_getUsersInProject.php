<?php
/**
 * Created by IntelliJ IDEA.
 * User: E
 * Date: 26/11/2017
 * Time: 13:16
 */
require "Project.php";
session_start();
header('Content-Type: text/');

require_once "databaseConn.php";
$conn = connectToDatabase();

$users = getUsers($conn);
echo buildReturnHTML($users);



function getUsers($conn){
    $users = [];

    $result = $conn->query("SELECT `User`.`id`, `User`.`name` 
                            FROM `User`, `UserProject` 
                            WHERE `UserProject`.`project_id` = " . $_SESSION['selectedProjectId'] ."
                            AND `User`.`id` = `UserProject`.`user_id` ;");
    if($result === FALSE){
        //error here
    } else if($result->num_rows < 1){
        //error here
    } else {
        while($row = $result->fetch_array()){
            array_push($users, new QuickUser($row[0], $row[1]));
        }
    }

    return $users;
}

function buildReturnHTML($users){
    $string = "Users: ";

    foreach ($users as $user){
        $id = $user->getId();
        $name = "<span class='projectUserLabel'>" . $user->getName();
        $buttonHTML = "<a onclick='projects_removeUserFromProject($id);'>";

        if($id == $_SESSION['userId']){
            $name = $name . " (That's You!)</span>";
            $buttonHTML = $buttonHTML . "&times</a>";
        } else {
            $buttonHTML = $buttonHTML . "&times</a>";
        }

        $string = $string . "<div class='projectUser'> $name $buttonHTML </div>";
    }

    return $string;
}

class QuickUser {

    var $userId;
    var $name;

    function __construct($id, $name){
        $this->userId = $id;
        $this->name = $name;
    }

    function getId(){
        return $this->userId;
    }

    function getName(){
        return $this->name;
    }

}