<?php
include "connection.php";

session_start();

$edited_expense_data = $_POST["edited_expense_data"];
$edited_expense_data = json_decode($edited_expense_data, true);

$expense_id = $edited_expense_data["expense_id"];
$new_amount = $edited_expense_data["amount"];
$new_date = $edited_expense_data["date"];
$new_category_id = $edited_expense_data["category_id"];

$sql="UPDATE `expenses` SET `date`= ?,`amount`= ?,`category_id`= ? WHERE id = ?";
$stmt = $connection->prepare($sql);
$stmt->bind_param("ssss",$new_date, $new_amount, $new_category_id, $expense_id);
$stmt->execute();
$result = $stmt->get_result();
?>