<?php
include "connection.php";

session_start();

$user_id = $_SESSION["user_id"];

$new_expense_data = $_POST["new_expense_data"];
$new_expense_data = json_decode($new_expense_data, true);

$amount = $new_expense_data["amount"];
$date = $new_expense_data["date"];
$category_id = $new_expense_data["category_id"];

$sql="INSERT INTO `expenses`(`date`, `amount`, `user_id`, `category_id`) VALUES (?, ?, ?, ?)";
$stmt = $connection->prepare($sql);
$stmt->bind_param("ssss",$date, $amount, $user_id, $category_id);
$stmt->execute();

$sql1="SELECT * FROM `categories` WHERE id = ?";
$stmt1 = $connection->prepare($sql1);
$stmt1->bind_param("s",$category_id);
$stmt1->execute();
$result1 = $stmt1->get_result();
$row1 = $result1->fetch_assoc();

$id = $stmt->insert_id;

$expense_obj = [];
$expense_obj["id"] = $id;
$expense_obj["amount"] = $amount;
$expense_obj["date"] = $date;
$expense_obj["category"] = $row1["name"];

$expense_json = json_encode($expense_obj);
echo $expense_json;
?>