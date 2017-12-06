<?php
session_start();
if(session_destroy()) // Destroying All Sessions
{
header("Location: final_login.php"); // Redirecting To Home Page
}
?>

