<?php
include "connection.php";

session_start();

$user_id = $_SESSION["user_id"];

$sql="SELECT *, SUM(amount) as sum FROM `expenses` WHERE user_id = ? GROUP BY category_id"   ;
$stmt = $connection->prepare($sql);
$stmt->bind_param("s",$user_id);
$stmt->execute();
$result = $stmt->get_result();

$expenses = [];

while ($row = $result->fetch_assoc()) {
    $expenses[$row["id"]]["date"] = $row["date"];
    $expenses[$row["id"]]["sum"] = $row["sum"];

    //getting the category name based on category_id
    $sql1="SELECT * FROM `categories` WHERE id = ?";
    $stmt1 = $connection->prepare($sql1);
    $stmt1->bind_param("s",$row["category_id"]);
    $stmt1->execute();
    $result1 = $stmt1->get_result();
    $row1 = $result1->fetch_assoc();

    $expenses[$row["id"]]["category"] = $row1["name"];
}

$json = json_encode($expenses);

echo $json;
?>