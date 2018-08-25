<?php
include("../includeFiles/finalLogin.php");
session_start();

$db=login();
$id=$_GET['id'];

//display the post
$query = "select title,body,username,date from posts where postID = ?";
$stmt = $db -> prepare($query);
$stmt->bind_param('s',$id);
$stmt->execute();
$stmt->store_result();
$stmt->bind_result($title, $body,$username, $date);

while($stmt->fetch()){
$newdate= date('m/d/Y/ h:i A', strtotime($date));
echo "<b>$title</b> </br>";
echo $body;
echo "</br>";
echo "Posted by $username on $newdate </br>";
}
echo'</br></br>';

//display comments on the post
$query = "select body,username,date from comments where postID = ?";

$stmt = $db -> prepare($query);
$stmt->bind_param('s',$id);
$stmt->execute();
$stmt->store_result();
$stmt->bind_result($comment, $username, $date);

if($stmt->affected_rows >0){
    while($stmt->fetch()){
      $newdate= date('m/d/Y/ h:i A', strtotime($date));
      echo "$comment </br>";
      echo "Posted by $username on $newdate </br> </br>";
    }
}else{
  echo "There are no comments on this post </br>";
}
echo  '<a href=index.php?>Go to the home page</a> </br>';
echo 'Or click to </br>';
echo "<a href=\"addComment.php?id=$id\">Add a Comment</a> ";

 ?>
