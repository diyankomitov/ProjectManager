<?php

session_start();

include_once 'scripts_AJAX/databaseConn.php';
$conn = connectToDatabase();

//<<<<<<< HEAD
if (!isset($_SESSION["email"])) {
    header('Location: login.html');
}
else {
    $email = $_SESSION['email'];
    $sql = "SELECT `name` FROM `User` WHERE `email` = '$email'";
    $result = $conn->query($sql);
    $row = mysqli_fetch_assoc($result);
    $name = $row['name'];

?>
<!--<<<<<<< HEAD-->
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Project: Efficiency</title>
        <link rel="stylesheet" href="styles/styles.css">
    </head>
    <body>
    <div class="grid">
        <header>
            <div class="pageTitle"><a href="/">Project: Efficiency</a></div>
            <span class="divider"></span>
            <div class="links">
                <p>Welcome back <?php echo $name ?>!</p>
                <a href="logout.php">Log Out</a>
            </div>
        </header>
        <nav id="projects">
            <div>
                <button type="button" onclick=" projects_retrieveProjects();">Refresh</button>
                <button type="button" onclick="window.location.href = ' createProject.html';">Create</button>
            </div>
<!--            <div id="projects">-->
<!--                There are no projects.-->
<!--            </div>-->
        </nav>
        <main>
            <div class="chatWrapper">
                <div id="chat" class="chat">
                    There are no messages.
                </div>
            </div>

            <div class="chatInput">
                <textarea id="textArea" class="inputMessage"></textarea>
                <span class="beforeSubmit"></span>
                <button type="button" class="submitMessage" onclick="chat_sendMessage(document.getElementById('textArea').value);">
                    Send
                </button>
                <span class="afterSubmit"></span>
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
        <footer>Created by Group H for CS312</footer>
    </div>

    <script src="scripts/index.js"></script>
    <script src="scripts/chat.js"></script>
    <script src="scripts/projects.js" ></script>
    </body>
    </html>
<?php
}
?>