<?php
include "connection.php";

session_start();


$expense_id = $_POST["expense_id"];
$new_amount = $_POST["new_amount"];
$new_date = $_POST["new_date"];
$new_category_id = $_POST["new_category_id"];

if ($new_category_id == 0) {
    $sql="UPDATE `expenses` SET `date`= ?,`amount`= ?,= WHERE id = ?";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("sss",$new_date, $new_amount, $expense_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
}else {
    $sql="UPDATE `expenses` SET `date`= ?,`amount`= ?,`category_id`= ? WHERE id = ?";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("ssss",$new_date, $new_amount, $new_category_id, $expense_id);
    $stmt->execute();
    $result = $stmt->get_result();

}


?>