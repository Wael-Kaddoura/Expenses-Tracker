<?php
include "connection.php";

session_start();

$user_id = $_SESSION["user_id"];

$sql="SELECT * FROM categories WHERE user_id=?";
$stmt = $connection->prepare($sql);
$stmt->bind_param("s",$user_id);
$stmt->execute();
$result = $stmt->get_result();

$categories = [];

while ($row = $result->fetch_assoc()) {
    $categories[$row["id"]] = $row["name"];
}

$json = json_encode($categories);

echo $json;
?>