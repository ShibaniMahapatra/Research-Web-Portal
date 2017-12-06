<?php
include('red.php'); // Includes Login Script

if(isset($_SESSION['login_user'])){
header("location: profile.php");
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Login Form</title>
<link href="style.css" rel="stylesheet" type="text/css">
</head>
<body>
<div id="main">
<h1>PHP Login with Session </h1>
<div id="login">
<h2>Login Form</h2>
<form action="" method="post">
<label>Unique ID :</label>
<input id="u_id" name="u_id" placeholder="unique ID" type="text">
<label>UserName :</label>
<input id="name" name="username" placeholder="username" type="text">
<input name="submit" type="submit" value=" Login ">
<span><?php echo $error; ?></span>
</form>
</div>
</div>
</body>
</html>

