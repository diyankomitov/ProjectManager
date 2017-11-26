<?php
/**
 * Created by IntelliJ IDEA.
 * User: E
 * Date: 25/11/2017
 * Time: 23:29
 */
session_start();

//Set the session's project to the passed project.
$_SESSION['projectId'] = $_GET["id"];
