<?php
$server = "localhost";
$username = "root";
$password = "";
$dbname = "expensestrackerdb";

$connection = new mysqli($server, $username, $password, $dbname);

if ($connection->connect_error) {
    die("Connection Failed!");
}
?>