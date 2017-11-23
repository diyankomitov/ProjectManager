

<?php
session_start();

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
$emailError = $passError = "";
$successful = "";
$notSuccessful ="";

$email = safePost($conn, "email");
$pass = safePost($conn, "pass");




if($_SERVER["REQUEST_METHOD"] == "POST") {

    if (empty($email)) {
        $emailError = "* Please enter an email address";
        $error = true;
    }
    else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $emailError = "* Please enter a valid email address";
        $error = true;
    }

    if (empty($pass)) {
        $passError = " * Please enter a valid password";
        $error = true;
    }

    if(!$error){
        $sql = "SELECT * FROM `User` WHERE `email` = '$email' AND `pass` = '$pass'";
        $result = $conn->query($sql);
        $rows = mysqli_num_rows($result);

        if ($rows == 1){
            $_SESSION['email'] = $email;
            $successful = "Login successful";
        }
        else{
            $notSuccessful = " * Email address and or password is not correct please try again";
        }

    }

}
?>







<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Project Manager</title>
    <link rel="stylesheet" href="styles/styles.css">
    <link rel="stylesheet" href="styles/login.css">
</head>
<body>
<div class="grid">
    <header>
        <div class="pageTitle"><a href="index.html"> Project Manager</a></div>
    </header>
    <main>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <label id="userLabel" for="email">Email Address</label>
            <input type="text" id="email" name="email">
            <label id="passLabel" for="password">Password</label>
            <input type="password" id="password" name="pass">
            <input id="submit" type="submit" value="Log In">
        </form>


        <?php
        echo $emailError;
        echo "<p>  $passError </p>";

        if($successful != "")
                {header("Location: index.php");}
        if($notSuccessful != "")
            {echo $notSuccessful;}
        ?>

        <p>Not registered yet? <a href='register.php'><u>Register Here</u></a></p>

    </main>

    <footer>FOOTER</footer>
</div>
</body>
</html>