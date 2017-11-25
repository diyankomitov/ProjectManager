<?php

session_start();

include_once 'databaseConn.php';
$conn = connectToDatabase();

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
            There are no projects.
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
        <aside>FILES</aside>
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