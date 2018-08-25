<?php
include("../includeFiles/finalLogin.php");
session_start();
$db=login();

//get variables from superglobals
$username= trim(htmlspecialchars($_POST['n']));
$password= trim(htmlspecialchars($_POST['p']));
$email= trim(htmlspecialchars($_POST['email']));

//check to make sure not already in database
$query = "select username from users where username = ? and password = sha1(?)";

$stmt = $db -> prepare($query);
$stmt->bind_param('ss', $username, $password);
$stmt->execute();
$stmt->store_result();

if($stmt->affected_rows == 0){
  $query = "insert into users values (?,sha1(?),? )";
  $stmt = $db -> prepare($query);
  $stmt->bind_param('sss', $username,$password, $email);
  $stmt->execute();
header("location: http://163.238.35.165/~christopher/index.php");

}else{
  echo 'There already exists a user with these login credentials </br>';
  echo '<a href="addUser.php">Click here to try again</a></br>';
  echo '<a href="index.php">Click here to go to the home page</a></br>';

}


 ?>
