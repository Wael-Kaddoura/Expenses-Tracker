<?php
include "connection.php";

session_start();

if(isset($_POST["email"]) && $_POST["email"] != "" && strlen($_POST["email"]) > 5 && strrpos($_POST["email"], ".") > strrpos($_POST["email"], "@") && strrpos($_POST["email"], "@") != -1){
	$email = $_POST["email"];
} else{
	die("Try again next time");
}

if (isset($_POST["password"]) and $_POST["password"] !=""){
	$password = hash('sha256', $_POST["password"]);
}else{
	die("Try again next time");
}

$sql1="SELECT * FROM users WHERE email=? AND password=?";
$stmt1 = $connection->prepare($sql1);
$stmt1->bind_param("ss",$email,$password);
$stmt1->execute();
$result = $stmt1->get_result();
$row = $result->fetch_assoc();


if(empty($row) ){
	$_SESSION["login_error"] = TRUE;//variable used to trigger login error alert

	header('location: ../login.php');
}else{
	$_SESSION["logedin"] = TRUE;	
	$_SESSION["name"] = $row["first_name"]." ".$row["last_name"];
	$_SESSION["user_id"] = $row["id"];
	
	header('location: ../index.html');
}
?>