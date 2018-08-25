<?php
session_start();
//check if user is logged in
if (! isset($_SESSION['valid_user'])){
  echo "You need to log in to add a post</br>";
  echo '<a href="login.php">Cick here to Login </a></br>';
}else{
//once they are logged in, display form to add post
  echo '<form method="post" action="addPostFormAction.php" id= "inputForm">';
  echo 'Title:   ';
  echo '<input type="text" name="title"> </br>';
  echo 'Enter post here: </br>';
  echo '<textarea rows="4" cols="50" name="body" form="inputForm"> ';
  echo '</textarea></br>';
  echo '<input type="submit" value="Submit">';
  echo '</form>';

}

 ?>
