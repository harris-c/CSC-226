<?php
session_start();
if (! isset($_SESSION['valid_user'])){
  echo '<form action= "addUserFormAction.php" method="post">';
  echo'Enter your username: <input type="text" name="n"> <br/>';
  echo'Enter your password:  <input type="password" name="p"> <br/>';
  echo'Enter your email:  <input type="text" name="email"> <br/>';
  echo'<input type="submit" name = "submit" value="Submit" > </form>';

}else{
  echo 'You are already logged in as: '.$_SESSION['valid_user'].' <br />';
  echo '<a href="logout.php">Click here to logout</a></br>';
  echo 'Or <a href="index.php">Click here to go to the home page</a></br>';
}



 ?>
