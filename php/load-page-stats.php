<?php
include "connection.php";

session_start();

$page_stats = [];

if (!isset($_SESSION["logedin"]) || !$_SESSION["logedin"]) {
    $_SESSION["logedin"] = FALSE ;
    $page_stats["is_logedin"] = FALSE;

}elseif ($_SESSION["logedin"]) {
    $user_id = $_SESSION["user_id"];

    $sql1="SELECT * FROM users WHERE id=?";
    $stmt1 = $connection->prepare($sql1);
    $stmt1->bind_param("s",$user_id);
    $stmt1->execute();
    $result1 = $stmt1->get_result();
    $row1 = $result1->fetch_assoc();

    $page_stats["is_logedin"] = TRUE;
    $page_stats["username"] = $row1["first_name"]." ".$row1["last_name"];
}

$json = json_encode($page_stats);

echo $json;
?>