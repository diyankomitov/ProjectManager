<?php
session_start();

unset($_SESSION['email']);
unset($_SESSION['userId']);
unset($_SESSION['selectedProjectId']);
unset($_SESSION['projects']);

header("Location: index.php");

