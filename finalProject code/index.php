<html>
<h1> Welcome to the CSC 226 Blog! </h1>
<?php
include("../includeFiles/finalLogin.php");
session_start();

$db = login();
if (mysqli_connect_errno()) {
   echo 'Error: Could not connect to database.  Please try again later.';
   exit;
}

if (isset($_GET['page'])){
  $thispage = $_GET['page'];
}
else{
  $thispage = 1;
}
//get total number of comments
$query = "select count(body) from posts";

$stmt = $db -> prepare($query);
$stmt->execute();
$stmt->store_result();
$stmt->bind_result($totrecords);
$stmt->fetch();

$stmt->free_result();

//set limits for query
$recordsperpage= 5;
$totalpages= ceil($totrecords/$recordsperpage);
$offset= ($thispage-1) * $recordsperpage;

//get top 5 posts from database
$query = "select title,body,username,date,postID, from posts order by date desc limit ?,?";

$stmt = $db -> prepare($query);
$stmt->bind_param('ss',$offset, $recordsperpage);
$stmt->execute();
$stmt->store_result();
$stmt->bind_result($title, $post, $username, $date, $postID);

//display top 5 posts
while($stmt->fetch()){
$newdate= date('m/d/Y/ h:i A', strtotime($date));
echo "<b>$title</b> </br>";
echo $post;
echo "</br>";
echo "Posted by $username on $newdate </br>";
echo "<a href=\"addComment.php?id=$postID\">Add a Comment</a> ";
echo str_repeat(' ', 10);
echo "<a href=\"viewComment.php?id=$postID\">See all Comments</a> ";
echo "</br> </br>";
}


//adjust page
if ($thispage > 1){

  $page = $thispage - 1;
  $prevpage = "<a href=\"      \">Previous</a>"; //put in the link with get parameters for the previous page!

 } else{
   $prevpage = "";
}

//build individual links
$bar = "";
echo "total pages: ".$totalpages."<br />";
 if ($totalpages > 1){
   for($page = 1; $page <= $totalpages; $page++) {
      if ($page == $thispage){
        $bar .= " $page ";
    } else {
        $bar .= " <a href=\"index.php?page=$page\">$page</a> ";
      }
    }
 echo $bar;
 }

echo '</br></br>';
echo '<a href="logout.php">Logout</a></br>';
echo '<a href="login.php">Login</a></br>';
echo '<a href="addBlogPosting.php">Add a post</a></br>';
echo 'Not a user? <a href="addUser.php">Click here to join</a></br>';


?>

</html>
