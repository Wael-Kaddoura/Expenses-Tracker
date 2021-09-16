<?php
session_start();

$_SESSION["logedin"] = false;

//ending session
session_destroy();

//redirecting to the home page
header("Location:../index.php")
?>