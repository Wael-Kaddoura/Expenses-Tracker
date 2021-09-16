<?php
include "connection.php";

session_start();

$expense_id = $_POST["expense_id"];

//getting all the categories for the current user from the DB
$sql="DELETE FROM `expenses` WHERE id = ?";
$stmt = $connection->prepare($sql);
$stmt->bind_param("s",$expense_id);
$stmt->execute();

?>