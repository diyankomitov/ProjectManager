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
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Project: Efficiency</title>
        <link rel="stylesheet" href="styles/styles.css">
        <link rel="icon" href="images/faviconsmall.png">
    </head>
    <body>
    <div class="grid">
        <header>
            <div class="pageTitle"><a href="index.php">Project: Efficiency</a></div>
            <span class="divider"></span>
            <div class="links">
                <span class="welcome">Welcome back <?php echo $name ?>!</span>
                <a href="logout.php">Log Out</a>
            </div>
        </header>
        <nav>
            <a href="#createProject" class="addProject">Create Project</a>
            <div class="navInner">
                <div id="projectsWrapper">
                    <div id="projects">
                        There are no projects.
                    </div>
                </div>
            </div>
        </nav>
        <main>
            <div class="chatWrapper">
                <div id="chat" class="chat">
                    There are no messages.
                </div>
            </div>

            <div class="chatInput">
                <textarea wrap="hard" maxlength="4900" id="textArea" class="inputMessage"></textarea>
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
    <div id="createProject" class="overlay">
        <div class="projectMain">
            <div class="projectForm">
                <div id="createProjectHeader">
                    <h1 id="headerText">Create Project</h1>
                    <a href="#" title="Close" id="close">&times;</a>
                </div>
                <form id="createProjectForm" method="post">
                    <label id="classLabel" for="class">Class <sup>(Required)</sup></label>
                    <input type="text" id="class" name="class" required>

                    <label id="nameLabel" for="name">Name <sup>(Required)</sup></label>
                    <input type="text" id="name" name="name" required>

                    <label id="descriptionLabel" for="description">Description</label>
                    <input type="text" id="description" name="description">

                    <label id="deadlineLabel" for="deadline">Deadline</label>
                    <input type="date" id="deadline" name="deadline">

                    <button id="submit" onclick="projects_createProject()">Create</button>
                </form>
            </div>
        </div>
    </div>

    <script src="scripts_JS/index.js"></script>
    <script src="scripts_JS/chat.js"></script>
    <script src="scripts_JS/projects.js" ></script>
    </body>
    </html>
<?php
}
?>