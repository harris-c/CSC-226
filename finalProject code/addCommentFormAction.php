<?php
include("../includeFiles/finalLogin.php");
session_start();
$db=login();
//get variables from superglobals
$username= $_SESSION['valid_user'];
$body= trim(htmlspecialchars($_POST['body']));
$date = date('Y-m-d H:i');
$id = $_SESSION['id'];

//store in database
$query = "insert into comments (username,body,postID,date) values (?,?,?,?)";

$stmt = $db -> prepare($query);
$stmt->bind_param('ssss', $username, $body, $id, $date);
$stmt->execute();

header("location: http://163.238.35.165/~christopher/viewComment.php?id=$id");
 ?>
