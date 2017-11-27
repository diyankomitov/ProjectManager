<?php

session_start();

include_once 'scripts_AJAX/databaseConn.php';
$conn = connectToDatabase();



if( isset($_SESSION['email'])!="") {



$setEmail = $_SESSION['email'];
$sql = "SELECT `name` FROM `User` WHERE `email` = '$setEmail'";
$result = $conn->query($sql);

$row = mysqli_fetch_assoc($result);
$setName = $row['name'];



?>

    <html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Project Manager</title>
    <link rel="stylesheet" href="styles.css">
    <script>
        setInterval(function(){chat_refreshPage(false, false);}, 3000);
    </script>
</head>
<body>
<div class="grid">
    <header>
        <div class="pageTitle"><a href="index.php"> Project Manager</a></div>
        Welcome back <?php echo $setName ?>!
        <div class="buttons">
            <a href="logout.php" class="login">Log Out</a>
        </div>
    </header>
    <nav>
        <div>
            <button type="button" onclick=" projects_retrieveProjects();">Refresh</button>
            <button type="button" onclick="window.location.href = ' createProject.html';">Create</button>
        </div>
        <div id="projects">
            There are no projects.
        </div>
    </nav>
    <main>
        <div id="chat" class="chat">
            There are no messages.
        </div>

        <div id="chatInput" class="chatInput">
            <textarea id="textArea" class="message"></textarea>
            <button type="button"
                    class="submitMessage"
                    onclick="chat_sendMessage(document.getElementById('textArea').value);">
                        Send
            </button>
            <button type="button" onclick="chat_refreshPage(false, false);">Refresh</button>
        </div>
    </main>
    <aside>
        <div id="projectInfo">
            <div id='info_buttons'>
            </div>
            <div id="info_error">
            </div>
            <div id='info_info'>
            </div>
            <div id='info_users'>
            </div>
        </div>
        <div id="error"></div>
<!--        --><?php //echo "<p> ". $_SESSION['userId'] . "</p><p>" . $_SESSION["error"] ."</p>" ?><!-- -->
    </aside>
    <footer>FOOTER</footer>
</div>
<script src="scripts_JS/chat.js"></script>
<script src="scripts_JS/projects.js"></script>
<script>chat_refreshPage(true, true);</script>
<?php


}



else{
?>


<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Project Manager</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<div class="grid">
    <header>
        <div class="pageTitle"><a href="index.php"> Project Manager</a></div>
        <div class="buttons">
            <a href="login.php" class="login">Log In</a>
            <a href="register.php" class="login">Register</a>
        </div>
    </header>
    <nav>PROJECTS</nav>
    <main>
        <div id="chat" class="chat">
            There are no messages.
        </div>
    </main>
    <aside>FILES</aside>
    <footer>FOOTER</footer>
</div>
<script src="scripts_JS/chat.js"></script>
<script src="scripts_JS/projects.js"></script>
<?php
}
?>
</body>
</html>