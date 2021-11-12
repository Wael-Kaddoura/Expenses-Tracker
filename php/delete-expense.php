<?php
include "connection.php";

session_start();

$deleted_expense = $_POST["deleted_expense"];
$deleted_expense = json_decode($deleted_expense, true);

$deleted_expense_id = $deleted_expense["expense_id"];

$sql="DELETE FROM `expenses` WHERE id = ?";
$stmt = $connection->prepare($sql);
$stmt->bind_param("s",$deleted_expense_id);
$stmt->execute();
?>