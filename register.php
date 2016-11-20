<?php include "/Library/WebServer/Documents/includes/preload.php";
    include "/Library/WebServer/Documents/includes/head.php";

?>
<title>FireryRage</title>
</head>
<body role="document">
<?php
include "/Library/WebServer/Documents/includes/navbar.php";

    if ($err_msg <> "") echo $err_msg;
?>
<br>
<table>
<tr><td>
<form method="POST" id="new_account" action="index.php">
Create account:<br>
username: <input type="text" name="username" value="<?php echo $_POST["username"] ?>" ><br>
e-mail: <input type="text" name="email" value="<?php echo $_POST["email"] ?>" ><br>
Password: <input type="password" name="password"><br>
Confirm Password: <input type="password" name="passconf"><br>
<input id="new_account" name="new_account" type="submit" value="create account">
</form></td>

<td>

<form method="POST" id="login_account" action="index.php">
Login to account:<br>
username: <input type="text" name="username" value="<?php echo $_POST["username"] ?>" ><br>
Password: <input type="password" name="password"><br>
<input id="login_account" name="login_account" type="submit" value="login">
</form></td></table>
<br><br>
<?php
    $conn->close();
/*$_SESSION['test'] = 42;
$test = 43;
echo $_SESSION['test'];*/
include "/Library/WebServer/Documents/includes/footer.php";
?>
</body></html>
