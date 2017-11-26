<?php
/**
 * Created by IntelliJ IDEA.
 * User: E
 * Date: 26/11/2017
 * Time: 02:49
 */
require "Project.php";
session_start();

$project = $_SESSION['projects'][$_SESSION['selectedProjectId']];
echo buildReturnString($project);

//This function returns the html to be placed in the projects info div.
function buildReturnString($project){

    $infoArray =  $project->buildInfoHTML();

    return json_encode($infoArray);
}