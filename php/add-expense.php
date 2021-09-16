<?php
include "connection.php";

session_start();

$user_id = $_SESSION["user_id"];
$amount = $_POST["amount"];
$date = $_POST["date"];
$category_id = $_POST["category"];

$sql="INSERT INTO `expenses`(`date`, `amount`, `user_id`, `category_id`) VALUES (?, ?, ?, ?)";
$stmt = $connection->prepare($sql);
$stmt->bind_param("ssss",$date, $amount, $user_id, $category_id);
$stmt->execute();
$result = $stmt->get_result();

?>