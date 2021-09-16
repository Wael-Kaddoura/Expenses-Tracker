<?php
//Signup for a new account

include "connection.php";

session_start();

//checking the reception of a first name the meets the basic requirments
if(isset($_POST["first_name"]) && $_POST["first_name"] != "" && strlen($_POST["first_name"]) >= 3) {
    $first_name = $_POST["first_name"];
}else{
    die ("Enter a valid input");
}

//checking the reception of a last name the meets the basic requirments	
if(isset($_POST["last_name"]) && $_POST["last_name"] != "" && strlen($_POST["last_name"]) >= 3) {
    $last_name = $_POST["last_name"];
}else{
    die ("Enter a valid input");
}

//checking the reception of an email the meets the basic requirments	
if(isset($_POST["email"]) && $_POST["email"] != "" && strlen($_POST["email"]) > 5 && strrpos($_POST["email"], ".") > strrpos($_POST["email"], "@") && strrpos($_POST["email"], "@") != -1) {
    $email = $_POST["email"];
}else{
    die ("Enter a valid input");
}

//checking the reception of a password the meets the basic requirments	
if(isset($_POST["password"]) && $_POST["password"] != "" && $_POST["password"] == $_POST["confirmPassword"] && strlen($_POST["password"]) > 5) {
    $password = hash("sha256", $_POST["password"]);
}else{
    die ("Enter a valid input");
}

//checking if the email already exists in the database
$sql1="Select * from users where email=?";
$stmt1 = $connection->prepare($sql1);
$stmt1->bind_param("s",$email);
$stmt1->execute();
$result = $stmt1->get_result();
$row = $result->fetch_assoc();

//if the email is not already used, create a record for the user in the database
if(empty($row)){
    $sql2 = "INSERT INTO `users`(`first_name`, `last_name`, `email`, `password`) VALUES (?,?,?,?);"; # add the new user to the database
    $stmt2 = $connection->prepare($sql2);
    $stmt2->bind_param("ssss", $first_name, $last_name, $email, $password);
    $stmt2->execute();
    $result2 = $stmt2->get_result();

    $_SESSION["name"] = $name;
    $_SESSION["new_account"] = true;//variable used to trigger the "account successfully created" alert

    //redirecting to the login page
    header('location: ../login.php');
}else{
    //incase the email is already used, this variable will be used to trigger an alert message
    $_SESSION["email_used"] = true;

    //redirecting to the buyer signup page
    header('location: ../user-register.php');
}
?>