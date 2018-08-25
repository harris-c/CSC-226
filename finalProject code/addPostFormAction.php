<?php
include("../includeFiles/finalLogin.php");
session_start();
$db=login();
//get variables from superglobals
$username= $_SESSION['valid_user'];
$title = trim(htmlspecialchars($_POST['title']));
$body= trim(htmlspecialchars($_POST['body']));
$date = date('Y-m-d H:i');

//store in database
$query = "insert into posts (title,body,username,date) values (?,?,?,?)";

$stmt = $db -> prepare($query);
$stmt->bind_param('ssss', $title, $body, $username, $date);
$stmt->execute();

//redirect to home page
header('location: http://163.238.35.165/~christopher/index.php');
 ?>
