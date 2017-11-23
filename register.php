

<?php

session_start();

if( isset($_SESSION['email'])!="" ){
    header("Location: index.html");
}

include_once 'databaseConn.php';
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
        $passError = "*     Please enter a valid password";
        $error = true;
    }

    if (!$error) {

        $sql = "INSERT INTO `User` (`id`, `email`, `pass`, `name`, `uni`, `course`, `profile_pic_path`) VALUES (NULL,'$email', '$pass', '$name', NULL, NULL, NULL)";
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
    <link rel="stylesheet" href="styles/styles.css">
    <link rel="stylesheet" href="styles/register.css">
</head>
<body>
<div class="grid">
    <header>
        <div class="pageTitle"><a href="index.html"> Project Manager</a></div>
    </header>
    <main>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">

            <label id="firstLabel" for="name">Full Name</label>
            <input type="text" id="name" name="name" value="<?php echo $name; ?>">
            <label id="dobLabel" for="dob">Date of Birth</label>
            <input type="date" id="dob" name="dob">
            <label id="userLabel" for="Email">Email Address</label>
            <input type="text" id="Email" name="email" value="<?php echo $email; ?>">
            <label id="passLabel" for="password">Password</label>
            <input type="password" id="password" name="pass" value="<?php echo $pass; ?>">
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