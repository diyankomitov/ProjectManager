<?php
session_start();

if(!isset($_SESSION['email'])!="" ){

    include_once 'scripts_AJAX/databaseConn.php';
    $conn = connectToDatabase();

    function sanitizeValues($conn, $value){
        if(isset($_POST[$value])){
            return $conn-> real_escape_string(strip_tags($_POST[$value]));
        } else {
            return "";
        }
    }

    $name = sanitizeValues($conn, "name");
    $email = sanitizeValues($conn, "email");
    $password = sanitizeValues($conn, "password");
    $uni = sanitizeValues($conn, "uni");
    $course = sanitizeValues($conn, "course");

    $sql = "SELECT `email` FROM `User` WHERE `email` = '$email'";
    $result = $conn->query($sql);
    $rows = mysqli_num_rows($result);

    $error = "";

    if ($rows == 1) {
        $error = "This email address is already in use. Please enter another one.";
    }
    else if (empty($name) || empty($email) || empty($password) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Something went wrong with your registration. Please try again.";
    }

    if ($error === "") {
        $hashedAndSaltedPassword = password_hash($password, PASSWORD_BCRYPT);

        $sql = "INSERT INTO `User` (`email`, `pass`, `name`, `uni`, `course`) VALUES ('$email', '$hashedAndSaltedPassword', '$name', '$uni', '$course')";

        $result = $conn->query($sql);
        echo "";
    }
    else{
        ?>
        <label id="nameLabel" for="name">Full Name <sup>(Required)</sup></label>
        <input type="text"  id="name" name="name" value="<?php echo $name ?>" required>

        <label id="emailLabel" for="email">Email Address <sup>(Required)</sup></label>
        <input type="email" id="email" name="email" value="<?php echo $email ?>" required>

        <label id="passLabel" for="password">Password <sup>(Required)</sup></label>
        <input type="password" id="password" name="pass"" required>

        <label id="uniLabel" for="uni">University</label>
        <input type="text" id="uni" name="uni" value="<?php echo $uni ?>">

        <label id="courseLabel" for="course">Course</label>
        <input type="text" id="course" name="course" value="<?php echo $course ?>">

        <p class="loginError"><?php echo $error ?></p>

        <a id="loginLink" href="login.html">Already have an account?<br>Login here</a>
        <input id="submit" type="submit" value="Register" onclick="register()">
        <?php
    }
}
?>