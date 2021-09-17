<?php
include "connection.php";

session_start();

$user_id = $_SESSION["user_id"];

$new_category = $_POST["new_category"];
$new_category = json_decode($new_category, true);

$new_category_name = $new_category["new_category_name"];

$sql="INSERT INTO `categories`(`name`, `user_id`) VALUES (?, ?)";
$stmt = $connection->prepare($sql);
$stmt->bind_param("ss",$new_category_name, $user_id);
$stmt->execute();
$result = $stmt->get_result();
?>