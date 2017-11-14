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

require_once "databaseConn.php";
$conn = connectToDatabase();

$projectId = $_GET["project"];
$userId = $_GET["user"];
$dateFrom = $_GET["dateFrom"];
$dateUpTo = $_GET["dateUpTo"];



$returnString = buildReturnString();



header('Content-Type: text/');
echo $returnString;

//=============================================//
//              Functions below                //
//=============================================//

function buildReturnString(){
    return "<div class='chatMessageWrapper'>
          <div class='chatMessage otherMessage'>
              <p> This is a message :)) </p>
          </div>
      </div> ";
}