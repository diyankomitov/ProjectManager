<?php

session_start();

include_once 'databaseConn.php';
$conn = connectToDatabase();



if( isset($_SESSION['email'])!="") {




$try = $_SESSION['email'];
$sql = "SELECT `name` FROM `User` WHERE `email` = '$try'";
$result = $conn->query($sql);

$row = mysqli_fetch_assoc($result);
$setName = $row['name'];



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
        <div class="pageTitle"><a href="index.html"> Project Manager</a></div>
        Welcome back <?php echo $setName ?>!
        <div class="buttons">
            <a href="logout.php" class="logout">Log Out</a>
            <a href="register.php" class="login">Register</a>
        </div>
    </header>
    <nav>PROJECTS</nav>
    <main>
        <div id="chat" class="chat">
    There are no messages.
        </div>

        <div class="chatInput">
            <textarea id="textArea" class="message"></textarea>
            <button type="button" class="submitMessage"
                    onclick="chat_sendMessage(document.getElementById('textArea').value);">
                        Send
            </button>
            <button type="button" onclick="chat_refreshChat();">Refresh</button>
        </div>
    </main>
    <aside>FILES</aside>
    <footer>FOOTER</footer>
</div>

<script src="chat.js"></script>
</body>
</html>

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
        <div class="pageTitle"><a href="index.html"> Project Manager</a></div>
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

        <div class="chatInput">
            <textarea id="textArea" class="message"></textarea>
            <button type="button" class="submitMessage"
                    onclick="chat_sendMessage(document.getElementById('textArea').value);">
                Send
            </button>
            <button type="button" onclick="chat_refreshChat();">Refresh</button>
        </div>
    </main>
    <aside>FILES</aside>
    <footer>FOOTER</footer>
</div>
<?php
}
?>
<script src="chat.js"></script>
</body>
</html>