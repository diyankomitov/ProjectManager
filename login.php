<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    session_start();

include_once 'scripts_AJAX/databaseConn.php';
$conn = connectToDatabase();

    function sanitizeValues($conn, $value){
        if(isset($_POST[$value])){
            return $conn-> real_escape_string(strip_tags($_POST[$value]));
        } else {
            return "";
        }
    }

    $email = sanitizeValues($conn, "email");
    $password = sanitizeValues($conn, "password");


//=======
function getUserId($conn, $email){
    $result = $conn->query("SELECT `id` FROM `User` WHERE `email` = '$email';");

    if($conn->error) {
        $_SESSION['error'] += "<p>Conn error: $conn->error</p>";
    } else if($result->num_rows === 0) {
        $_SESSION['error'] += "<p>getUserId() - num of rows = 0</p>";
    } else if ($result->num_rows > 1) {
        $_SESSION['error'] += "<p>getUserId() - num of rows > 1</p>";
    } else {
        return $result->fetch_array()[0];
    }

    return -1;

}
//>>>>>>> registrationAndLogin

    $sql = "SELECT `pass` FROM `User` WHERE `email` = '$email'";
    $result = $conn->query($sql);

    $row = mysqli_fetch_row($result);
    $passHash = $row[0];

    $rows = mysqli_num_rows($result);

    if ($rows == 1 && password_verify($password, $passHash)){
        $_SESSION['email'] = $email;
        $_SESSION['userId'] = getUserId($conn, $email);
        echo "";
    }
    else{
        ?>
        <label id="userLabel" for="email">Email Address</label>
        <input type="email" id="email" name="email" value="<?php echo $email ?>" required>

        <label id="passLabel" for="password">Password</label>
        <input type="password" id="password" name="pass" required>

        <p class="loginError">The Email or Password was incorrect. Please try again.</p>

        <a id="registerLink" href="register.html">Don't have an account?<br>Register here</a>
        <input id="submit" type="submit" value="Log in" onclick="login()">
        <?php
    }
}
?>
