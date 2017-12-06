<?php
session_start(); // Starting Session
$error=''; // Variable To Store Error Message
if (isset($_POST['submit'])) {
if (empty($_POST['username']) || empty($_POST['u_id'])) {
$error = "Unique ID or username is invalid";
}
else
{
// Define $username and $password
$unique_id=$_POST['u_id'];
$username=$_POST['username'];
// Establishing Connection with Server by passing server_name, user_id and password as a parameter
$connection = mysql_connect("localhost", "root", "");
// To protect MySQL injection for Security purpose
$unique_id = stripslashes($unique_id);
$username = stripslashes($username);
$unique_id = mysql_real_escape_string($unique_id);
$username = mysql_real_escape_string($username);
// Selecting Database
$db = mysql_select_db("pokemon", $connection);
// SQL query to fetch information of registerd users and finds user match.
$query = mysql_query("select * from login where id='$unique_id' AND username='$username'", $connection);
$rows = mysql_num_rows($query);
if ($rows == 1) {
$_SESSION['login_user']=$username; // Initializing Session
header("location: profile.php"); // Redirecting To Other Page
} else {
$error = "Username or ID is invalid";
}
mysql_close($connection); // Closing Connection
}
}
?>