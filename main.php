<!-- add password confirmation, create all other pages from wireframe, add error handling to variables before functions are called -->

<?php
ob_start();
session_start();
require_once "dbConnect.php";
require_once "loginValidation.php";
require_once "createAccount.php";

$msg = "";
$msg2 = "";

if (isset($_POST['loginSubmit']))
{
    $msg = loginValidation($conn, $_POST['loginEmail'], md5($_POST['loginPassword']));
} elseif (isset($_POST['createAccountSubmit']))
{
    if ($_POST['createAccountPassword'] === $_POST['confirmAccountPassword'])
    {
        $msg2 = createAccount($conn, $_POST['createAccountEmail'], md5($_POST['createAccountPassword']));
    } else 
    {
        $msg2 = "Passwords do not match.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="wnameth=device-wnameth, initial-scale=1.0">
    <title>Create Account</title>
</head>
<body>
    <h1>Login</h1>
    <form action="main.php" method="post">
        <label for="loginEmail">Email:</label><br>
        <input type="email" name="loginEmail" placeholder="example@email.com" required><br>

        <label for="loginPassword">Password:</label><br>
        <input type="password" name="loginPassword" minlength="4" required><br><br>

        <input type="submit" name="loginSubmit"><br>
        <div class ="errorMessage"><?php echo $msg ?></div>
    </form>

    <h2>Create Account</h2>
    <form action="main.php" method="post">
        <label for="createAccountEmail">Email:</label><br>
        <input type="email" name="createAccountEmail" placeholder="example@email.com" required><br>

        <label for="createAccountPassword">Password:</label><br>
        <input type="password" name="createAccountPassword" minlength="4" required><br>

        <label for="confirmAccountPassword">Re-type Password:</label><br>
        <input type="password" name="confirmAccountPassword" minlength="4" required><br><br>

        <input type="submit" name="createAccountSubmit"><br>
        <div class="errorMessage"><?php echo $msg2 ?></div>
    </form>

</body>
</html>