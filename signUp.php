<?php
ob_start();
// Values are in seconds // lasts an hour
session_start([ 
    'cookie_lifetime' => 3600, 
    'gc_maxlifetime' => 3600, 
   ]);
require_once "dbConnect.php";
require_once "createAccount.php";

function sendEmail()
{   
    
    $otp_data = isset($_SESSION['otp_data']) ? $_SESSION['otp_data'] : null;

    if ($otp_data) {
        $otp = $otp_data['otp'];
    } else {
        echo 'Error: OTP Missing or Invalid';
        return;
    }

    $email = $_POST['signUpEmail'];
    $subject = "Email Verification";
    $body = "Please Click the Link Below to Verify Your Account\n"
        . "http://localhost:8080/MailTest/EER-Project-Grp-26--main/verifyOTP.php?otp=" . $otp;
         
    if (mail($email, $subject, $body)) {
        echo "Email successfully sent to $email...";
    } else {
        echo "Email sending failed...";
    }
}
$msg = "";

if (isset($_POST['signUpSubmit']))
{    
     $email = $_POST['signUpEmail'];

    $otp = rand(100000, 999999);
    $_SESSION['otp_data'] = array(
    'otp' => $otp,
    'timestamp' => time()
);
    sendEmail();
    
    if ($_POST['signUpPassword'] === $_POST['confirmAccountPassword'])
    {
        $msg = createAccount($conn, $_POST['signUpEmail'], md5($_POST['signUpPassword']), $_POST["role"]);
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
    <link rel="stylesheet" href="styles.css">
    <title>Sign Up</title>
</head>
<body>
    
<div id="form-container">
    <div id="user-form">
    <h2>Create Account</h2>
        <form action="signUp.php" method="post">
            <label for="signUpEmail">Email:</label><br>
            <input type="email" name="signUpEmail" placeholder="example@email.com" required><br>

            <label for="signUpPassword">Password:</label><br>
            <input type="password" name="signUpPassword" minlength="4" required><br>

            <label for="confirmAccountPassword">Re-type Password:</label><br>
            <input type="password" name="confirmAccountPassword" minlength="4" required><br>
            
            <label for="Role">Role: </label><br>
            <select name="Role">
                <option value="volvo">Tenant</option>
                <option value="saab">Landlord</option>
                <option value="opel">Admin</option>
            </select><br><br>

            <input type="submit" name="signUpSubmit"><br>
            <div class="errorMessage"><?php echo $msg ?></div>
        </form>
        <a href="index.php">Back</a>
</div>
</div>
</body>
</html>
