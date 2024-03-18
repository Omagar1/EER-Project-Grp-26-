<?php
ob_start();
session_start();
require_once "dbConnect.php";
require_once "createAccount.php";

$msg = "";

if (isset($_POST['signUpSubmit']))
{
    if ($_POST['signUpPassword'] === $_POST['confirmAccountPassword'])
    {
        $msg = createAccount($conn, $_POST['signUpEmail'], md5($_POST['signUpPassword']));
    } else 
    {
        $msg = "Passwords do not match.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
</head>
<body>
    <h2>Create Account</h2>
        <form action="signUp.php" method="post">
            <label for="signUpEmail">Email:</label><br>
            <input type="email" name="signUpEmail" placeholder="example@email.com" required><br>

            <label for="signUpPassword">Password:</label><br>
            <input type="password" name="signUpPassword" minlength="4" required><br>

            <label for="confirmAccountPassword">Re-type Password:</label><br>
            <input type="password" name="confirmAccountPassword" minlength="4" required><br><br>

            <input type="submit" name="signUpSubmit"><br>
            <div class="errorMessage"><?php echo $msg ?></div>
        </form>
</body>
</html>