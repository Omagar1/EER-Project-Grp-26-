<?php
require_once "emailFunctions.php"; 
$msg = "";
if (isset($_POST['resendEmailSubmit'])){
    sendEmail($_SESSION["EmailUsed"]);
    $msg = "New Email has been sent to". $_SESSION["EmailUsed"]; 
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Verify email</title>
</head>
<body>
    
<div id="form-container">
    <div id="user-form">
    <h2>Verify email</h2>
        <p>Please find the email we have sent you and click the link to verify your account!</p>
        <form enctype="multipart/form-data" method="post">
            <input type="submit" name="resendEmailSubmit" value="Resend Verification Email"><br>
        </form>
        <div class="errorMessage"><?php echo $msg ?></div>
        <a href="index.php">Back</a>
</div>
</div>
</body>
</html>