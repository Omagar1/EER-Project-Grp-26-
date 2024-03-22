<?php
ob_start();
session_start();
require_once "dbConnect.php";
require_once "createAccount.php";

$msg = "";

if (isset($_POST['signUpSubmit']))
{
    if (preg_match('/[^a-zA-Z0-9]/', $_POST['signUpPassword']) > 0 And preg_match('/[0-9]/', $_POST['signUpPassword']) > 0)
    // checks if the password used for signup contains at least 1 special character and 1 number.
    {
        if ($_POST['signUpPassword'] === $_POST['confirmAccountPassword'])
        // password confirmation
        {
            $msg = createAccount($conn, $_POST['signUpEmail'], md5($_POST['signUpPassword']), $_POST['role']);
        }
        else
        {
            $msg = "Entered passwords do not match.";
        }
    }
    else
    {
        $msg = "Password must contain at least 1 special character and 1 number.";
    }
}
// else
// {
//     date_default_timezone_set("Europe/London");
//     $currentTime = date("H:i:s");
//     echo $currentTime;
//     // returns current London time
// }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Sign Up</title>
</head>
<body>
    
<div id="form-container">
    <div id="user-form">
    <h1>Create Account</h1>
        <form action="signUp.php" method="post">
            <label for="signUpEmail">Email:</label><br>
            <input type="email" name="signUpEmail" placeholder="example@email.com" required><br>

            <label for="signUpPassword">Password:</label><br>
            <input type="password" name="signUpPassword" minlength="4" required><br>

            <label for="confirmAccountPassword">Re-type Password:</label><br>
            <input type="password" name="confirmAccountPassword" minlength="4" required><br>

            <label for="role">Role:</label>
            <select name="role" required>
                <option value="Landlord/Homeowner">Landlord/Homeowner</option>
                <option value="Prospective buyer/Tenant">Prospective buyer/Tenant</option>
            </select><br><br>

            <input type="submit" name="signUpSubmit"><br>
            <div class="errorMessage"><?php echo $msg ?></div>
        </form>
        <a href="index.php">Back</a>
    </div>
</div>
</body>
</html>