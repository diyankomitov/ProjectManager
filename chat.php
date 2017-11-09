<?php
// This is the server-side script.

// Set the content type.
header('Content-Type: text/');

// Send the data back.
echo "<div class='chatMessageWrapper'>
          <div class='chatMessage otherMessage'>
              <p>hello this is a test message
                hello this is a test message
                hello this is a test message
                hello this is a test message
                hello this is a test message</p>
              
          </div>
      </div>
      <div class='chatMessageWrapper'>
          <div class='chatMessage myMessage'>
              <p>hello this is my test message
                hello this is my test message
                hello this is my test message
                hello this is my test message</p>
          </div>
      </div>
      <div class='chatMessageWrapper'>
          <div class='chatMessage otherMessage'>
              <p>hello this is a test message</p>
              
          </div>
      </div>
      <div class='chatMessageWrapper'>
          <div class='chatMessage myMessage'>
              <p>hello this is my test message
                hello this is my test message</p>
          </div>
      </div>";
?>