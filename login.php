<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    session_start();

    include_once 'databaseConn.php';
    $conn = connectToDatabase();

    $email = $conn->real_escape_string(strip_tags($_POST["email"]));
    $password = $conn->real_escape_string(strip_tags($_POST["password"]));

    $sql = "SELECT * FROM `User` WHERE `email` = '$email' AND `pass` = '$password'";
    $result = $conn->query($sql);
    $rows = mysqli_num_rows($result);

    if ($rows == 1){
        $_SESSION['email'] = $email;
        echo "";
    }
    else{
        ?>
        <label id="userLabel" for="email">Email Address</label>
        <input type="email" id="email" name="email" required>
        <label id="passLabel" for="password">Password</label>
        <input type="password" id="password" name="pass" required>
        <p class="loginError">The Email or Password was incorrect. Please try again.</p>
        <a id="registerLink" href="register.html">Don't have an account?<br>Register here</a>
        <input id="submit" type="submit" value="Log in" onclick="login()">
        <?php
    }
}
?>