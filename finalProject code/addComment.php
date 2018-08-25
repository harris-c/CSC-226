<?php
session_start();
//check if user is logged in
if (! isset($_SESSION['valid_user'])){
  echo "You need to log in to add a comment </br>";
  echo '<a href="login.php">Cick here to Login </a></br>';
}else{
  $_SESSION['id']= $_GET['id'];
//once they are logged in, display form to add post
  echo '<form method="post" action="addCommentFormAction.php" id= "inputForm">';
  echo 'Enter comment here: </br>';
  echo '<textarea rows="4" cols="50" name="body" form="inputForm"> ';
  echo '</textarea></br>';
  echo '<input type="submit" value="Submit">';
  echo '</form>';

}

 ?>
