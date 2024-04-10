<?php
ob_start();
// Values are in seconds // lasts an hour
session_start([ 
    'cookie_lifetime' => 3600, 
    'gc_maxlifetime' => 3600, 
   ]);
require_once "dbConnect.php";
require_once "createAccount.php";
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/phpmailer/phpmailer/src/Exception.php';
require 'vendor/phpmailer/phpmailer/src/PHPMailer.php';
require 'vendor/phpmailer/phpmailer/src/SMTP.php';

require 'vendor/autoload.php';

function sendEmail()
{   
    $otp_data = isset($_SESSION['otp_data']) ? $_SESSION['otp_data'] : null;

    if ($otp_data) {
        $otp = $otp_data['otp'];
    } else {
        echo 'Error: OTP Missing or Invalid';
        return;
    }


    $mail = new PHPMailer;

    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'eerapplication@gmail.com';
    $mail->Password = 'ueicjyqunioaygvq'; 
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;

    $mail->setFrom('eerapplication@gmail.com');
    $mail->addAddress($_POST['signUpEmail']);
    $mail->Subject = 'Please Verify Your Email';
    $mail->Body    = 'Please Click On the Link Below to Verify' . 
        "\nhttps://eercalc.azurewebsites.net/verifyOTP.php?otp=" . $otp;

    if(!$mail->send()) {
        echo 'Message could not be sent.';
        echo 'Mailer Error: ' . $mail->ErrorInfo;
    } else {
        echo 'Message has been sent';
    }
}

function updateVerificationStatus($email, $conn)
{
    try{
        $sql = "UPDATE account SET active = ? WHERE email = ?'";
        $stmt = $conn->prepare($sql);
        $stmt->execute([1,$email]);
    } catch (PDOException $e)
    {
        echo "Error: " . $e->getMessage();
        return $e;
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
    
    
    if ($_POST['signUpPassword'] === $_POST['confirmAccountPassword'])
    {
        sendEmail();
        //$msg ="test";
        var_dump($_POST);
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
        <form action="signUp.php" enctype="multipart/form-data" method="post">
            <label for="signUpEmail">Email:</label><br>
            <input type="email" name="signUpEmail" placeholder="example@email.com" required><br>

            <label for="signUpPassword">Password:</label><br>
            <input type="password" name="signUpPassword" minlength="4" required><br>

            <label for="confirmAccountPassword">Re-type Password:</label><br>
            <input type="password" name="confirmAccountPassword" minlength="4" required><br>
            
            <label for="role">Role: </label><br>
            <select name="role">
                <option value="Tenant">Tenant</option>
                <option value="Landlord">Landlord</option>
                <option value="Admin">Admin</option>
            </select><br><br>

            <input type="submit" name="signUpSubmit"><br>
            <div class="errorMessage"><?php echo $msg ?></div>
        </form>
        <a href="index.php">Back</a>
</div>
</div>
</body>
</html>
