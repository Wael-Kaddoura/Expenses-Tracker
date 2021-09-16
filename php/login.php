<?php
include "connection.php";

session_start();

//checking the reception of an email the meets the basic requirments
if(isset($_POST["email"]) && $_POST["email"] != "" && strlen($_POST["email"]) > 5 && strrpos($_POST["email"], ".") > strrpos($_POST["email"], "@") && strrpos($_POST["email"], "@") != -1){
	$email = $_POST["email"];
} else{
	die("Try again next time");
}

//checking the reception of a password the meets the basic requirments	
if (isset($_POST["password"]) and $_POST["password"] !=""){
	$password = hash('sha256', $_POST["password"]);
}else{
	die("Try again next time");
}

//checking if the email already exists in the users' database
$sql1="Select * from users where email=? and password=?";
$stmt1 = $connection->prepare($sql1);
$stmt1->bind_param("ss",$email,$password);
$stmt1->execute();
$result = $stmt1->get_result();
$row = $result->fetch_assoc();


if(empty($row) ){
	//if the email is not associated with a user
	$_SESSION["login_error"] = TRUE;
	header('location: ../login.php');
}else{
		$_SESSION["logedin"] = TRUE;
	
		//setting the name of the user
		$_SESSION["name"] = $row["first_name"]." ".$row["last_name"];
	
		$_SESSION["user_id"] = $row["id"];

	
	
	//redirecting to the home page
	header('location: ../index.php');
}
?>