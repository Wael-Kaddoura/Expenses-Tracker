<?php
include "connection.php";

session_start();

$user_id = $_SESSION["user_id"];

$new_expense_data = $_POST["new_expense_data"];
$new_expense_data = json_decode($new_expense_data, true);

$amount = $new_expense_data["amount"];
$date = $new_expense_data["date"];
$category_id = $new_expense_data["category"];

$sql="INSERT INTO `expenses`(`date`, `amount`, `user_id`, `category_id`) VALUES (?, ?, ?, ?)";
$stmt = $connection->prepare($sql);
$stmt->bind_param("ssss",$date, $amount, $user_id, $category_id);
$stmt->execute();
$result = $stmt->get_result();
?>