<?php
include("../includeFiles/finalLogin.php");

session_start();
$db=login();
if (isset($_POST['username']) && isset($_POST['password']))
{
  // if the user has just tried to log in
  $username = trim(htmlspecialchars($_POST['username']));
  $password = trim(htmlspecialchars($_POST['password']));

  if (mysqli_connect_errno()) {
   echo 'Connection to database failed:'.mysqli_connect_error();
   exit();
  }
  $query = "select username from users where username= ? and password = sha1(?)";


  $stmt = $db-> prepare($query);
  $stmt->bind_param('ss',$username,$password);
  $stmt->execute();
  $stmt->store_result();
  $stmt->bind_result($user);

  if ($stmt->num_rows >0 )
  {
    // if they are in the database register the user id
    $_SESSION['valid_user'] = $username;
  }
  $stmt->free_result();

  $db->close();
}
?>
<html>
<body>
<h1>Home page</h1>
<?
  if (isset($_SESSION['valid_user']))
  {
    echo 'You are logged in as: '.$_SESSION['valid_user'].' <br />';
    echo '<a href="logout.php">Log out</a><br />';
  }
  else
  {
    if (isset($username))
    {
      // if they've tried and failed to log in
      echo 'Could not log you in.<br />';
    }
    else
    {
      // they have not tried to log in yet or have logged out
      echo 'You are not logged in.<br />';
    }

    // provide form to log in
    echo '<form method="post" action="login.php">';
    echo '<table>';
    echo '<tr><td>Username:</td>';
    echo '<td><input type="text" name="username"></td></tr>';
    echo '<tr><td>Password:</td>';
    echo '<td><input type="password" name="password"></td></tr>';
    echo '<tr><td colspan="2" align="center">';
    echo '<input type="submit" value="Log in"></td></tr>';
    echo '</table></form>';
  }
?>
<br />
<a href="index.php">Home Page </a></br>
Not a member?<a href="addUser.php">Click here to join</a>
</body>
</html>
