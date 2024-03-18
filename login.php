<!-- add password confirmation, create all other pages from wireframe, add error handling to variables before functions are called -->

<?php
ob_start();
session_start();
require_once "dbConnect.php";
require_once "loginValidation.php";

$msg = "";

if (isset($_POST['loginSubmit']))
{
    $msg = loginValidation($conn, $_POST['loginEmail'], md5($_POST['loginPassword']));
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="wnameth=device-wnameth, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <h1>Login</h1>
    <form action="login.php" method="post">
        <label for="loginEmail">Email:</label><br>
        <input type="email" name="loginEmail" placeholder="example@email.com" required><br>

        <label for="loginPassword">Password:</label><br>
        <input type="password" name="loginPassword" minlength="4" required><br><br>

        <input type="submit" name="loginSubmit"><br>
        <div class ="errorMessage"><?php echo $msg ?></div>
    </form>



</body>
</html>