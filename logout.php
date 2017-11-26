<?php

session_start();
unset($_SESSION['email']);
unset($_SESSION['userId']);
unset($_SESSION['projectId']);
header("Location: index.php");

