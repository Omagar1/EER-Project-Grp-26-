<?php
//ob_start();
session_start();
require_once "dbConnect.php";

?>


<!DOCTYPE html>
<?php var_dump($_POST); ?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Account</title>
</head>
<body>
    <form action="main.php" method="post">
        <label for="uname">Username:</label><br>
        <input type="text" id="uname" name="uname"><br>
        <label for="password">Password:</label><br>
        <input type="password" id="password" name="pword"><br><br>
        <input type="submit">
    </form>
</body>
</html>
<?php var_dump($_POST); ?>