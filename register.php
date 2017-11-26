

<?php

session_start();

if( isset($_SESSION['email'])!="" ){
    header("Location: index.php");
}

include_once 'scripts_AJAX/databaseConn.php';
$conn = connectToDatabase();

function safePost($conn, $name){
    if(isset($_POST[$name])){
        return $conn-> real_escape_string(strip_tags($_POST[$name]));
    } else {
        return "";
    }
}


$error = false;
$emailError = $passError = $nameError ="";
$successful = "";

$name = safePost($conn, "name");
$email = safePost($conn, "email");
$pass = safePost($conn, "pass");
$uni = safePost($conn, "uni");
$course = safePost($conn, "course");





if($_SERVER["REQUEST_METHOD"] == "POST") {

    if (empty($email)) {
        $emailError = "* Please enter an email address";
        $error = true;
    }
    else if( !filter_var($email,FILTER_VALIDATE_EMAIL)) {
        $emailError = "* Please enter a valid email address";
        $error = true;
    }

    if (empty($name)) {
        $nameError = "* Please enter a valid name";
        $error = true;
    }

    if (empty($pass)) {
        $passError = "* Please enter a valid password";
        $error = true;
    }


    if (!$error) {

        $sql = "INSERT INTO `User` (`id`, `email`, `pass`, `name`, `uni`, `course`, `profile_pic_path`) VALUES (NULL,'$email', '$pass', '$name', '$uni', $course, NULL)";
        $result = $conn->query($sql);
        $successful = "Registration successful you may now login";

    }
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Project Manager</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="register.css">
</head>
<body>
<div class="grid">
    <header>
        <div class="pageTitle"><a href="index.php"> Project Manager</a></div>
    </header>
    <main>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">

            <label id="nameLabel" for="name">Full Name</label>
            <input type="text" id="name" name="name" value="<?php echo $name; ?>">
            <label id="emailLabel" for="Email">Email Address</label>
            <input type="text" id="Email" name="email" value="<?php echo $email; ?>">
            <label id="passLabel" for="password">Password</label>
            <input type="password" id="password" name="pass" value="<?php echo $pass; ?>">
            <label id="uniLabel" for="uni">University</label>
            <input type="text" id="uni" name="uni" value="">
            <label id="courseLabel" for="course">Course</label>
            <input type="text" id="course" name="course" value="">
            <input id="submit" type="submit" value="Register">
        </form>
        <?php
        echo $emailError;
        echo "<p>  $passError </p>";
        echo "<p>  $nameError </p>";

        if($successful != "")
        {echo "$successful.<a href=\"login.php\"><u>Login here</u></a>";}
        ?>
    </main>



    <footer>FOOTER</footer>
</div>
</body>
</html>