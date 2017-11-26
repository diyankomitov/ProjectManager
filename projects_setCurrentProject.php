<?php
/**
 * Created by IntelliJ IDEA.
 * User: E
 * Date: 25/11/2017
 * Time: 23:29
 */
session_start();
$_SESSION['projectId'] = $_GET["id"];
$_SESSION['isClicked'] = 'yes';

header('Content-Type: text/');

echo $_SESSION['projectId'];
