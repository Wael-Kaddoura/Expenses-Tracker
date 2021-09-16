<?php
include "connection.php";

session_start();

$user_id = $_SESSION["user_id"];

//getting all the categories for the current user from the DB
$sql="Select * from categories where user_id=?";
$stmt = $connection->prepare($sql);
$stmt->bind_param("s",$user_id);
$stmt->execute();
$result = $stmt->get_result();

$categories = [];
//passing the categories to the array
while ($row = $result->fetch_assoc()) {
    $categories[$row["id"]] = $row["name"];
}

//converting to json
$json = json_encode($categories);

echo $json;
?>